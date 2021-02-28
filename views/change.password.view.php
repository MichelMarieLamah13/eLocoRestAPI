<?php $title = "Changement de mot de pass"; ?>
<?php require_once("partials/_header.php"); ?>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Changer de mot de pass</h3>
                        </div>
                        <div class="panel-body">
                            <!--Pour afficher les messages d'erreurs-->
                            <?php require_once('partials/_errors.php'); ?>
                            <!----------------------------------------->
                            <form data-parsley-validate method="post" class="well" autocomplete="off"
                                  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label" for="current_password">Mot de pass actuel <span
                                            class="text-danger">*</span></label>
                                    <input data-parsley-minlength="6" type="password" class="form-control"
                                           id="current_password"
                                           name="current_password"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="new_password">Nouveau Mot de pass <span
                                            class="text-danger">*</span></label>
                                    <input data-parsley-minlength="6" type="password" class="form-control"
                                           id="new_password"
                                           name="new_password"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="new_password_confirmation">Confirmer Nouveau Mot
                                        de pass <span
                                            class="text-danger">*</span></label>
                                    <input data-parsley-minlength="6" type="password" class="form-control"
                                           id="new_password_confirmation"
                                           name="new_password_confirmation" data-parsley-equalto="#new_password"
                                           required>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Valider" name="change_password">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
<?php require_once("partials/_footer.php"); ?>