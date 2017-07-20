<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property mixed $products
 */
class Category extends Model
{
    public function products(){
        return $this->hasMany('App\Product');
    }
}
