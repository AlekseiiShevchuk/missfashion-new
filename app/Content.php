<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'is_active'];

    public function setNameAttribute($input)
    {
        $this->attributes['name'] = $input ? $input : null;
    }
}
