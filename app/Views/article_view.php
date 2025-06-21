<?= $this->extend('templates/public') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Article</li>
        </ol>
    </nav>
    
    <?php if (!empty($article)): ?>
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <h1 class="mb-3"><?= esc($article->title) ?></h1>
                    <div class="mb-4 text-muted">
                        <i class="far fa-calendar-alt me-2"></i> Published on <?= date('F j, Y', strtotime($article->created_at)) ?>
                        <?php if ($article->updated_at != $article->created_at): ?>
                            <span class="ms-3"><i class="fas fa-sync-alt me-2"></i> Updated on <?= date('F j, Y', strtotime($article->updated_at)) ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="article-content mb-5">
                        <?= $article->content ?>
                    </div>
                </article>
                
                <div class="mt-5 pt-4 border-top">
                    <a href="<?= site_url('/') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i> Back to Home
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="m-0"><i class="fas fa-thumbtack me-2"></i> More Articles</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($other_articles)): ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($other_articles as $other): ?>
                                    <?php if ($other->id != $article->id): ?>
                                        <li class="list-group-item px-0">
                                            <a href="<?= site_url('article/' . $other->slug) ?>" class="text-decoration-none">
                                                <?= esc($other->title) ?>
                                            </a>
                                            <div class="small text-muted">
                                                <i class="far fa-calendar-alt me-1"></i> <?= date('M j, Y', strtotime($other->created_at)) ?>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-center mb-0">No other articles available.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="m-0"><i class="fas fa-paper-plane me-2"></i> Feedback</h5>
                    </div>
                    <div class="card-body">
                        <p>Have thoughts about this article or want to share your feedback?</p>
                        <a href="<?= site_url('feedback') ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-comment me-1"></i> Send Feedback
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i> Article not found.
        </div>
        <a href="<?= site_url('/') ?>" class="btn btn-primary">
            <i class="fas fa-home me-2"></i> Back to Home
        </a>
    <?php endif; ?>
</div>

<style>
    .article-content {
        line-height: 1.8;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
        border-radius: 5px;
    }
    .article-content p {
        margin-bottom: 1.5rem;
    }
    .article-content h2, .article-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .article-content ul, .article-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
</style>
<?= $this->endSection() ?>
