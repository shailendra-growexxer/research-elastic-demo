<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResearchPaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutionIds = \App\Models\Institution::pluck('id')->all();
        $authorIds = \App\Models\Author::pluck('id')->all();
        $keywordIds = \App\Models\Keyword::pluck('id')->all();

        \App\Models\ResearchPaper::factory(5000)->make()->each(function ($paper) use ($institutionIds, $authorIds, $keywordIds) {
            $paper->institution_id = fake()->randomElement($institutionIds);
            $paper->save();
            $paper->authors()->attach(fake()->randomElements($authorIds, rand(2, 5)));
            $paper->keywords()->attach(fake()->randomElements($keywordIds, rand(3, 8)));
        });
    }
}
