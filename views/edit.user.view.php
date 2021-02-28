<?php $title = "Edition de profile"; ?>
<?php require_once("partials/_header.php"); ?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <?php if ((!empty($_GET['id']) && $_GET['id'] === get_session('user_id'))): ?>
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Completer Mon profile</h3>
                        </div>
                        <div class="panel-body">
                            <!--Pour afficher les messages d'erreurs-->
                            <?php require_once('partials/_errors.php'); ?>
                            <!----------------------------------------->
                            <form data-parsley-validate method="post" class="well" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Nom <span
                                                    class="text-danger">*</span></label>
                                            <input data-parsley-minlength="3" type="text" class="form-control" id="name"
                                                   name="name" value="<?= get_input('name') ?: e($user->name) ?>"
                                                   required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="avatar">Changer mon avatar</label>
                                            <input type="file" name="avatar" id="avatar" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="city">Ville <span
                                                    class="text-danger">*</span></label>
                                            <input data-parsley-minlength="3" type="text" class="form-control" id="city"
                                                   name="city" value="<?= get_input('city') ?: e($user->city) ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="country">Country<span
                                                    class="text-danger">*</span></label>
                                            <input data-parsley-minlength="3" type="text" class="form-control"
                                                   id="country"
                                                   name="country"
                                                   value="<?= get_input('country') ?: e($user->country) ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="link">Url du site </label>
                                            <input data-parsley-minlength="3" type="text" class="form-control"
                                                   id="link"
                                                   name="link" value="<?= get_input('link') ?: e($user->link) ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="cs">Consumer Secret </label>
                                            <input data-parsley-minlength="3" type="text" class="form-control"
                                                   id="cs"
                                                   name="cs" value="<?= get_input('cs') ?: e($user->cs) ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="ck">Consumer Secret </label>
                                            <input data-parsley-minlength="3" type="text" class="form-control"
                                                   id="ck"
                                                   name="ck" value="<?= get_input('ck') ?: e($user->ck) ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="description">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                                                      placeholder="Je suis un amoureux de la programmation"
                                                      required><?= get_input('description') ?: e($user->description) ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Valider" name="update">

                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.container -->
</div>
<?php require_once("partials/_footer.php"); ?>