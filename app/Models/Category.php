<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_locale',
        'image',
        'parent_id',
    ];


    public function get_childern()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function get_parent()
    {
        // if($this->parent_id == 0){
        //     // return t
        // }
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

}
