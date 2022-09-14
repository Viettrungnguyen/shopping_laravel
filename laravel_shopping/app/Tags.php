<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    // protected $filable = ['name'];
    protected  $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tags', 'product_id', 'tags_id');
    }
}
