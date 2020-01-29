<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Subscription;
use App\Repositories\CustomersRepository;

class CustomersController extends Controller
{
    protected $model;

    public function __construct(Customer $model)
    {
        $this->model = new CustomersRepository($model);
    }

    public function index()
    {
        return $this->model->all();
    }

    public function show(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function allCustomersWithLastPaidOrder()
    {
        return $this->model->withLastPaidOrder();
    }

    public function allCustomersWithMoreThanOnePaidOrder()
    {
        return $this->model->withMoreThanOnePaidOrder();
    }

    public function allCustomersWithActiveSubscriptionAndPaidOrder()
    {
        return $this->model->withActiveSubscriptionAndPaidOrder();
    }
}
