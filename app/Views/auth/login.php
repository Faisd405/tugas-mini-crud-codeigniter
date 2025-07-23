<?= $this->extend('templates/public') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="h4 mb-2">Admin Login</h2>
                        <p class="text-muted">Enter your credentials to access the admin area</p>
                    </div>
                    
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= site_url('auth/login') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" 
                                       class="form-control <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : '' ?>" 
                                       id="username" 
                                       name="username" 
                                       value="<?= old('username') ?>"
                                       required 
                                       autofocus>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" 
                                       class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>" 
                                       id="password" 
                                       name="password" 
                                       required>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-3">
                        <p class="mb-0">
                            <a href="<?= site_url('/') ?>" class="text-decoration-none">
                                <i class="fas fa-arrow-left"></i> Back to Homepage
                            </a>
                        </p>
                        <p class="mt-2 mb-0">
                            <small class="text-muted">
                                Don't have an account? 
                                <a href="<?= site_url('auth/register') ?>" class="text-decoration-none">Register here</a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
