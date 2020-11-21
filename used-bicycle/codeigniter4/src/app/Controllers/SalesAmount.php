<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CarsModel;

class SalesAmount extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new CarsModel();
        $result = $model->selectSum('price')->where('status', 'sold')->find();
        $salesAmount = $result[0]['price'] ?? 0;
        return $this->respond(['salesAmount' => $salesAmount]);
    }
}
