<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use    HasFactory, SoftDeletes;
    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'options',
        'featured',
        'status',
    ];
    public function scopeFilter(Builder $builder ,$filter)
    {
        $builder->when($filter['name'] ?? false ,fn($builder , $value) => $builder->where('name' , 'LIKE' , "%{$value}%"));
        $builder->when($filter['status']?? false , fn($builder , $value) => $builder->where('status',$value));
    }
    // protected static function booted()
    // {
    //     static::addGlobalScope('store', function(Builder $builder){
    //         $user = Auth::user();
    //         if($user->store_id)
    //         {
    //             $builder->where('store_id','=',$user->store_id);
    //         }
    //     });
    // }

     protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
        
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    // public function tags()
    // {
    //     $this->belongsToMany(
    //         Tag::class,
    //         'product_tag',
    //         'product_id',
    //         'tag_id',
    //         'id',
    //         'id'
    //     );
    // }
    public function tags()
{
    return $this->belongsToMany(Tag::class);
}

  public function ScopeActive(Builder $builder)
  {
        $builder->where('status','active');
  }

  public function getImageUrlAttribute()
  {
    if(!$this->image)
    {
        return 'https://coffective.com/wp-content/uploads/2018/06/default-featured-image.png.jpg';
    }
    if(Str::startsWith($this->image ,['https://','http://'])){
        return $this->image;
    }
    return asset('storage/'. $this->image);
  }

  public function getSalePercentAttribute()
  {
    if(!$this->compare_price)
    {
        return 0;
    }

    return  number_format(100*($this->price /$this->compare_price) , 1);
  }
}
