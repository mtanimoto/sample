<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CarsModel;

class Cars extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new CarsModel();
        $cars = $model->where('status', 'onsale')->orderBy('created_at, id')->findAll();
        return $this->respond($cars);
    }

    public function show($id = null)
    {
        $model = new CarsModel();
        $car = $model->where(['status' => 'onsale', 'id' => $id])->findAll();
        return $this->respond($car);
    }

    public function create()
    {
        try {
            helper(['form', 'url']);

            if (!$this->validate([
                'type' => 'required',
                'price' => 'required|numeric|max_length[32]',
                'color' => 'required',
            ])) {
                $response = [
                    'status'   => 422,
                    'error'    => true,
                    'messages' => [
                        'validation' => $this->validator->getErrors(),
                    ],
                ];
                return $this->respondCreated($response);
            }

            helper('text');
            $data = [
                'id' => random_string('md5'),
                'type'  => $this->request->getVar('type'),
                'price'  => $this->request->getVar('price'),
                'color'  => $this->request->getVar('color'),
                'remark'  => $this->request->getVar('remark'),
            ];

            log_message('debug', print_r($data, true));

            $model = new CarsModel();
            $model->insert($data);

            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Car created successfully'
                ],
                'data'     => $data,
            ];
            return $this->respondCreated($response);
        } catch (Exception $e) {
            log_message('error', print_r($e, true));

            $response = [
                'status'   => 500,
                'error'    => $e,
                'messages' => [
                    'failure' => "Car created unsuccessfully",
                ],
            ];
            return $this->respondCreated($response);
        }
    }

    public function update($id = null)
    {
        $model = new CarsModel();
        $data = [
            'status' => 'sold',
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Cars updated successfully'
            ]
        ];
        return $this->respond($response);
    }
}
