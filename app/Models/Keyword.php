<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keyword extends Model
{
    use HasFactory;

    public function researchPapers()
    {
        return $this->belongsToMany(ResearchPaper::class, 'keyword_research_paper');
    }
}
