<?php

namespace App\Models;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute_entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_locale',
        'attribute_id'
    ];




    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
