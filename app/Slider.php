<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Slider
 *
 * @package App
 * @property string $slider_image
 * @property string $description
 * @property tinyInteger $is_active
*/
class Slider extends Model
{
    protected $fillable = ['slider_image', 'description', 'is_active'];
}
