<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App
 * @property string $category
 * @property string $source_url
 * @property string $name
 * @property string $sku
 * @property double $old_price
 * @property double $new_price
 * @property double $regular_price
 * @property text $description
 * @property text $first_accordion_content
 * @property text $second_accordion_content
*/
class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['source_url', 'name', 'sku', 'old_price', 'new_price', 'regular_price', 'description', 'first_accordion_content', 'second_accordion_content', 'category_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCategoryIdAttribute($input)
    {
        $this->attributes['category_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setOldPriceAttribute($input)
    {
        if ($input != '') {
            $this->attributes['old_price'] = $input;
        } else {
            $this->attributes['old_price'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setNewPriceAttribute($input)
    {
        if ($input != '') {
            $this->attributes['new_price'] = $input;
        } else {
            $this->attributes['new_price'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setRegularPriceAttribute($input)
    {
        if ($input != '') {
            $this->attributes['regular_price'] = $input;
        } else {
            $this->attributes['regular_price'] = null;
        }
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
