<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'name', '', 'city_id'
    ];


    /**
     * Get the city for this area.
     */
    public function city()
    {
        return $this->hasOne(City::class);
    }


   
}
