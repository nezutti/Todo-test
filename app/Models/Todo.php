<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

   

    protected $guarded=[
        "id"
    ];

 

    public static $rules=array(
       "content"=>"required|string|max:20"
    );

    public function tag(){
          return $this->belongsTo('App\Models\Tag');
    }


}
