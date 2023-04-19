<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ["title", "languages", "pic", "description", "link", "type_id"];

    //* Relazione

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function getImageUri()
    {
        return $this->pic ? asset('storage/' . $this->pic) : 'https://thumbs.dreamstime.com/b/no-image-available-icon-vector-illustration-flat-design-140476186.jpg';
    }
}
