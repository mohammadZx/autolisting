<?php

namespace App\Http\Controllers\Api\Auth\Helpers;

use Illuminate\Http\Request;

trait AuthenticatesUsers
{
	use ThrottlesLogins;
	
	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	protected function credentials(Request $request)
	{
		return $request->only($this->username(), 'password');
	}
	
	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function username()
	{
		return 'email';
	}
}
