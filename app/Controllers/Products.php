<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class Products extends ResourceController
{
    use ResponseTrait;
    // Get All Product
    public function index()
    {
        $model = new ProductModel();
        $data = $model->findAll();
        return $this->respond(['data' => $data], 200);
    }

    // Get Specific Product
    public function show($id = null)
    {
        $model = new ProductModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    // Update Product
    public function update($id = null)
    {
        $model = new ProductModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'name' => $json->name,
                'price' => $json->price,
                'stock' => $json->stock,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'name' => $input['name'],
                'price' => $input['price'],
                'stock' => $input['stock'],
            ];
        }
        // Insert to Database
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    // Delete Product
    public function delete($id = null)
    {
        $model = new ProductModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }
}
