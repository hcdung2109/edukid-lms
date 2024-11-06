<?php

namespace App\Repositories;


use App\Models\Book;

class BookRepo
{

    public function create($data)
    {
        return Book::create($data);
    }

    public function getAll($order = 'name')
    {
        return Book::orderBy($order)->get();
    }

    public function getBook($data)
    {
        return Book::where($data)->get();
    }

    public function update($id, $data)
    {
        return Book::find($id)->update($data);
    }

    public function find($id)
    {
        return Book::find($id);
    }


}
