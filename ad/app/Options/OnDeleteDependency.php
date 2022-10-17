<?php

namespace App\Options;

trait OnDeleteDependency{
    public static function boot() {
        parent::boot();
        $onDeletes = static::$onDeletes;
        self::deleting(function($item) use($onDeletes){ // before delete() method call this
             foreach($onDeletes as $related){
                 $item->$related()->each(function($r, $key){
                     $r->delete();
                 });
             }
        });
    }
}