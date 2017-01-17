<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @package App
 * @property string $category
 * @property string $from_site_url
 * @property string $source_url
 * @property string $name
 * @property string $sku
 * @property integer $old_price
 * @property integer $new_price
 * @property integer $regular_price
 * @property string $sko_str
 * @property text $description
 * @property text $first_accordion_content
 * @property text $second_accordion_content
 */
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'from_site_url',
        'source_url',
        'name',
        'sku',
        'old_price',
        'new_price',
        'regular_price',
        'sko_str',
        'description',
        'first_accordion_content',
        'second_accordion_content',
        'category_id'
    ];


    /**
     * Set to null if empty
     * @param $input
     */
    public function setCategoryIdAttribute($input)
    {
        $this->attributes['category_id'] = $input ? $input : null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_product')->withTrashed();
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product')->withTrashed();
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size')->withTrashed();
    }

}
