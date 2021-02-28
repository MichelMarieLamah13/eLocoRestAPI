<?php $title = "Inscription"; ?>
<?php require_once("partials/_header.php"); ?>
    <div class="main-content">
        <div class="container">

            <h1 class="lead"><?= $contenu['register1'][get_session('locale')] ?>!</h1>
            <!--Pour afficher les messages d'erreurs-->
            <?php require_once('partials/_errors.php'); ?>
            <!----------------------------------------->
            <form data-parsley-validate method="post" class="well col-md-6" autocomplete="off">
                <!-- Name field -->
                <div class="form-group">
                    <label class="control-label" for="name"><?= $contenu['register2'][get_session('locale')] ?>:</label>
                    <input data-parsley-minlength="3" type="text" class="form-control" id="name" name="name" value="<?= get_input('name'); ?>"required>
                </div>

                <!-- Pseudo field -->
                <div class="form-group">
                    <label class="control-label" for="pseudo"><?= $contenu['register3'][get_session('locale')] ?>:</label>
                    <input data-parsley-minlength="3" data-parsley-trigger="keypress" type="text" class="form-control" id="pseudo" name="pseudo" value="<?= get_input('pseudo'); ?>"required>
                </div>
                <!-- Email field -->
                <div class="form-group">
                    <label class="control-label" for="email"><?= $contenu['register4'][get_session('locale')] ?>:</label>
                    <input data-parsley-trigger="keypress" type="email" class="form-control" id="email" name="email" value="<?= get_input('email'); ?>"required>
                </div>

                <!-- Password field -->
                <div class="form-group">
                    <label class="control-label" for="password"><?= $contenu['register5'][get_session('locale')] ?>:</label>
                    <input data-parsley-minlength="6" data-parsley-trigger="keypress" type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Password Confirmation field -->
                <div class="form-group">
                    <label class="control-label" for="password_confirm"><?= $contenu['register6'][get_session('locale')] ?>:</label>
                    <input data-parsley-equalto="#password" type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                </div>

                <!-- Link field -->
                <div class="form-group">
                    <label class="control-label" for="link"><?= $contenu['register7'][get_session('locale')] ?>:</label>
                    <input data-parsley-minlength="3" data-parsley-trigger="keypress" type="text" class="form-control" id="link" name="link" value="<?= get_input('link'); ?>"required>
                </div>
                <!-- Cs field -->
                <div class="form-group">
                    <label class="control-label" for="cs"><?= $contenu['register8'][get_session('locale')] ?>:</label>
                    <input data-parsley-minlength="3" data-parsley-trigger="keypress" type="text" class="form-control" id="cs" name="cs" value="<?= get_input('cs'); ?>"required>
                </div>
                <!-- Cs field -->
                <div class="form-group">
                    <label class="control-label" for="ck"><?= $contenu['register9'][get_session('locale')] ?>:</label>
                    <input data-parsley-minlength="3" data-parsley-trigger="keypress" type="text" class="form-control" id="ck" name="ck" value="<?= get_input('ck'); ?>"required>
                </div>
                <input type="submit" class="btn btn-primary" value="<?= $contenu['register10'][get_session('locale')] ?>" name="register">
            </form>

        </div>
        <!-- /.container -->
    </div>
<?php require_once("partials/_footer.php"); ?>