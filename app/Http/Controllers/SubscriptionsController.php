<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use DB;

class SubscriptionsController extends Controller
{
    public function index()
    {
        return Subscription::all();
    }
}
