<?php

namespace App\Http\Controllers\Web\Account;

use Illuminate\Http\Request;
use App\Models\Request as RequsetsModel;
use Illuminate\Support\Carbon;
use Larapen\LaravelMetaTags\Facades\MetaTag;
use App\Helpers\Files\Upload;

class RequestController extends AccountBaseController
{
    public function index(){
        MetaTag::set('title', t('Requests'));
		MetaTag::set('description', t('Requests', ['appName' => config('settings.app.name')]));

        $date = Carbon::now()->subDays(7)->format('Y-m-d H:i:s');
        $results = RequsetsModel::where('created_at' , '>', $date)->paginate(50);

        return appView('account.requests', ['results' => $results]);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        $requestModel = new RequsetsModel();
        $requestModel->name = $request->name;
        $requestModel->phone = $request->phone;
        $requestModel->city = $request->city;
        $requestModel->car_model = $request->car_model;
        $requestModel->content = $request->content;
        if($request->hasFile('image') && $request->file('image')){
            $uploader = new Upload();
            $fileName = $uploader->image('', $request->file('image'));
            $requestModel->image = $fileName;
        }
        $requestModel->save();
        return response()->json([
            'status' => 200,
            'data' => $requestModel
        ]);
    }
}
