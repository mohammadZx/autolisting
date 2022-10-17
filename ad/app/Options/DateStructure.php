<?php
namespace App\Options;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
trait DateStructure{
    
    public function createdAt() : Attribute{
        return Attribute::make(
            get: fn($value) => toJalali($value)
        );
    }

    protected function updatedAt() : Attribute {
        return Attribute::make(
            get: fn($value) => toJalali($value)
        );
    }

}