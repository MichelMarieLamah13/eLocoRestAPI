<!--Pour l'affichage des messages d'erreurs-->
<?php if (isset($errors) && count($errors) != 0): ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php foreach ($errors as $error): ?>
            <strong><?= $error . '<br/>' ?></strong>
        <?php endforeach ?>
    </div>
<?php endif ?>

