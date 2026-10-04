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
        <a class="back-link" href="<?= site_url('users') ?>">
            ← Back to User Accounts
        </a>

        <section class="form-card">
            <p class="eyebrow">USER ACCOUNTS</p>
            <h1><?= esc($title) ?></h1>
            <p class="intro">Enter the user's account information below.</p>

            <?php if (session()->getFlashdata('upload_error')): ?>
                <p class="notice-error">
                    <?= esc(session()->getFlashdata('upload_error')) ?>
                </p>
            <?php endif; ?>

            <form
                action="<?= esc($action, 'attr') ?>"
                method="post"
                enctype="multipart/form-data"
            >
                <?= csrf_field() ?>

                <div class="field">
                    <label for="username">Username *</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= old('username', $user['username'] ?? '') ?>"
                        maxlength="50"
                        required
                    >
                    <?= validation_show_error('username') ?>
                </div>

                <div class="field">
                    <label for="full_name">Full name *</label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="<?= old('full_name', $user['full_name'] ?? '') ?>"
                        maxlength="150"
                        required
                    >
                    <?= validation_show_error('full_name') ?>
                </div>

                <?php if ($user !== null): ?>
                    <div class="field">
                        <label for="avatar">Profile picture</label>

                        <?php if (! empty($user['avatar'])): ?>
                            <p>Current picture:</p>
                            <img
                                class="avatar-preview"
                                src="<?= esc(
                                    base_url(
                                        'uploads/avatars/' .
                                        rawurlencode($user['avatar'])
                                    ),
                                    'attr'
                                ) ?>"
                                alt="Current profile picture"
                            >
                        <?php endif; ?>

                        <input
                            type="file"
                            id="avatar"
                            name="avatar"
                            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                        >

                        <p class="hint">Optional. JPG or PNG, up to 2 MB.</p>
                        <?= validation_show_error('avatar') ?>
                    </div>
                <?php endif; ?>

                <div class="form-actions">
                    <button class="button" type="submit">
                        <?= $user === null ? 'Add User' : 'Save Changes' ?>
                    </button>

                    <a class="button button-secondary"
                       href="<?= site_url('users') ?>">
                        Cancel
                    </a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>