<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institution extends Model
{
    use HasFactory;

    public function authors()
    {
        return $this->hasMany(Author::class);
    }

    public function researchPapers()
    {
        return $this->hasMany(ResearchPaper::class);
    }
}
