<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            [
                'author_name' => 'J.K. Rowling',
                'bio' => 'British author, best known for the Harry Potter series.',
            ],
            [
                'author_name' => 'George R.R. Martin',
                'bio' => 'American novelist and short story writer, known for A Song of Ice and Fire.',
            ],
            [
                'author_name' => 'J.R.R. Tolkien',
                'bio' => 'English writer, best known for The Lord of the Rings.',
            ],
        ]);
    }
}
