<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'Harry Potter and the Sorcerer\'s Stone',
                'author_id' => 1, // Assuming J.K. Rowling has ID 1
                'description' => 'The first book in the Harry Potter series.',
                'published_date' => '1997-06-26',
            ],
            [
                'title' => 'A Game of Thrones',
                'author_id' => 2, // Assuming George R.R. Martin has ID 2
                'description' => 'The first book in the A Song of Ice and Fire series.',
                'published_date' => '1996-08-06',
            ],
            [
                'title' => 'The Fellowship of the Ring',
                'author_id' => 3, // Assuming J.R.R. Tolkien has ID 3
                'description' => 'The first book in The Lord of the Rings trilogy.',
                'published_date' => '1954-07-29',
            ],
        ]);
    }
}
