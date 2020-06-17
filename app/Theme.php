<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'thumbnail', 'pdf'];

	public function videos() {

		return $this->belongsToMany('App\Video');

	}
}
