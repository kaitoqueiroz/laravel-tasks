<?php

namespace App\Http\Controllers;

use App\Repositories\DeliveriesRepository;

class DeliveriesController extends Controller
{
    protected $model;

    public function __construct(Customer $model)
    {
        $this->model = new DeliveriesRepository($model);
    }

    public function store()
    {
        return $this->model->store();
    }
}
