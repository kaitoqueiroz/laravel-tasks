<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Subscription;
use App\Repositories\CustomersRepository;
use App\Repositories\SubscriptionsRepository;
use App\Http\Requests\SetIterationFrequencyRequest;

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

    public function setIterationFrequency(SetIterationFrequencyRequest $request)
    {
        $bodyRequest = json_decode($request->getContent());
        $subscription = Subscription::where('customer_id', $bodyRequest->customer_id)->first();

        if (!$subscription)
        {
            return response()->json(
                [ 'message' => 'Subscription not found for this customer!' ],
                404
            );
        }
        $subscriptionRepository = new SubscriptionsRepository($subscription);
        $subscriptionRepository->setDayIteration($bodyRequest->frequency);

        return response()->json(['message' => 'Iteration frequency updated successfully.']);
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
