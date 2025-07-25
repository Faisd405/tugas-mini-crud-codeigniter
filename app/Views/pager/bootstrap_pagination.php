<?php

/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */

if ($pager->hasPreviousPage() || $pager->hasNextPage()) : ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($pager->hasPreviousPage()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="First">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link) : ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>

            <?php if ($pager->hasNextPage()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Last">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>

    <!-- Pagination Info -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted">
            <?php 
            $start = $pager->getPerPageStart() ?? 0;
            $end = $pager->getPerPageEnd() ?? 0;
            $total = $pager->getTotal() ?? 0;
            ?>
            Showing <?= $start ?> to <?= $end ?> of <?= $total ?> results
        </div>
        <div class="text-muted">
            Page <?= $pager->getCurrentPageNumber() ?> of <?= $pager->getPageCount() ?>
        </div>
    </div>
<?php endif ?>
