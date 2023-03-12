<?php

namespace App\Jobs;

use App\Models\Books;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(): void
    {
        Books::find($this->id)->delete();
    }
}
