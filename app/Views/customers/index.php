<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Accounts | TFA3 POS</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <main class="container">
        <nav>
            <strong>POS / ACCOUNTS</strong>
            <div>
                <a href="<?= site_url('customers') ?>">Customers</a>
                <a href="<?= site_url('users') ?>">Users</a>
            </div>
        </nav>

        <header>
            <span>01 / ACCOUNTS</span>
            <h1>Customer Accounts</h1>
            <p>Customer records from the POS database.</p>

            <a class="button" href="<?= site_url('customers/new') ?>">
                + New Customer
            </a>
        </header>

        <?php if (session()->getFlashdata('success')): ?>
            <p class="notice-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </p>
        <?php endif; ?>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($customers)): ?>
                        <tr>
                            <td colspan="5">No customers yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= esc($customer['full_name']) ?></td>
                                <td><?= esc($customer['email']) ?></td>
                                <td><?= esc($customer['phone'] ?? '') ?></td>
                                <td><?= esc($customer['created_at']) ?></td>
                                <td>
                                    <a class="row-link"
                                       href="<?= site_url('customers/' . (int) $customer['id'] . '/edit') ?>">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>