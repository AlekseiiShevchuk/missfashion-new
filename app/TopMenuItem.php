<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TopMenuItem
 *
 * @package App
 * @property string $name
 * @property string $link
 * @property tinyInteger $is_main
 * @property string $image
*/
class TopMenuItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'link', 'is_main', 'image'];
    
    
    public function subitems()
    {
        return $this->belongsToMany(TopMenuItem::class, 'top_menu_item_top_menu_item','top_menu_item_id','top_menu_parent_item_id')->withTrashed();
    }
    
}
