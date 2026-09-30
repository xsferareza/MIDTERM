<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Products extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $data['products'] = $db->table('products')->get()->getResultArray();

        return view('products/index', $data);
    }
}