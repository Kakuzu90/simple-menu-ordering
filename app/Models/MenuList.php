<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MenuCategory;

class MenuList extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'menu_lists';
    protected $fillable = [
        'name', 'tax', 'price', 'category_id', 'image_path'
    ];

    public function category() {
        return $this->hasOne(MenuCategory::class, 'id', 'category_id');
    }
}
