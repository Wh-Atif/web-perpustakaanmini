<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@perpus.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'user@perpus.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@perpus.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        $categories = ['Fiksi', 'Sains', 'Sejarah', 'Teknologi', 'Biografi'];
        $catIds = [];
        
        foreach ($categories as $catName) {
            $createdCat = Category::create(['name' => $catName]);
            $catIds[] = $createdCat->id;
        }

        $booksData = [
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'year' => 2005, 'cat_idx' => 0],
            ['title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'year' => 1980, 'cat_idx' => 2],
            ['title' => 'The Pragmatic Programmer', 'author' => 'Andrew Hunt', 'year' => 1999, 'cat_idx' => 3],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'year' => 2008, 'cat_idx' => 3],
            ['title' => 'Sapiens: Riwayat Singkat Umat Manusia', 'author' => 'Yuval Noah Harari', 'year' => 2011, 'cat_idx' => 2],
            ['title' => 'Harry Potter dan Batu Bertuah', 'author' => 'J.K. Rowling', 'year' => 1997, 'cat_idx' => 0],
            ['title' => 'Fisika Dasar Jilid 1', 'author' => 'Halliday & Resnick', 'year' => 2010, 'cat_idx' => 1],
            ['title' => 'Steve Jobs', 'author' => 'Walter Isaacson', 'year' => 2011, 'cat_idx' => 4],
        ];

        foreach ($booksData as $book) {
            Book::create([
                'title' => $book['title'],
                'author' => $book['author'],
                'year' => $book['year'],
                'stock' => rand(2, 10),
                'category_id' => $catIds[$book['cat_idx']],
            ]);
        }

        $cleanCode = Book::where('title', 'Clean Code')->first();
        
        Borrowing::create([
            'user_id' => $user1->id,
            'book_id' => $cleanCode->id,
            'borrow_date' => now()->subDays(2), 
            'return_deadline' => now()->addDays(5),
            'status' => 'BORROWED',
        ]);
        $cleanCode->decrement('stock');

        $laskar = Book::where('title', 'Laskar Pelangi')->first();

        Borrowing::create([
            'user_id' => $user2->id,
            'book_id' => $laskar->id,
            'borrow_date' => now()->subDays(10),
            'return_deadline' => now()->subDays(3),
            'return_date' => now()->subDays(1),
            'status' => 'RETURNED',
        ]);
    }
}