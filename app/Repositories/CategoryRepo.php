<?php

namespace App\Repositories;


use App\Models\Category;

class CategoryRepo
{

    public function create($data)
    {
        return Category::create($data);
    }

    public function getAll($order = 'name')
    {
        return Category::orderBy($order)->get();
    }

    public function getCategory($data)
    {
        return Category::where($data)->get();
    }

    public function update($id, $data)
    {
        return Category::find($id)->update($data);
    }

    public function find($id)
    {
        return Category::find($id);
    }


}
