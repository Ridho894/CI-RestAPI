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
}
