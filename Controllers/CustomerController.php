<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();
        
        $data['customers'] = $customerModel->findAll();

        return view('customers/index', $data);
    }
}