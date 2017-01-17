<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App
 * @property string $name
*/
class Category extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name'];
    
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product')->withTrashed();
    }
    
}
