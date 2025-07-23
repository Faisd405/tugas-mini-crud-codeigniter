<?= $this->extend('templates/public') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 text-center mb-4">📚 Digital Library</h1>
            <p class="text-center text-muted">Discover and explore our collection of digital books</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <form method="get" action="<?= site_url('library') ?>" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search books by title, author, or category..." value="<?= esc($keyword) ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </div>
        <div class="col-lg-4">
            <form method="get" action="<?= site_url('library') ?>">
                <div class="input-group">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= esc($cat->category) ?>" <?= ($selectedCategory == $cat->category) ? 'selected' : '' ?>>
                                <?= esc($cat->category) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Info -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge bg-primary">
                        <?= $total ?> book<?= $total != 1 ? 's' : '' ?> found
                    </span>
                    <?php if (!empty($keyword)): ?>
                        <span class="text-muted">for "<?= esc($keyword) ?>"</span>
                    <?php endif; ?>
                    <?php if (!empty($selectedCategory)): ?>
                        <span class="text-muted">in "<?= esc($selectedCategory) ?>"</span>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if (!empty($keyword) || !empty($selectedCategory)): ?>
                        <a href="<?= site_url('library') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-times"></i> Clear Filters
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Books Grid -->
    <div class="row">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?= site_url('library/book/' . $book->id) ?>" class="text-decoration-none">
                                    <?= esc($book->title) ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted">
                                <small><i class="fas fa-user"></i> <?= esc($book->author) ?></small><br>
                                <small><i class="fas fa-building"></i> <?= esc($book->publisher) ?></small><br>
                                <small><i class="fas fa-calendar"></i> <?= esc($book->year_published) ?></small>
                            </p>
                            <div class="mb-2">
                                <span class="badge bg-secondary"><?= esc($book->category) ?></span>
                                <span class="badge bg-<?= $book->status == 'available' ? 'success' : ($book->status == 'borrowed' ? 'warning' : 'danger') ?>">
                                    <?= ucfirst(esc($book->status)) ?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-file-alt"></i> <?= esc($book->pages) ?> pages
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-boxes"></i> Stock: <?= esc($book->stock) ?>
                                </small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= site_url('library/book/' . $book->id) ?>" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h3 class="text-muted">No books found</h3>
                    <p class="text-muted">
                        <?php if (!empty($keyword)): ?>
                            No books match your search criteria. Try different keywords.
                        <?php else: ?>
                            The library is currently empty.
                        <?php endif; ?>
                    </p>
                    <a href="<?= site_url('library') ?>" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Back to All Books
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (!empty($books) && $total > $perPage): ?>
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Book pagination">
                    <?= $pager ?>
                </nav>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
