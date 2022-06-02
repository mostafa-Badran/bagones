<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_locale',
        'slogan',
        'slogan_locale',
        'location_text',
        'location_text_locale',
        'phone_number',
        'delivery_time_range',
        'image',
        'cover_image',
        'is_open',
        'allow_add_hot_price',
        'google_map_link',
        'area_id'
    ];


    //store area location
    public function area()
    {
        return $this->belongsTo(Area::class , 'area_id');
    }

    //store delivey areas

public function deliveryAreas()
    { 
        return $this->belongsToMany(Area::class, AreaStore::class);
    }

    // public function items()
    // {
    //     return $this->haveMany(Item::class);
    // }
    public function items(){
        return $this->hasMany(Item::class);
    }



}
