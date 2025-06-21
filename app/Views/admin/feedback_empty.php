<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <h1 class="h3 mb-4">Feedback List</h1>
    
    <div class="card">
        <div class="card-body text-center py-5">
            <div class="mb-3">
                <i class="fas fa-comments fa-4x text-muted"></i>
            </div>
            <h5>No Feedback Yet</h5>
            <p class="text-muted">When visitors submit feedback using the feedback form, it will appear here.</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
