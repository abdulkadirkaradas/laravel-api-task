<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Books extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = "books";
    private $array = [];

    protected $keyType = "string";
    public $incrementing = false;
    public $primaryKey = "id";
    public static function boot() {
        parent::boot();
        static::creating(function($model) {
            $model->id = (string)Str::uuid();
        });
    }

    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    protected $fillable = [
        "name",
        "description",
        "publishing_date",
        "author_id",
    ];

    public function getBooksWithAuthor()
    {
        return Cache::remember('booksWithAuthors', 10, function() {
            $authors = Authors::all();
            $books = $this->all();

            foreach($authors as $key => $author) {
                foreach($books as $k => $book) {
                    if($author->id == $book->author_id) {
                        $this->array[] = $book;
                    }
                }
                $author->books = $this->array;
                $this->array = [];
            }
            return $authors;
        });
    }
}
