<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['name', 'description'];
//, 'num_books'

public function books(): HasManyThrough
    {
        return $this->hasManyThrough(Books::class);
    }
}
