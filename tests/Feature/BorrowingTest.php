<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BorrowingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_borrow_book_if_stock_is_zero()
    {
        $user = User::factory()->create();

        $book = Book::factory()->create([
            'stock' => 0
        ]);

        $response = $this->actingAs($user)->post('/borrowings', [
            'book_id' => $book->id
        ]);

        $response->assertSessionHasErrors();

        $this->assertDatabaseCount('borrowings', 0);
    }
}
