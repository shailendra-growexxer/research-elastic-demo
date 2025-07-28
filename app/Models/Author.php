<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function researchPapers()
    {
        return $this->belongsToMany(ResearchPaper::class, 'author_research_paper');
    }
}
