<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name', 'slug', 'link', 'slug', 'description'];

    //fonction pour lier les videos aux themes
    public function tags() {

		return $this->belongsToMany('App\Tag');
	}
}
