<?php
/**
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\Traits\CheckIfAuthFieldIsVerified;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\LoginRequest;
use App\Events\UserWasLogged;
use App\Http\Resources\UserResource;
use App\Models\Permission;
use App\Models\User;
use App\Http\Controllers\Api\Auth\Helpers\AuthenticatesUsers;
use Illuminate\Support\Facades\Event;

/**
 * @group Authentication
 */
class LoginController extends BaseController
{
	use AuthenticatesUsers, CheckIfAuthFieldIsVerified;
	
	// The maximum number of attempts to allow
	protected $maxAttempts = 5;
	
	// The number of minutes to throttle for
	protected $decayMinutes = 15;
	
	/**
	 * LoginController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		
		// Get values from Config
		$this->maxAttempts = (int)config('settings.security.login_max_attempts', $this->maxAttempts);
		$this->decayMinutes = (int)config('settings.security.login_decay_minutes', $this->decayMinutes);
	}
	
	/**
	 * Log in
	 *
	 * @bodyParam auth_field string required The user's auth field ('email' or 'phone'). Example: email
	 * @bodyParam email string The user's email address or username (Required when 'auth_field' value is 'email'). Example: user@demosite.com
	 * @bodyParam phone string The user's mobile phone number (Required when 'auth_field' value is 'phone'). Example: null
	 * @bodyParam phone_country string required The user's phone number's country code (Required when the 'phone' field is filled). Example: null
	 * @bodyParam password string required The user's password. Example: 123456
	 * @bodyParam captcha_key string Key generated by the CAPTCHA endpoint calling (Required when the CAPTCHA verification is enabled from the Admin panel).
	 *
	 * @param \App\Http\Requests\LoginRequest $request
	 * @return \Illuminate\Http\JsonResponse|null
	 */
	public function login(LoginRequest $request)
	{
		$errorMessage = trans('auth.failed');
		
		try {
			// If the class is using the ThrottlesLogins trait, we can automatically throttle
			// the login attempts for this application. We'll key this by the username and
			// the IP address of the client making these requests into this application.
			if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
				$this->fireLockoutEvent($request);
				
				return $this->sendLockoutResponse($request);
			}
			
			// Get the right auth field (email or phone)
			$authField = getAuthField();
			$fieldValue = $request->input($authField);
			
			// Check username is provided instead of email (in email field)
			if ($authField == 'email') {
				$dbField = getAuthFieldFromItsValue($fieldValue);
			}
			
			// Get credentials values
			$dbField = $dbField ?? $authField;
			$credentials = [
				$dbField   => $fieldValue,
				'password' => $request->input('password'),
				'blocked'  => 0,
			];
			
			// Auth the User
			if (auth()->attempt($credentials, $request->has('remember_me'))) {
				$authUser = auth()->user();
				
				// Get the user as model object
				$user = User::find($authUser->getAuthIdentifier());
				
				// Is user has verified login?
				$tmpData = $this->userHasVerifiedLogin($authUser, $user, $authField);
				$isSuccess = array_key_exists('success', $tmpData) && $tmpData['success'];
				
				// Send the right error message (with possibility to re-send verification code)
				if (!$isSuccess) {
					if (
						array_key_exists('success', $tmpData)
						&& array_key_exists('message', $tmpData)
						&& array_key_exists('extra', $tmpData)
					) {
						return $this->apiResponse($tmpData, 403);
					}
					
					return $this->respondError($errorMessage);
				}
				
				// Redirect admin users to the Admin panel
				$isAdmin = false;
				if ($user->hasAllPermissions(Permission::getStaffPermissions())) {
					$isAdmin = true;
				}
				
				// Revoke previous tokens
				$user->tokens()->delete();
				
				// Create the API access token
				$deviceName = $request->input('device_name', 'Desktop Web');
				$token = $user->createToken($deviceName);
				
				$data = [
					'success' => true,
					'result'  => new UserResource($user),
					'extra'   => [
						'authToken' => $token->plainTextToken,
						'tokenType' => 'Bearer',
						'isAdmin'   => $isAdmin,
					],
				];
				
				return $this->apiResponse($data);
			}
		} catch (\Throwable $e) {
			$errorMessage = $e->getMessage();
		}
		
		// If the login attempt was unsuccessful we will increment the number of attempts
		// to log in and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);
		
		return $this->respondError($errorMessage);
	}
	
	/**
	 * Log out
	 *
	 * @authenticated
	 * @header Authorization Bearer {YOUR_AUTH_TOKEN}
	 *
	 * @urlParam userId int The ID of the user to logout.
	 *
	 * @param $userId
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout($userId)
	{
		if (auth('sanctum')->check()) {
			$authUser = request()->user() ?? auth('sanctum')->user();
			
			// Get the User Personal Access Token Object
			$personalAccess = !is_null($authUser)
				? $authUser->tokens()->where('id', getApiAuthToken())->first()
				: null;
			
			// Revoke all user's tokens
			if (!empty($personalAccess)) {
				if ($personalAccess->tokenable_id == $userId) {
					// Update last user logged Date
					$user = User::find($userId);
					Event::dispatch(new UserWasLogged($user));
					
					// Revoke a specific token
					$personalAccess->delete();
					
					// Revoke all tokens
					// $authUser->tokens()->delete();
				}
			} else {
				return $this->respondError(t('logout_failed'));
			}
		}
		
		return $this->respondSuccess(t('logout_successful'));
	}
}
