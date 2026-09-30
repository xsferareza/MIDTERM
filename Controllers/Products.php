<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    public function index()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();

        return view('products/index', $data);
    }

    public function create()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        return view('products/create');
    }

    public function store()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $imageName = null;

        // Handle file upload automatically
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName(); // Generates a unique filename automatically
            $image->move(FCPATH . 'uploads', $imageName); // Automatically moves file to public/uploads/
        }

        $productModel->save([
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $imageName,
        ]);

        return redirect()->to('/products')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $data['product'] = $productModel->find($id);

        if (!$data['product']) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }

        return view('products/edit', $data);
    }

    public function update($id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }

        $updateData = [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];

        // Handle new file upload automatically on edit
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old uploaded image if present
            if (!empty($product['image']) && file_exists(FCPATH . 'uploads/' . $product['image'])) {
                unlink(FCPATH . 'uploads/' . $product['image']);
            }

            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads', $imageName);
            $updateData['image'] = $imageName;
        }

        $productModel->update($id, $updateData);

        return redirect()->to('/products')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if ($product) {
            if (!empty($product['image']) && file_exists(FCPATH . 'uploads/' . $product['image'])) {
                unlink(FCPATH . 'uploads/' . $product['image']);
            }
            $productModel->delete($id);
        }

        return redirect()->to('/products')->with('success', 'Product deleted successfully.');
    }
}