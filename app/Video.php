<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Video extends Model

{

    protected $guarded = [];

    protected $fillable = ['name', 'slug', 'link', 'pdf', 'description'];

    //fonction pour lier les videos aux themes
    public function themes() {

		return $this->belongsToMany('App\Theme');
	}
}
