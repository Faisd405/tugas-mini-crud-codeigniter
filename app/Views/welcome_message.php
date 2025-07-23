<?= $this->extend('templates/public') ?>

<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        padding: 5rem 0;
        margin-bottom: 3rem;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .feature-card {
        height: 100%;
        transition: transform 0.3s;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .feature-card:hover {
        transform: translateY(-5px);
    }
    .feature-icon {
        font-size: 2rem;
        color: #0d6efd;
        margin-bottom: 1rem;
    }
    .article-card {
        transition: transform 0.3s;
        height: 100%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }
    .article-card:hover {
        transform: translateY(-5px);
    }
    .btn-rounded {
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
    }
    .cta-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 3rem 0;
        margin-top: 3rem;
    }
    .article-excerpt {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 4.5rem;
    }
    .article-date {
        font-size: 0.85rem;
        color: #6c757d;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-3">Welcome to Faisal E Library</h1>
                <p class="lead mb-4">A powerful CodeIgniter-based application featuring article management, feedback collection, and an admin dashboard.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= site_url('feedback') ?>" class="btn btn-light btn-rounded">
                        <i class="fas fa-paper-plane me-2"></i>Send Feedback
                    </a>
                    <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-outline-light btn-rounded">
                        <i class="fas fa-lock me-2"></i>Admin Login
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://i.imgur.com/Wai4RDe.png" alt="Faisal E Library" class="img-fluid" style="max-width: 80%;">
            </div>
        </div>
    </div>
</section>

<!-- Feature Section -->
<div class="container py-5">
    <h2 class="text-center mb-5">Our Key Features</h2>
    <div class="row g-4">
        <!-- Article Management -->
        <div class="col-md-4">
            <div class="card feature-card p-4">
                <div class="text-center">
                    <div class="feature-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3 class="mb-3">Article Management</h3>
                    <p class="mb-4">Create, read, update, and delete articles with ease. Manage your content with our intuitive admin interface.</p>
                    <a href="<?= site_url('admin/article') ?>" class="btn btn-primary btn-sm btn-rounded">
                        <i class="fas fa-arrow-right me-1"></i> Manage Articles
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Feedback System -->
        <div class="col-md-4">
            <div class="card feature-card p-4">
                <div class="text-center">
                    <div class="feature-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="mb-3">Feedback System</h3>
                    <p class="mb-4">Collect user feedback through our interactive form. All submissions are stored and can be managed in the admin area.</p>
                    <a href="<?= site_url('feedback') ?>" class="btn btn-primary btn-sm btn-rounded">
                        <i class="fas fa-paper-plane me-1"></i> Send Feedback
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Admin Dashboard -->
        <div class="col-md-4">
            <div class="card feature-card p-4">
                <div class="text-center">
                    <div class="feature-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <h3 class="mb-3">Admin Dashboard</h3>
                    <p class="mb-4">A comprehensive admin dashboard to manage your articles, view feedback, and monitor your application's performance.</p>
                    <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-primary btn-sm btn-rounded">
                        <i class="fas fa-lock me-1"></i> Access Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Articles Section -->
<div class="container py-5">
    <div class="row mb-4">
        <div class="col">
            <h2 class="text-center">Recent Articles</h2>
            <p class="text-center text-muted">Check out our latest published content</p>
        </div>
    </div>
    
    <div class="row g-4">
        <?php if (empty($recent_articles)): ?>
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> No articles published yet. Check back soon!
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($recent_articles as $article): ?>
                <div class="col-md-4">
                    <div class="card article-card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($article->title) ?></h5>
                            <p class="article-date mb-3">
                                <i class="far fa-calendar-alt me-1"></i> 
                                <?= date('F j, Y', strtotime($article->created_at)) ?>
                            </p>
                            <p class="card-text article-excerpt"><?= esc(substr(strip_tags($article->content), 0, 150)) ?>...</p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="<?= site_url('article/' . $article->slug) ?>" class="btn btn-outline-primary btn-sm btn-rounded">
                                <i class="fas fa-book-open me-1"></i> Read More
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <?php if (!empty($recent_articles)): ?>
        <div class="text-center mt-4">
            <a href="<?= site_url('admin/article') ?>" class="btn btn-primary btn-rounded">
                <i class="fas fa-list me-2"></i> View All Articles
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Call to Action Section -->
<div class="container">
    <div class="cta-section">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h3 class="mb-3">Have feedback or suggestions?</h3>
                <p class="mb-4">We'd love to hear from you! Share your thoughts and help us improve this application.</p>
                <a href="<?= site_url('feedback') ?>" class="btn btn-primary btn-rounded">
                    <i class="fas fa-paper-plane me-2"></i> Send Your Feedback
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
