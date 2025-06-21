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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created At</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <strong><?= esc($article->title) ?></strong>
                            </td>
                            <td><?= date('d M Y', strtotime($article->created_at)) ?></td>
                            <td class="text-center">
                                <?php if($article->draft == 1): ?>
                                    <span class="badge bg-warning">Draft</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Published</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="<?= site_url('admin/article/edit/' . $article->id) ?>" class="btn btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="confirmDelete('<?= site_url('admin/article/delete/' . $article->id) ?>')" class="btn btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
