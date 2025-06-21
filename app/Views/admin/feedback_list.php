<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <h1 class="h3 mb-4">Feedback List</h1>
    
    <div class="row">
        <?php foreach($feedbacks as $feedback): ?>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?= esc($feedback->name) ?></strong>
                        <span class="text-muted ms-2"><?= esc($feedback->email) ?></span>
                    </div>
                    <small class="text-muted"><?= date('d M Y', strtotime($feedback->created_at)) ?></small>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= esc($feedback->message) ?></p>
                </div>
                <div class="card-footer text-end">
                    <a href="#" onclick="confirmDelete('<?= site_url('admin/feedback/delete/' . $feedback->id) ?>')" 
                       class="btn btn-sm btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
