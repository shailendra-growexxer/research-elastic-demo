<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class ResearchPaper extends Model
{
    use HasFactory, Searchable;

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_research_paper');
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'keyword_research_paper');
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'abstract' => $this->abstract,
            'publication_date' => $this->publication_date,
            'institution_name' => $this->institution->name ?? '',
            'institution_country' => $this->institution->country ?? '',
            'authors' => $this->authors->pluck('name')->toArray(),
            'keywords' => $this->keywords->pluck('word')->toArray(),
        ];
    }
}
