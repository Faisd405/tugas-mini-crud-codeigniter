<?= $this->extend('templates/public') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Picture Card -->
            <div class="card">
                <div class="card-body text-center">
                    <?php if (!empty($user->profile_picture)): ?>
                        <img src="<?= base_url('profile-picture/' . $user->profile_picture) ?>" 
                             alt="Profile Picture" 
                             class="rounded-circle mb-3" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto mb-3" 
                             style="width: 150px; height: 150px;">
                            <i class="fas fa-user fa-4x text-white"></i>
                        </div>
                    <?php endif; ?>
                    
                    <h5 class="card-title"><?= esc($user->name) ?></h5>
                    <p class="text-muted"><?= esc($user->role ?? 'Member') ?></p>
                    
                    <!-- Upload Picture Form -->
                    <form action="<?= site_url('profile/uploadPicture') ?>" method="post" enctype="multipart/form-data" class="mb-2">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="file" 
                                   class="form-control form-control-sm" 
                                   name="profile_picture" 
                                   accept="image/*" 
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-upload"></i> Upload Picture
                        </button>
                    </form>
                    
                    <?php if (!empty($user->profile_picture)): ?>
                        <a href="<?= site_url('profile/deletePicture') ?>" 
                           class="btn btn-outline-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete your profile picture?')">
                            <i class="fas fa-trash"></i> Delete Picture
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="<?= site_url('profile/edit') ?>" class="btn btn-outline-primary btn-sm d-block mb-2">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                    <a href="<?= site_url('library') ?>" class="btn btn-outline-info btn-sm d-block mb-2">
                        <i class="fas fa-book"></i> Browse Library
                    </a>
                    <?php if (session()->get('user_role') === 'admin'): ?>
                        <a href="<?= site_url('admin/book') ?>" class="btn btn-outline-warning btn-sm d-block">
                            <i class="fas fa-cogs"></i> Admin Panel
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <!-- Profile Information Card -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Profile Information</h5>
                    <a href="<?= site_url('profile/edit') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Full Name</label>
                                <p class="form-control-plaintext"><?= esc($user->name) ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Username</label>
                                <p class="form-control-plaintext"><?= esc($user->username) ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p class="form-control-plaintext"><?= esc($user->email) ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Phone</label>
                                <p class="form-control-plaintext"><?= esc($user->phone ?? 'Not provided') ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Gender</label>
                                <p class="form-control-plaintext"><?= esc(ucfirst($user->gender ?? 'Not specified')) ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Birth Date</label>
                                <p class="form-control-plaintext">
                                    <?php if ($user->birth_date): ?>
                                        <?= date('F j, Y', strtotime($user->birth_date)) ?>
                                    <?php else: ?>
                                        Not provided
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Role</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-<?= $user->role === 'admin' ? 'danger' : ($user->role === 'librarian' ? 'warning' : 'info') ?>">
                                        <?= esc(ucfirst($user->role ?? 'Member')) ?>
                                    </span>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-<?= $user->status === 'active' ? 'success' : ($user->status === 'inactive' ? 'secondary' : 'danger') ?>">
                                        <?= esc(ucfirst($user->status ?? 'Active')) ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <?php if (!empty($user->address)): ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Address</label>
                            <p class="form-control-plaintext"><?= esc($user->address) ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($user->bio)): ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bio</label>
                            <p class="form-control-plaintext"><?= esc($user->bio) ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="row text-muted">
                        <div class="col-md-6">
                            <small><strong>Member since:</strong> <?= date('F j, Y', strtotime($user->created_at)) ?></small>
                        </div>
                        <div class="col-md-6">
                            <small><strong>Last updated:</strong> <?= date('F j, Y', strtotime($user->updated_at)) ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
