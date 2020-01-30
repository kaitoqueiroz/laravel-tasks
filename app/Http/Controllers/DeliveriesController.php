<?php

namespace App\Http\Controllers;

use App\Repositories\DeliveriesRepository;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Collection;
use League\Csv\Writer;
use Schema;
use Storage;
use SplTempFileObject;

class DeliveriesController extends Controller
{
    protected $model;

    public function __construct(Delivery $model)
    {
        $this->model = new DeliveriesRepository($model);
    }

    public function index()
    {
        return Delivery::all();
    }

    public function exportCsv()
    {
        $fileName = 'deliveries';
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(Schema::getColumnListing($fileName));

        $deliveries = Delivery::all();
        foreach ($deliveries as $delivery){
            $csv->insertOne($delivery->toArray());
        }
        $csv->output($fileName . '.csv');
    }
}
