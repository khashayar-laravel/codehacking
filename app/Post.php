<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=["photo_id","user_id","title","body","category_id"];

	public function user(){
		return $this->belongsTo("App\User");
	}
	public function photo(){
		return $this->belongsTo("App\Photo");
	}

	public function category(){
		return $this->belongsTo("App\Category");
	}
}

