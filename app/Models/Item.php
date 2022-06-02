<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;


    protected $fillable = [
        'store_id',
        'name',
        'name_locale' ,
        'sub_category_id',
        // '' ,
        'description',
        'description_lcoale',
        'price',
        'new_price',
        'main_screen_image',
        'in_stock', //yes or no
        // 'onSale',
        // 'hot_price', //same on sale
    ];


    public function store(){
        return $this->belongsTo(Stroe::class,'store_id');
    }
    public function subCategory(){
        return $this->belongsTo(Category::class,'sub_cateory_id');
    }
    public function images(){
        return $this->hasMany(ItemImage::class);
    }

    public function attributes()
    { 
        return $this->belongsToMany(Attribute::class, AttributeItem::class);
    }
    public function CompulsoryChoices()
    { 
        return $this->belongsToMany(Compulsory_choice::class, CompulsoryChoiceItem::class);
    }

}
