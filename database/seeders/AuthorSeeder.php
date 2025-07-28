<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutionIds = \App\Models\Institution::pluck('id')->all();
        \App\Models\Author::factory(2000)->make()->each(function ($author) use ($institutionIds) {
            $author->institution_id = fake()->randomElement($institutionIds);
            $author->save();
        });
    }
}
