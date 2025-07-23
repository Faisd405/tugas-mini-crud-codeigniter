<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Faisal E Library' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('/') ?>">
                <i class="fas fa-book"></i> Faisal E Library
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == '' || uri_string() == 'library' ? 'active' : '' ?>" href="<?= site_url('library') ?>">
                            <i class="fas fa-home"></i> Library
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'feedback' ? 'active' : '' ?>" href="<?= site_url('feedback') ?>">
                            <i class="fas fa-comments"></i> Feedback
                        </a>
                    </li>
                </ul>
                
                <!-- User Menu -->
                <?php if (session()->get('isLoggedIn')): ?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <?php if (session()->get('user_profile_picture')): ?>
                                    <img src="<?= base_url('writable/uploads/profiles/' . session()->get('user_profile_picture')) ?>" 
                                         alt="Profile" 
                                         class="rounded-circle me-1" 
                                         style="width: 25px; height: 25px; object-fit: cover;">
                                <?php else: ?>
                                    <i class="fas fa-user-circle me-1"></i>
                                <?php endif; ?>
                                <?= session()->get('user_name') ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item <?= uri_string() == 'profile' ? 'active' : '' ?>" href="<?= site_url('profile') ?>">
                                        <i class="fas fa-user"></i> My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('profile/edit') ?>">
                                        <i class="fas fa-edit"></i> Edit Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <?php if (session()->get('user_role') === 'admin'): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('admin/dashboard') ?>">
                                            <i class="fas fa-cogs"></i> Admin Panel
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <div class="d-flex">
                        <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-light me-2">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="<?= site_url('auth/register') ?>" class="btn btn-light">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
            <i class="fas fa-exclamation-circle"></i> 
            <?php if (is_array(session()->getFlashdata('error'))): ?>
                <?php foreach (session()->getFlashdata('error') as $error): ?>
                    <?= $error ?><br>
                <?php endforeach; ?>
            <?php else: ?>
                <?= session()->getFlashdata('error') ?>
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <!-- Main Content -->
    <?= $this->renderSection('content') ?>
    
    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?= date('Y') ?> Faisal E Library. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <small class="text-muted">Created with CodeIgniter 4</small>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Auto-hide alerts after 5 seconds -->
    <script>
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                if (alert.classList.contains('show')) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            });
        }, 5000);
    </script>
</body>
</html>
