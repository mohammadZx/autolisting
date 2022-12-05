<?php

namespace App\Http\Controllers\Api\Option;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubAdmin1;
use Illuminate\Http\Request;

class GetSubsInfo extends Controller
{
    public function index(){
        return response()->json([
            'random_phone' => $this->getHeaderPhonesRandom(),
            'footer_info' => $this->getFooterInfo(),
            'phones' => $this->getPhones(),
            'categories' => $this->getCategories(),
            'provinces' => $this->getProvinces(),
        ]);
        exit;
    }


    public function getHeaderPhonesRandom(){
        return Post::whereHas('latestPayment', function($q){
            $q->where('package_id', 7); 
        })->limit(4)->get();
    }

    public function getPhones(){    
        return Post::whereHas('latestPayment', function($q){
            $q->where('package_id', 7); 
        })->limit(10)->get();
    }

    public function getFooterInfo(){
        return Post::whereHas('latestPayment', function($q){
            $q->whereIn('package_id', [7, 6]); 
        })->limit(15)->get();
    }

    public function getCategories(){
        return Category::all();
    }

    public function getProvinces(){
        return SubAdmin1::where('country_code', 'IR')->get();
    }

    public function getListings(){
        $categories = [];
        $limit = 8;
        if(request()->has('categories') && request()->categories){
            $categories = explode(',', request()->categories);
        }
        if(request()->has('limit')){
            $limit = request()->limit;
        }

         $post = Post::query()->with([
            'city' => function($q){
                $q->with(['subAdmin2', 'subAdmin1']);
            },
            'pictures'
         ]);
        if(count($categories)){
            $post = $post->whereHas('category', function($q) use($categories ){
                $q->whereIn('id', $categories); 
            });
        }
        $post = $post->limit($limit)->orderBy('id', 'DESC')->get();
        return $post;
    }
}
