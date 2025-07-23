<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Book Details</h2>
                <div class="btn-group">
                    <a href="<?= site_url('admin/book/edit/' . $book->id) ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Book
                    </a>
                    <a href="<?= site_url('admin/book') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><?= esc($book->title) ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <tr>
                                    <th width="200">ID</th>
                                    <td><?= esc($book->id) ?></td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td><?= esc($book->title) ?></td>
                                </tr>
                                <tr>
                                    <th>Author</th>
                                    <td><?= esc($book->author) ?></td>
                                </tr>
                                <tr>
                                    <th>ISBN</th>
                                    <td><code><?= esc($book->isbn) ?></code></td>
                                </tr>
                                <tr>
                                    <th>Publisher</th>
                                    <td><?= esc($book->publisher) ?></td>
                                </tr>
                                <tr>
                                    <th>Year Published</th>
                                    <td><?= esc($book->year_published) ?></td>
                                </tr>
                                <tr>
                                    <th>Pages</th>
                                    <td><?= esc($book->pages) ?> pages</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td><span class="badge bg-secondary"><?= esc($book->category) ?></span></td>
                                </tr>
                                <tr>
                                    <th>Stock</th>
                                    <td><?= esc($book->stock) ?> copies</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge bg-<?= $book->status == 'available' ? 'success' : ($book->status == 'borrowed' ? 'warning' : 'danger') ?>">
                                            <?= ucfirst(esc($book->status)) ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created</th>
                                    <td><?= date('F j, Y g:i A', strtotime($book->created_at)) ?></td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td><?= date('F j, Y g:i A', strtotime($book->updated_at)) ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <?php if (!empty($book->cover_image)): ?>
                                    <img src="<?= base_url('uploads/covers/' . $book->cover_image) ?>" 
                                         alt="<?= esc($book->title) ?>" 
                                         class="img-thumbnail mb-3" 
                                         style="max-width: 250px;">
                                <?php else: ?>
                                    <div class="bg-light p-5 mb-3 rounded">
                                        <i class="fas fa-book fa-4x text-muted"></i>
                                        <p class="text-muted mt-3">No cover image</p>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="d-grid gap-2">
                                    <a href="<?= site_url('library/book/' . $book->id) ?>" 
                                       class="btn btn-outline-primary" target="_blank">
                                        <i class="fas fa-external-link-alt"></i> View in Library
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if (!empty($book->description)): ?>
                        <div class="mt-4">
                            <h5>Description</h5>
                            <div class="card">
                                <div class="card-body">
                                    <?= nl2br(esc($book->description)) ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mt-4">
                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('admin/book/delete/' . $book->id) ?>" 
                               class="btn btn-danger"
                               onclick="return confirm('Are you sure you want to delete this book? This action cannot be undone.')">
                                <i class="fas fa-trash"></i> Delete Book
                            </a>
                            <div class="btn-group">
                                <a href="<?= site_url('admin/book/edit/' . $book->id) ?>" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Book
                                </a>
                                <a href="<?= site_url('admin/book') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
