<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | TFA3 POS</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <main class="page">
        <a class="back-link" href="<?= site_url('customers') ?>">
            ← Back to Customer Accounts
        </a>

        <section class="form-card">
            <p class="eyebrow">CUSTOMER ACCOUNTS</p>
            <h1><?= esc($title) ?></h1>
            <p class="intro">Enter the customer's information below.</p>

            <form action="<?= esc($action, 'attr') ?>" method="post">
                <?= csrf_field() ?>

                <div class="field">
                    <label for="full_name">Full name *</label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="<?= old('full_name', $customer['full_name'] ?? '') ?>"
                        maxlength="150"
                        required
                    >
                    <?= validation_show_error('full_name') ?>
                </div>

                <div class="field">
                    <label for="email">Email *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= old('email', $customer['email'] ?? '') ?>"
                        maxlength="254"
                        required
                    >
                    <?= validation_show_error('email') ?>
                </div>

                <div class="field">
                    <label for="phone">Phone</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        value="<?= old('phone', $customer['phone'] ?? '') ?>"
                        maxlength="30"
                    >
                    <?= validation_show_error('phone') ?>
                </div>

                <div class="form-actions">
                    <button class="button" type="submit">
                        <?= $customer === null ? 'Add Customer' : 'Save Changes' ?>
                    </button>

                    <a class="button button-secondary"
                       href="<?= site_url('customers') ?>">
                        Cancel
                    </a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>