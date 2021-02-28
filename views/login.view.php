<?php $title = "Connexion"; ?>
<?php require_once("partials/_header.php"); ?>
    <div class="main-content">
        <div class="container">

            <h1 class="lead"> <?= $contenu['login1'][get_session('locale')] ?></h1>
            <!--Pour afficher les messages d'erreurs-->
            <?php require_once('partials/_errors.php'); ?>
            <!----------------------------------------->
            <form data-parsley-validate method="post" class="well col-md-6" autocomplete="off">
                <!-- Identifiant field -->
                <div class="form-group">
                    <label class="control-label" for="identifiant"><?= $contenu['login2'][get_session('locale')] ?>
                        :</label>
                    <input data-parsley-trigger="keypress" type="text" class="form-control" id="identifiant"
                           name="identifiant"
                           value="<?= get_input('identifiant'); ?>" required>
                </div>

                <!-- Password field -->
                <div class="form-group">
                    <label class="control-label" for="password"><?= $contenu['login3'][get_session('locale')] ?>
                        :</label>
                    <input data-parsley-trigger="keypress" type="password"
                           class="form-control" id="password" name="password" required>
                </div>
                <!-- Remember me -->
                <div class="form-group">
                    <label class="control-label" for="remember_me">
                        <input type="checkbox" id="remember_me" name="remember_me">
                        <?= $contenu['login4'][get_session('locale')] ?>
                    </label>
                </div>


                <input type="submit" class="btn btn-primary" value="<?= $contenu['login1'][get_session('locale')] ?>"
                       name="login">
            </form>

        </div>
        <!-- /.container -->
    </div>
<?php require_once("partials/_footer.php"); ?>