<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Article List</h1>
        <a href="<?= site_url('admin/article/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Article
        </a>
    </div>
    
    <div class="card">
        <div class="card-body text-center py-5">
            <div class="mb-3">
                <i class="fas fa-newspaper fa-4x text-muted"></i>
            </div>
            <h5>No Articles Found</h5>
            <p class="text-muted">Start creating your first article by clicking the button below</p>
            <a href="<?= site_url('admin/article/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Create New Article
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
