<?= $this->extend('templates/public') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Contact Us</h1>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= site_url('feedback') ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('name')) ? 'is-invalid' : '' ?>" 
                                   id="name" name="name" value="<?= set_value('name') ?>" required>
                            <div class="invalid-feedback">
                                <?= isset($validation) ? $validation->getError('name') : '' ?>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                                   id="email" name="email" value="<?= set_value('email') ?>" required>
                            <div class="invalid-feedback">
                                <?= isset($validation) ? $validation->getError('email') : '' ?>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control <?= (isset($validation) && $validation->hasError('message')) ? 'is-invalid' : '' ?>" 
                                      id="message" name="message" rows="5" required><?= set_value('message') ?></textarea>
                            <div class="invalid-feedback">
                                <?= isset($validation) ? $validation->getError('message') : '' ?>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
