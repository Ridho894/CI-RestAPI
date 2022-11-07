<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class Products extends ResourceController
{
    use ResponseTrait;
    // Get All Product
    public function index(){
        $model = new ProductModel();
        $data = $model->findAll();
        return $this->respond($data,200);
    }
}
