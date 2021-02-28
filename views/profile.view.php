<?php $title = "Page de profile"; ?>
<?php require_once("partials/_header.php"); ?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Profile de <?= e($user->pseudo); ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="<?= $user->avatar ?: get_avatar_url($user->email, 100); ?>"
                                     alt="Image de profile de <?= e($user->pseudo); ?>"
                                     class="avatar-md">
                            </div>
                            <div class="col-md-7">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <i class="fas fa-user"></i>
                                <strong><?= e($user->pseudo); ?></strong> <br>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:<?= e($user->email); ?>"><?= e($user->email); ?></a><br>
                                <?=
                                e($user->city) && e($user->country) ? '<i class="fas fa-location"></i>&nbsp;' . e($user->city) . ' - ' . e($user->country) . '<br>' : '';
                                ?>
                                <i class="fas fa-map-marker-alt"></i>
                                <a href="https://www.google.com/maps?q=<?= e($user->city) . ' ' . e($user->country) ?>"
                                   target="_blank">Voir
                                    sur Google Maps</a>

                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-globe"></i>
                                <?=$user->link?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 well">
                                <h5>Petite description de <?= e($user->name) ?></h5>
                                <?=
                                e($user->description) ? nl2br(e($user->description)) : 'Aucune description pour le moment';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <?php if ((!empty($_GET['id']) && $_GET['id'] === get_session('user_id'))): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Information de l'API Rest du site Woocommerce:  <?= e($user->name); ?>
                            </h3>
                        </div>
                        <!--Pour afficher les messages d'erreurs-->
                        <?php require_once('partials/_errors.php'); ?>
                        <!----------------------------------------->
                        <div class="panel-body">
                            <div class="row">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col"><i class="fas fa-flag"></th>
                                        <th scope="col">Key</th>
                                        <th scope="col">Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><i class="fas fa-globe"></i></th>
                                        <td>Url</td>
                                        <td><?=$user->link?></td>

                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fas fa-key"></i></th>
                                        <td>Consumer secret</td>
                                        <td><?=$user->cs?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fas fa-key-skeleton"></i></th>
                                        <td>Consumer key</td>
                                        <td><?=$user->ck?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fas fa-users"></i></th>
                                        <td>Customers</td>
                                        <td><?=$customersCount?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fas fa-coffee"></i></th>
                                        <td>Products</td>
                                        <td><?=$productsCount?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fas fa-money-bill"></i></th>
                                        <td>Orders</td>
                                        <td><?=$ordersCount?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>


    </div>
    <!-- /.container -->
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.js"></script>
<!-- Timeago -->
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
<!--<script src="assets/js/jquery.livequery.min.js"></script>-->
<!--Sweet alert-->
<script src="libraries/sweetAlert/sweetalert.min.js"></script>
<script src="assets/js/main.js"></script>
<!-- Parsley -->
<script src="libraries/parsley/parsley.min.js"></script>
<script src="libraries/parsley/i18n/fr.js"></script>
<script>
    window.ParsleyValidator.setLocale('fr');
</script>
</body>
</html>