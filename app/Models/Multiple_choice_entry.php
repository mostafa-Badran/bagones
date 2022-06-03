
<?php

namespace App\Models;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multiple_choice_entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_locale',
        'multiple_choice_id'
    ];

    public function Multipule_choice(){
        return $this->belongsTo(Multiple_choice::class, 'multiple_choice_id');
    }
}