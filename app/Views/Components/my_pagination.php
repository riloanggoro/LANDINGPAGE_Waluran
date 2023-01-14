<!-- Register at App/Config/Pager.php -->
<?php $pager->setSurroundCount(2) ?>
<ul>
    <?php if ($pager->hasPrevious()) : ?>
        <li>
            <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                first
            </a>
        </li>
        <li>
            <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                &lt;
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li class="<?= $link['active'] ? 'active"' : '' ?>">
            <a href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li>
            <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                &gt;
            </a>
        </li>
        <li>
            <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                last
            </a>
        </li>
    <?php endif ?>
</ul>