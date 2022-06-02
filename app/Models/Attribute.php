<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_locale',
        'description',
        'description_locale',
    ];




    public function entries(){
        return $this->hasMany(Attribute_entry::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class , AttributeItem::class);
    }
}
