<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'description',
        'image',
        'status',
    ];

    // public function scopeActive(Builder $builder)
    // {
    //     $builder->where('status' ,'=' , 'inactive');
    // }
    public function scopeFilter(Builder $builder ,$filter)
    {
        $builder->when($filter['name'] ?? false ,fn($builder , $value) => $builder->where('name' , 'LIKE' , "%{$value}%"));
        $builder->when($filter['status']?? false , fn($builder , $value) => $builder->where('status',$value));
    }
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children(){
        return $this->hasMany(Category::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
