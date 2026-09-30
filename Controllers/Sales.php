<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\SaleModel;

class Sales extends BaseController
{
    public function create()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $productModel  = new ProductModel();
        $customerModel = new CustomerModel();

        $data['products']  = $productModel->findAll();
        $data['customers'] = $customerModel->findAll();

        return view('sales/create', $data);
    }

    public function process()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $productId  = $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id') ?: null;
        $quantity   = (int) $this->request->getPost('quantity');
        
        // Ensure user_id from session exists, or fallback to an existing user ID (e.g., 1)
        $soldBy = session()->get('user_id') ?? 1;

        $productModel = new ProductModel();
        $product      = $productModel->find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Selected product does not exist.');
        }

        if ($product['stock_quantity'] < $quantity) {
            return redirect()->back()->with('error', 'Insufficient stock! Only ' . $product['stock_quantity'] . ' remaining.');
        }

        // Calculate total amount
        $totalAmount = $product['price'] * $quantity;

        // Record Sale using 'sold_by'
        $saleModel = new SaleModel();
        $saleModel->save([
            'product_id'   => $productId,
            'customer_id'  => $customerId,
            'sold_by'      => $soldBy,
            'quantity'     => $quantity,
            'total_amount' => $totalAmount,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        // Deduct product stock
        $newStock = $product['stock_quantity'] - $quantity;
        $productModel->update($productId, ['stock_quantity' => $newStock]);

        return redirect()->to('/sales/history')->with('success', 'Sale recorded successfully!');
    }

    public function history()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('sales');
        $builder->select('sales.*, products.name as product_name, customers.full_name as customer_name, users.full_name as staff_name');
        $builder->join('products', 'products.id = sales.product_id', 'left');
        $builder->join('customers', 'customers.id = sales.customer_id', 'left');
        $builder->join('users', 'users.id = sales.sold_by', 'left');
        $builder->orderBy('sales.created_at', 'DESC');

        $data['sales'] = $builder->get()->getResultArray();

        return view('sales/history', $data);
    }

    public function edit($id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $saleModel     = new SaleModel();
        $productModel  = new ProductModel();
        $customerModel = new CustomerModel();

        $data['sale']      = $saleModel->find($id);
        $data['products']  = $productModel->findAll();
        $data['customers'] = $customerModel->findAll();

        if (!$data['sale']) {
            return redirect()->to('/sales/history')->with('error', 'Sale record not found.');
        }

        return view('sales/edit', $data);
    }

    public function update($id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $saleModel    = new SaleModel();
        $productModel = new ProductModel();

        $existingSale = $saleModel->find($id);
        if (!$existingSale) {
            return redirect()->to('/sales/history')->with('error', 'Sale record not found.');
        }

        $productId  = $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id') ?: null;
        $quantity   = (int) $this->request->getPost('quantity');

        $product = $productModel->find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Selected product does not exist.');
        }

        $totalAmount = $product['price'] * $quantity;

        // Update the sale record
        $saleModel->update($id, [
            'product_id'   => $productId,
            'customer_id'  => $customerId,
            'quantity'     => $quantity,
            'total_amount' => $totalAmount,
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/sales/history')->with('success', 'Sale updated successfully!');
    }
}