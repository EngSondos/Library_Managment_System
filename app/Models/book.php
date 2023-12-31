<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class book extends Model
{
    use HasFactory;
    protected $table='books';
    protected $fillable=['name','author','category','image','description'];

    public function author(){
        return $this->belongsTo(author::class,'author_id','id');
    }

    public function category(){
        return $this->belongsTo(category::class,'category_id','id');
    }
    use SoftDeletes;

  

}
