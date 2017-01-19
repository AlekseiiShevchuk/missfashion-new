<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App
 * @property string $name
 * @property string $parent
 * @property string $photo
*/
class Category extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'photo', 'parent_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setParentIdAttribute($input)
    {
        $this->attributes['parent_id'] = $input ? $input : null;
    }
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withTrashed();
    }
    
    public function donors()
    {
        return $this->hasMany(Donor::class)->withTrashed();
    }
    
}
