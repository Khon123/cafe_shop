<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $category
 */
class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Category', 'cat_id');
    }
}
