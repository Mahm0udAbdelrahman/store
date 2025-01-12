<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];


    public $timestamps = false;

    public function products()
    {
        $this->belongsToMany(
            Product::class,
            'product_tag',
            'tag_id',
            'product_id',
            'id',
            'id'
        );
    }

}
