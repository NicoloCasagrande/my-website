<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    use HasFactory;

    protected $guarded =['slug'];  
    protected $appends = ['image_url'];

    protected function getImageUrlAttribute(){
        return $this->cover_image ? asset("storage/$this->cover_image") : "https://via.placeholder.com/300x300.png";
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function field(){
        return $this->belongsTo(Field::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

}
