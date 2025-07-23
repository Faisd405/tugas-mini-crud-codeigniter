<?= $this->extend('templates/public') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Profile</h5>
                    <a href="<?= site_url('profile') ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to Profile
                    </a>
                </div>
                <div class="card-body">
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('profile/edit') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>" 
                                           id="name" 
                                           name="name" 
                                           value="<?= old('name', $user->name) ?>" 
                                           required>
                                    <?php if (isset($validation) && $validation->hasError('name')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('name') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" 
                                           class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" 
                                           id="email" 
                                           name="email" 
                                           value="<?= old('email', $user->email) ?>" 
                                           required>
                                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" 
                                           class="form-control <?= isset($validation) && $validation->hasError('phone') ? 'is-invalid' : '' ?>" 
                                           id="phone" 
                                           name="phone" 
                                           value="<?= old('phone', $user->phone) ?>">
                                    <?php if (isset($validation) && $validation->hasError('phone')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('phone') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">Birth Date</label>
                                    <input type="date" 
                                           class="form-control <?= isset($validation) && $validation->hasError('birth_date') ? 'is-invalid' : '' ?>" 
                                           id="birth_date" 
                                           name="birth_date" 
                                           value="<?= old('birth_date', $user->birth_date) ?>">
                                    <?php if (isset($validation) && $validation->hasError('birth_date')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('birth_date') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select <?= isset($validation) && $validation->hasError('gender') ? 'is-invalid' : '' ?>" 
                                            id="gender" 
                                            name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" <?= old('gender', $user->gender) === 'male' ? 'selected' : '' ?>>Male</option>
                                        <option value="female" <?= old('gender', $user->gender) === 'female' ? 'selected' : '' ?>>Female</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->hasError('gender')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('gender') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control <?= isset($validation) && $validation->hasError('address') ? 'is-invalid' : '' ?>" 
                                              id="address" 
                                              name="address" 
                                              rows="3"><?= old('address', $user->address) ?></textarea>
                                    <?php if (isset($validation) && $validation->hasError('address')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('address') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control <?= isset($validation) && $validation->hasError('bio') ? 'is-invalid' : '' ?>" 
                                              id="bio" 
                                              name="bio" 
                                              rows="3" 
                                              maxlength="500"><?= old('bio', $user->bio) ?></textarea>
                                    <div class="form-text">Maximum 500 characters</div>
                                    <?php if (isset($validation) && $validation->hasError('bio')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('bio') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <!-- Password Change Section -->
                        <h6 class="mb-3">Change Password (Optional)</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" 
                                           class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Leave blank to keep current password">
                                    <?php if (isset($validation) && $validation->hasError('password')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirm" class="form-label">Confirm New Password</label>
                                    <input type="password" 
                                           class="form-control <?= isset($validation) && $validation->hasError('password_confirm') ? 'is-invalid' : '' ?>" 
                                           id="password_confirm" 
                                           name="password_confirm" 
                                           placeholder="Confirm new password">
                                    <?php if (isset($validation) && $validation->hasError('password_confirm')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password_confirm') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= site_url('profile') ?>" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Character counter for bio
document.getElementById('bio').addEventListener('input', function() {
    const maxLength = 500;
    const currentLength = this.value.length;
    const remaining = maxLength - currentLength;
    
    // Update counter text
    const counter = this.nextElementSibling;
    if (counter && counter.classList.contains('form-text')) {
        counter.textContent = `${remaining} characters remaining`;
        
        if (remaining < 50) {
            counter.classList.add('text-warning');
        } else {
            counter.classList.remove('text-warning');
        }
        
        if (remaining < 0) {
            counter.classList.add('text-danger');
            counter.classList.remove('text-warning');
        } else {
            counter.classList.remove('text-danger');
        }
    }
});

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
