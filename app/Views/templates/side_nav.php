<div class="col-md-3 col-lg-2 sidebar">
    <div class="py-4 px-3">
        <h2 class="text-white">Admin Panel</h2>
        <?php if (session()->get('isLoggedIn')): ?>
        <div class="text-white-50 mb-2">Welcome, <?= session()->get('username') ?></div>
        <?php endif; ?>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="<?= site_url('admin/dashboard') ?>" class="<?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/book') ?>" class="<?= strpos(uri_string(), 'admin/book') === 0 ? 'active' : '' ?>">
                <i class="fas fa-book me-2"></i> Books
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/article') ?>" class="<?= strpos(uri_string(), 'admin/article') === 0 ? 'active' : '' ?>">
                <i class="fas fa-newspaper me-2"></i> Articles
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/feedback') ?>" class="<?= strpos(uri_string(), 'admin/feedback') === 0 ? 'active' : '' ?>">
                <i class="fas fa-comments me-2"></i> Feedback
            </a>
        </li>
        <li class="nav-item mt-4">
            <a href="<?= site_url('auth/logout') ?>" class="text-danger">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </li>
    </ul>
</div>
<div class="col-md-9 col-lg-10 content-wrapper">
