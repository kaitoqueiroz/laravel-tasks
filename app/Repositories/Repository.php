<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function store()
    {
        return $this->model->store();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}
