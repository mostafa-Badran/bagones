<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stroe;
use App\Models\Attribute;


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
        'description_locale',
        'price',
        'new_price',
        'main_screen_image',
        'cover_image',
        'in_stock', //yes or no
        // 'onSale',
        // 'hot_price', //same on sale
    ];


    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
    public function subCategory(){
        return $this->belongsTo(Category::class,'sub_category_id');
    }
    public function images(){
        return $this->hasMany(ItemImage::class);
    }

    public function attributes()
    { 
        return $this->belongsToMany(Attribute::class, AttributeItem::class);
    }
    public function compulsoryChoices()
    { 
        return $this->belongsToMany(Compulsory_choice::class, CompulsoryChoiceItem::class);
    }
    public function multipleChoices()
    { 
        return $this->belongsToMany(Multiple_choice::class, MultipleChoiceItem::class);
    }

    public function getByLang($lang)
    {
        
        $data = [
            'id'=>$this->id,
            'name'=> $lang == 'en' ? $this->name : $this->name_locale,
            'sub_category_id' => $this->sub_category_id,
            'sub_category_name' => $lang == 'en' ? $this->subCategory->name : $this->subCategory->name_locale ,
            'description' => $lang == 'en' ? $this->description : $this->description_locale,
            'price'  =>$this->price,
            'new_price' =>$this->new_price,
            'main_screen_image' =>$this->main_screen_image != null ?  asset('uploads/items/'.$this->main_screen_image) : $this->main_screen_image,
            'cover_image' =>$this->cover_image != null ?  asset('uploads/items/'.$this->cover_image) : $this->cover_image,
            'in_stock'=>$this->in_stock,            
            'store' => $this->store->getByLang($lang),
            // 'attributes' => $this->attributes,
            // 'compulsory_choices' => $this->compulsoryChoices->getByLang($lang),
            // 'multiple_choices' => $this->multipleChoices->getByLang($lang),
        ];

        return $data;


    }

   public function  getAttributesByLang($lang){
    //    $result=[]
        // return $this->compulsoryChoices[0];
        // return $this->attributes[0];
    // $post = Attribute::find(1);
    // $attribute = Attribute::find(7)->get() ;//->getByLang($lang); //; $attribute->getByLang($lang);
    // dd($post);
        // foreach($this->attributes as $attribute){
        //     // $data=[
        //         $attribute = Attribute::find($attribute) ;//->getByLang($lang); //; $attribute->getByLang($lang);
        //         dd($attribute);
        //         // $attribute['entries']
        //     // ]
        // }
        // return $this->attributes;
    }

}
