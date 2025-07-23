<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    <?= $action == 'create' ? 'Add New Book' : 'Edit Book' ?>
                </h2>
                <a href="<?= site_url('admin/book') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Book List
                </a>
            </div>

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Book Information</h5>
                </div>
                <div class="card-body">
                    <?= form_open(current_url(), ['class' => 'needs-validation', 'novalidate' => true]) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('title') ? 'is-invalid' : '' ?>" 
                                           id="title" name="title" value="<?= old('title', $book->title ?? '') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('title')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('title') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('author') ? 'is-invalid' : '' ?>" 
                                           id="author" name="author" value="<?= old('author', $book->author ?? '') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('author')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('author') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('isbn') ? 'is-invalid' : '' ?>" 
                                           id="isbn" name="isbn" value="<?= old('isbn', $book->isbn ?? '') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('isbn')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('isbn') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="publisher" class="form-label">Publisher <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('publisher') ? 'is-invalid' : '' ?>" 
                                           id="publisher" name="publisher" value="<?= old('publisher', $book->publisher ?? '') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('publisher')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('publisher') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="year_published" class="form-label">Year Published <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control <?= isset($validation) && $validation->hasError('year_published') ? 'is-invalid' : '' ?>" 
                                           id="year_published" name="year_published" value="<?= old('year_published', $book->year_published ?? '') ?>" 
                                           min="1900" max="<?= date('Y') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('year_published')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('year_published') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pages" class="form-label">Pages <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control <?= isset($validation) && $validation->hasError('pages') ? 'is-invalid' : '' ?>" 
                                           id="pages" name="pages" value="<?= old('pages', $book->pages ?? '') ?>" min="1" required>
                                    <?php if (isset($validation) && $validation->hasError('pages')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('pages') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('category') ? 'is-invalid' : '' ?>" 
                                           id="category" name="category" value="<?= old('category', $book->category ?? '') ?>" required>
                                    <?php if (isset($validation) && $validation->hasError('category')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('category') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control <?= isset($validation) && $validation->hasError('stock') ? 'is-invalid' : '' ?>" 
                                           id="stock" name="stock" value="<?= old('stock', $book->stock ?? 1) ?>" min="0" required>
                                    <?php if (isset($validation) && $validation->hasError('stock')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('stock') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select <?= isset($validation) && $validation->hasError('status') ? 'is-invalid' : '' ?>" 
                                            id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="available" <?= old('status', $book->status ?? '') == 'available' ? 'selected' : '' ?>>Available</option>
                                        <option value="borrowed" <?= old('status', $book->status ?? '') == 'borrowed' ? 'selected' : '' ?>>Borrowed</option>
                                        <option value="maintenance" <?= old('status', $book->status ?? '') == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->hasError('status')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('status') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control <?= isset($validation) && $validation->hasError('description') ? 'is-invalid' : '' ?>" 
                                      id="description" name="description" rows="4"><?= old('description', $book->description ?? '') ?></textarea>
                            <?php if (isset($validation) && $validation->hasError('description')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('description') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('admin/book') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> 
                                <?= $action == 'create' ? 'Add Book' : 'Update Book' ?>
                            </button>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Bootstrap form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
<?= $this->endSection() ?>
