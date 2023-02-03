<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded =['slug'];  

    protected function getImageAttribute(){
        return $this->cover_image ? asset("storage/$this->cover_image") : "null";
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
