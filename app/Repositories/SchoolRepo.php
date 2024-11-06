<?php

namespace App\Repositories;


use App\Models\School;

class SchoolRepo
{

    public function create($data)
    {
        return School::create($data);
    }

    public function getAll($order = 'name')
    {
        return School::orderBy($order)->get();
    }

    public function getSchool($data)
    {
        return School::where($data)->get();
    }

    public function update($id, $data)
    {
        return School::find($id)->update($data);
    }

    public function find($id)
    {
        return School::find($id);
    }


}
