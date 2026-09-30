<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS - Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('products') ?>">POS System</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link active" href="<?= base_url('products') ?>">Products</a>
                <a class="nav-link" href="<?= base_url('customers') ?>">Customers</a>
                <a class="nav-link" href="<?= base_url('users') ?>">Staff</a>
                <a class="nav-link" href="<?= base_url('sales/create') ?>">Record Sale</a>
                <a class="nav-link" href="<?= base_url('sales/history') ?>">Sales History</a>
            </div>
            <div class="text-white me-3">
                Welcome, <?= esc(session()->get('full_name') ?? 'User') ?>
            </div>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Products List</h2>
            <a href="<?= base_url('products/create') ?>" class="btn btn-primary">+ Add Product</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products) && is_array($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= esc($product['id']) ?></td>
                                    <td>
    <?php if (!empty($product['image']) && file_exists(FCPATH . 'uploads/' . $product['image'])): ?>
        <img src="<?= base_url('uploads/' . esc($product['image'])) ?>" 
             alt="<?= esc($product['name']) ?>" 
             style="width: 50px; height: 50px; object-fit: cover;" 
             class="rounded border">
    <?php else: ?>
        <span class="text-muted">No Image</span>
    <?php endif; ?>
</td>
                                    <td><?= esc($product['name']) ?></td>
                                    <td>$<?= number_format($product['price'], 2) ?></td>
                                    <td><?= esc($product['stock_quantity']) ?></td>
                                    <td>
                                        <a href="<?= base_url('products/edit/' . $product['id']) ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                                        <a href="<?= base_url('products/delete/' . $product['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-3">No products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>