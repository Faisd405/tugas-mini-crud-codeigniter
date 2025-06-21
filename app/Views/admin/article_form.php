<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><?= isset($article) ? 'Edit Article' : 'Create New Article' ?></h1>
        <a href="<?= site_url('admin/article') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <?php if (isset($validation)): ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= isset($article) ? site_url('admin/article/edit/' . $article->id) : site_url('admin/article/create') ?>" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('title')) ? 'is-invalid' : '' ?>" 
                           id="title" name="title" value="<?= isset($article) ? $article->title : set_value('title') ?>" required>
                    <div class="invalid-feedback">
                        <?= isset($validation) ? $validation->getError('title') : '' ?>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10"><?= isset($article) ? $article->content : set_value('content') ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="draft" id="statusDraft" value="1"
                               <?= (isset($article) && $article->draft == 1) || (!isset($article) && set_value('draft') == '1') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="statusDraft">
                            Draft
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="draft" id="statusPublished" value="0"
                               <?= (isset($article) && $article->draft == 0) || (!isset($article) && set_value('draft') == '0') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="statusPublished">
                            Published
                        </label>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('draft')): ?>
                        <div class="text-danger">
                            <?= $validation->getError('draft') ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="reset" class="btn btn-light">Reset</button>
                    <button type="submit" class="btn btn-primary">Save Article</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
