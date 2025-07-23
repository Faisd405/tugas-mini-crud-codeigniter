<?= $this->extend('templates/public') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Register for Digital Library</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('auth/register') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>" 
                                   id="name" 
                                   name="name" 
                                   value="<?= old('name') ?>" 
                                   required>
                            <?php if (isset($validation) && $validation->hasError('name')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : '' ?>" 
                                   id="username" 
                                   name="username" 
                                   value="<?= old('username') ?>" 
                                   required>
                            <?php if (isset($validation) && $validation->hasError('username')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" 
                                   id="email" 
                                   name="email" 
                                   value="<?= old('email') ?>" 
                                   required>
                            <?php if (isset($validation) && $validation->hasError('email')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>" 
                                   id="password" 
                                   name="password" 
                                   required>
                            <?php if (isset($validation) && $validation->hasError('password')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control <?= isset($validation) && $validation->hasError('password_confirm') ? 'is-invalid' : '' ?>" 
                                   id="password_confirm" 
                                   name="password_confirm" 
                                   required>
                            <?php if (isset($validation) && $validation->hasError('password_confirm')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password_confirm') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Register
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <p>Already have an account? <a href="<?= site_url('auth/login') ?>">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Password confirmation validation
document.getElementById('password_confirm').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    
    if (confirmPassword && password !== confirmPassword) {
        this.setCustomValidity('Passwords do not match');
    } else {
        this.setCustomValidity('');
    }
});
</script>
<?= $this->endSection() ?>
