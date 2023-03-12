<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BooksController extends Controller
{
    private $book;

    public function __construct()
    {
        $this->book = new Books();
    }

    public function read(Request $request)
    {
        $this->book->getBooksWithAuthor();
        return Cache::get("booksWithAuthors");
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}
