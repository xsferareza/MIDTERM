<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS - Sales History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('products') ?>">POS System</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="<?= base_url('products') ?>">Products</a>
                <a class="nav-link" href="<?= base_url('customers') ?>">Customers</a>
                <a class="nav-link" href="<?= base_url('users') ?>">Staff</a>
                <a class="nav-link" href="<?= base_url('sales/create') ?>">Record Sale</a>
                <a class="nav-link active" href="<?= base_url('sales/history') ?>">Sales History</a>
            </div>
            <div class="text-white me-3">
                Welcome, <?= esc(session()->get('full_name') ?? 'User') ?>
            </div>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Sales History Log</h2>
            <a href="<?= base_url('sales/create') ?>" class="btn btn-success">+ Record New Sale</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-striped bg-white shadow-sm align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Sold By (Staff)</th>
                    <th>Qty</th>
                    <th>Total Amount</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sales)): ?>
                    <?php foreach ($sales as $s): ?>
                        <tr>
                            <td><?= $s['id'] ?></td>
                            <td class="text-start"><?= esc($s['product_name'] ?? 'Unknown Product') ?></td>
                            <td class="text-start">
                                <?= !empty($s['customer_name']) ? esc($s['customer_name']) : '<span class="text-muted">Guest / Walk-in</span>' ?>
                            </td>
                            <td><?= esc($s['staff_name'] ?? 'System') ?></td>
                            <td><?= $s['quantity'] ?></td>
                            <td>$<?= number_format($s['total_amount'], 2) ?></td>
                            <td><?= date('M d, Y h:i A', strtotime($s['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">No sales recorded yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>