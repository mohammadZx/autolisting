<?php

namespace App\Models;

use App\Helpers\UrlGen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\Panel\Library\Traits\Models\Crud;
use App\Models\Traits\ActiveTrait;

class Comment extends Model
{
    use Crud, HasFactory, ActiveTrait;
    
    protected $fillable = [
        'commentable_type', 
        'commentable_id',
        'user_id', 
        'content',
        'rate',
        'parent_id',
        'active'
    ];


    
    public function commentable(){
        return $this->morphTo();
    }

    public function childrens(){
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getNameHtml(): string
	{
        return $this->user->name;
	}

    public function getTitleHtml(): string
	{
        return getPostUrl($this->commentable);
	}

    public function getStatusHtml(): string
	{
		return ajaxCheckboxDisplay($this->id, $this->getTable(), 'status', $this->status);
	}

}
