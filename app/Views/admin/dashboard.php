<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <h1 class="h3 mb-4">Dashboard</h1>
    
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card bg-primary text-white dashboard-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Articles</h6>
                            <h2 class="mb-0"><?= $article_count ?></h2>
                        </div>
                        <i class="fas fa-newspaper fa-3x opacity-50"></i>
                    </div>
                    <a href="<?= site_url('admin/article') ?>" class="text-white">View all <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card bg-success text-white dashboard-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Feedback</h6>
                            <h2 class="mb-0"><?= $feedback_count ?></h2>
                        </div>
                        <i class="fas fa-comments fa-3x opacity-50"></i>
                    </div>
                    <a href="<?= site_url('admin/feedback') ?>" class="text-white">View all <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
