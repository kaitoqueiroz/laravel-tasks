<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use DB;
use App\Http\Requests\SetIterationFrequencyRequest;
use App\Repositories\SubscriptionsRepository;

class SubscriptionsController extends Controller
{
    public function index()
    {
        return Subscription::all();
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
}
