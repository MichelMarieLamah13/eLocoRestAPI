<!--
    Cette partie permet d'afficher les messages
    dans d'autres pages
-->
<?php if (isset($_SESSION['notification']['message'])): ?>
    <div class="container">
        <div class="alert alert-<?= $_SESSION['notification']['type'] ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?= $_SESSION['notification']['message'] ?></strong>
        </div>
    </div>
    <?php $_SESSION['notification'] = [] ?>
<?php endif; ?>
