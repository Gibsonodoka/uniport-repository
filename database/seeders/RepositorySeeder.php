<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RepositorySeeder extends Seeder
{
    public function run(): void
    {
        $root = fn($name,$parent=null,$order=0,$desc=null) =>
            Category::firstOrCreate(
                ['slug' => Str::slug(($parent? $parent->slug.'-':'').$name)],
                ['name'=>$name,'parent_id'=>$parent?->id,'order'=>$order,'description'=>$desc]
            );

        $collections = $root('Collections');

        $students = $root('Student Research Works', $collections, 1);
        $fyp      = $root('Final Year Projects', $students, 1);
        foreach([2023,2024,2025] as $i=>$year){ $root((string)$year, $fyp, $i); }

        $tp = $root('Term Papers & Seminar Papers', $students, 2);
        foreach(['HIS 201','HIS 305','HIS 409'] as $i=>$code){ $root($code, $tp, $i); }

        $oral = $root('Oral Histories & Fieldwork', $collections, 2);
        $root('Audio / Video', $oral, 1);
        $root('Transcripts (PDFs)', $oral, 2);

        $faculty = $root('Faculty & Departmental Publications', $collections, 3);
        $root('Articles & Journals', $faculty, 1);
        $root('Conference Papers', $faculty, 2);

        $dept = $root('Departmental Records & Memory', $collections, 4);
        $root('Photo Gallery', $dept, 1);
        $root('Event Programs', $dept, 2);
        $root('Speeches & Announcements', $dept, 3);
    }
}
