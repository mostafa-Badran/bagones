<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compulsory_choice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_locale',
        'description',
        'description_locale',
    ];




    public function entries(){
        return $this->hasMany(Compulsory_choice_entry::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class , CompulsoryChoiceItem::class);
    }
}
