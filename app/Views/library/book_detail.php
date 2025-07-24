<?= $this->extend('templates/public') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('library') ?>">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($book->title) ?></li>
        </ol>
    </nav>

    <!-- Book Details -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h1 class="h3 mb-0"><?= esc($book->title) ?></h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Author:</strong></td>
                                    <td><?= esc($book->author) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>ISBN:</strong></td>
                                    <td><?= esc($book->isbn) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Publisher:</strong></td>
                                    <td><?= esc($book->publisher) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Year Published:</strong></td>
                                    <td><?= esc($book->year_published) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Pages:</strong></td>
                                    <td><?= esc($book->pages) ?> pages</td>
                                </tr>
                                <tr>
                                    <td><strong>Category:</strong></td>
                                    <td><span class="badge bg-secondary"><?= esc($book->category) ?></span></td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge bg-<?= $book->status == 'available' ? 'success' : ($book->status == 'borrowed' ? 'warning' : 'danger') ?>">
                                            <?= ucfirst(esc($book->status)) ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Stock:</strong></td>
                                    <td><?= esc($book->stock) ?> copies</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <?php if (!empty($book->cover_image)): ?>
                                    <img src="<?= base_url('uploads/covers/' . $book->cover_image) ?>" 
                                         alt="<?= esc($book->title) ?>" 
                                         class="img-thumbnail mb-3" 
                                         style="max-width: 200px;">
                                <?php else: ?>
                                    <div class="bg-light p-5 mb-3 rounded">
                                        <i class="fas fa-book fa-3x text-muted"></i>
                                        <p class="text-muted mt-2">No cover image</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php if (!empty($book->description)): ?>
                        <div class="mt-4">
                            <h5>Description</h5>
                            <p class="text-muted"><?= nl2br(esc($book->description)) ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mt-4">
                        <small class="text-muted">
                            <i class="fas fa-calendar-plus"></i> Added: <?= date('F j, Y', strtotime($book->created_at)) ?>
                            <?php if ($book->updated_at != $book->created_at): ?>
                                | <i class="fas fa-calendar-edit"></i> Updated: <?= date('F j, Y', strtotime($book->updated_at)) ?>
                            <?php endif; ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Related Books -->
            <?php if (!empty($relatedBooks)): ?>
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Related Books</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach ($relatedBooks as $related): ?>
                            <div class="mb-3 pb-3 border-bottom">
                                <h6>
                                    <a href="<?= site_url('library/book/' . $related->id) ?>" class="text-decoration-none">
                                        <?= esc($related->title) ?>
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    by <?= esc($related->author) ?> (<?= esc($related->year_published) ?>)
                                </small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Quick Actions -->
            <div class="card shadow-sm mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="<?= site_url('library?category=' . urlencode($book->category)) ?>" class="btn btn-outline-primary btn-sm w-100 mb-2">
                        <i class="fas fa-list"></i> Browse <?= esc($book->category) ?>
                    </a>
                    <a href="<?= site_url('library?search=' . urlencode($book->author)) ?>" class="btn btn-outline-secondary btn-sm w-100 mb-2">
                        <i class="fas fa-search"></i> More by <?= esc($book->author) ?>
                    </a>
                    <a href="<?= site_url('library') ?>" class="btn btn-outline-dark btn-sm w-100">
                        <i class="fas fa-arrow-left"></i> Back to Library
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
