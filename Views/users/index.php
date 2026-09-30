<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS - Staff List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('products') ?>">POS System</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="<?= base_url('products') ?>">Products</a>
                <a class="nav-link" href="<?= base_url('customers') ?>">Customers</a>
                <a class="nav-link active" href="<?= base_url('users') ?>">Staff</a>
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
            <h2>Staff Management</h2>
            <a href="<?= base_url('users/create') ?>" class="btn btn-primary">+ Add Staff Member</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-striped bg-white shadow-sm align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td>
    <?php if (!empty($u['avatar']) && file_exists(FCPATH . 'uploads/avatars/' . $u['avatar'])): ?>
        <img src="<?= base_url('uploads/avatars/' . $u['avatar']) ?>" alt="Avatar" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
    <?php elseif (!empty($u['avatar']) && file_exists(FCPATH . 'uploads/' . $u['avatar'])): ?>
        <img src="<?= base_url('uploads/' . $u['avatar']) ?>" alt="Avatar" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
    <?php else: ?>
        <span class="badge bg-secondary">No Avatar</span>
    <?php endif; ?>
</td>
                            <td class="text-start"><?= esc($u['username']) ?></td>
                            <td class="text-start"><?= esc($u['full_name']) ?></td>
                            <td><?= date('M d, Y', strtotime($u['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No staff members found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>