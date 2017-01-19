<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Color
 *
 * @package App
 * @property string $name
*/
class Color extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name'];
    
    
}
