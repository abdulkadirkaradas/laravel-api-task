<?php

namespace App\Http\Controllers\Api;

use App\Events\LogCreated;
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
        $body = json_decode($request->getContent());
        $params = [
            "name" => $body->name ?? "",
            "description" => $body->description ?? "",
            "publishing_date" => $body->publishing_date ?? "",
        ];

        $book = Books::find($body->id);
        foreach($params as $key => $value)
        {
            if($value != "")
            {
                $book->$key = $value;
            }
        }
        $book->save();
        event(new LogCreated($book));
        return $book;
    }

    public function delete(Request $request)
    {

    }
}
