<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = array('id');
    public $timestamps = true;

    protected $fillable = [
        'cat', 'created_at', 'updated_at'
    ];
}
