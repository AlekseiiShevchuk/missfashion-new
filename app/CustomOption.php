<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomOption extends Model
{
    protected $primaryKey = 'option_name';
    protected $fillable = ['value'];
}
