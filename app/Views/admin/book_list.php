<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>📚 Book Management</h2>
                <a href="<?= site_url('admin/book/create') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Book
                </a>
            </div>

            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="get" action="<?= site_url('admin/book') ?>">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Search books by title, author, ISBN, or category..." 
                                           value="<?= esc($keyword) ?>">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php if (!empty($keyword)): ?>
                                    <a href="<?= site_url('admin/book') ?>" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i> Clear Search
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Books Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        Book List 
                        <span class="badge bg-primary ms-2"><?= $total ?> book<?= $total != 1 ? 's' : '' ?></span>
                        <?php if (!empty($keyword)): ?>
                            <span class="text-muted">- Search results for "<?= esc($keyword) ?>"</span>
                        <?php endif; ?>
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($books)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>ISBN</th>
                                        <th>Category</th>
                                        <th>Year</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($books as $book): ?>
                                        <tr>
                                            <td><?= esc($book->id) ?></td>
                                            <td>
                                                <strong><?= esc($book->title) ?></strong><br>
                                                <small class="text-muted"><?= esc($book->publisher) ?></small>
                                            </td>
                                            <td><?= esc($book->author) ?></td>
                                            <td><code><?= esc($book->isbn) ?></code></td>
                                            <td><span class="badge bg-secondary"><?= esc($book->category) ?></span></td>
                                            <td><?= esc($book->year_published) ?></td>
                                            <td><?= esc($book->stock) ?></td>
                                            <td>
                                                <span class="badge bg-<?= $book->status == 'available' ? 'success' : ($book->status == 'borrowed' ? 'warning' : 'danger') ?>">
                                                    <?= ucfirst(esc($book->status)) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= site_url('admin/book/view/' . $book->id) ?>" 
                                                       class="btn btn-sm btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?= site_url('admin/book/edit/' . $book->id) ?>" 
                                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= site_url('admin/book/delete/' . $book->id) ?>" 
                                                       class="btn btn-sm btn-outline-danger" title="Delete"
                                                       onclick="return confirm('Are you sure you want to delete this book?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <?php if ($total > $perPage): ?>
                            <div class="mt-3">
                                <?= $pager ?>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-book fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No books found</h4>
                            <p class="text-muted">
                                <?php if (!empty($keyword)): ?>
                                    No books match your search criteria.
                                <?php else: ?>
                                    No books have been added yet.
                                <?php endif; ?>
                            </p>
                            <a href="<?= site_url('admin/book/create') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add First Book
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
