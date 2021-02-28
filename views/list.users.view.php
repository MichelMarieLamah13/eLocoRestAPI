<?php $title = "Liste des utilisateurs"; ?>
<?php require_once("partials/_header.php"); ?>
    <div class="main-content">
        <div class="container">
            <h1 class="lead">Liste des utilisateurs</h1>
            <?php foreach (array_chunk($users, 4) as $user_set): ?>
                <div class="users row">
                    <?php foreach ($user_set as $user1): ?>
                        <div class="col-md-3 user-block">
                            <a href="profile.php?id=<?= e($user1->id) ?>">
                                <img src="<?= $user1->avatar?:get_avatar_url($user1->email, 100); ?>"
                                     alt="Image de profile de <?= e($user1->pseudo); ?>"
                                     class="avatar-md">
                                <h4 class="user-block-username"><?= e($user1->pseudo); ?></h4>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <div id="pagination"><?= $pagination ?></div>
        </div>
        <!-- /.container -->
    </div>
<?php require_once("partials/_footer.php"); ?>