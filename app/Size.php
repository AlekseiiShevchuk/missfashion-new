<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Size
 *
 * @package App
 * @property string $name
*/
class Size extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name'];
    
    
}
