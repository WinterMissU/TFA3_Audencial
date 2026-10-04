<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Accounts | TFA3 POS</title>
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
            <span>02 / ACCOUNTS</span>
            <h1>User Accounts</h1>
            <p>User records from the POS database.</p>

            <a class="button" href="<?= site_url('users/new') ?>">
                + New User
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
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="5">No users yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <?php
                            $avatarFilename = basename(
                                (string) ($user['avatar'] ?? '')
                            );

                            $avatarExists = $avatarFilename !== ''
                                && is_file(
                                    FCPATH . 'uploads/avatars/' .
                                    $avatarFilename
                                );

                            $avatarUrl = $avatarExists
                                ? base_url(
                                    'uploads/avatars/' .
                                    rawurlencode($avatarFilename)
                                )
                                : base_url('images/avatar-placeholder.svg');
                            ?>

                            <tr>
                                <td>
                                    <img
                                        class="avatar"
                                        src="<?= esc($avatarUrl, 'attr') ?>"
                                        alt="Profile picture for <?= esc($user['full_name'], 'attr') ?>"
                                    >
                                </td>
                                <td><?= esc($user['username']) ?></td>
                                <td><?= esc($user['full_name']) ?></td>
                                <td><?= esc($user['created_at']) ?></td>
                                <td>
                                    <a
                                        class="row-link"
                                        href="<?= site_url('users/' . (int) $user['id'] . '/edit') ?>"
                                    >
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