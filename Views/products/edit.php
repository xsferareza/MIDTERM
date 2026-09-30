<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('products') ?>">POS System</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="<?= base_url('products') ?>">Products</a>
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

    <div class="container" style="max-width: 600px;">
        <div class="card shadow-sm p-4">
            <h3 class="mb-3">Edit Product</h3>

            
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?= esc($product['name'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="<?= esc($product['price'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock Quantity</label>
                    <input type="number" name="stock_quantity" class="form-control" value="<?= esc($product['stock_quantity'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <?php if (!empty($product['image'])): ?>
                        <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="Product Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px;" class="mb-2">
                    <?php else: ?>
                        <p class="text-muted">No image uploaded.</p>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Leave empty to keep current image.</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('products') ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Update Product</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>