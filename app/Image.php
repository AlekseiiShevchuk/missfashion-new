<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 *
 * @package App
 * @property string $url
*/
class Image extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['url','local_big_img','local_small_img'];
    
    
}
