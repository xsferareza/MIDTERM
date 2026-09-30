<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS - Record Sale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('products') ?>">POS System</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="<?= base_url('products') ?>">Products</a>
                <a class="nav-link active" href="<?= base_url('sales/create') ?>">Record Sale</a>
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
            <h3 class="mb-3">Record New Sale</h3>

            <!-- Alert Messages for Rejected Sales -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('sales/process') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Select Product</label>
                    <select name="product_id" class="form-select" required>
                        <option value="">-- Choose Product --</option>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= old('product_id') == $p['id'] ? 'selected' : '' ?>>
                                    <?= esc($p['name']) ?> - $<?= number_format($p['price'], 2) ?> (Stock: <?= $p['stock_quantity'] ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Customer (Optional)</label>
                    <select name="customer_id" class="form-select">
                        <option value="">-- Guest / Walk-in Customer --</option>
                        <?php if (!empty($customers)): ?>
                            <?php foreach ($customers as $c): ?>
                                <option value="<?= $c['id'] ?>" <?= old('customer_id') == $c['id'] ? 'selected' : '' ?>>
                                    <?= esc($c['full_name']) ?> (<?= esc($c['phone'] ?? 'N/A') ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" min="1" value="<?= old('quantity', 1) ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('products') ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Complete Sale</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>