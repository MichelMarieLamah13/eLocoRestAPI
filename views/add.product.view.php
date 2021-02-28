<?php $title = "Add Product" ?>
<?php require_once("partials/_header.php"); ?>
    <div class="main-content">
        <div class="container">

            <h1 class="lead">Add a product!</h1>
            <!--Pour afficher les messages d'erreurs-->
            <?php require_once('partials/_errors.php'); ?>
            <!----------------------------------------->
            <form data-parsley-validate method="post" class="well col-md-6" autocomplete="off" enctype="multipart/form-data">
                <!-- Name field -->
                <div class="form-group">
                    <label class="control-label" for="name">Name:</label>
                    <input data-parsley-minlength="3" type="text" class="form-control" id="name" name="name"
                           value="<?= get_input('name'); ?>" required>
                </div>

                <!-- Status field -->
                <div class="form-group">
                    <label class="control-label" for="sex">Status: </label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="none">Choose your status</option>
                        <option value="draft" <?= get_input('status') == "draft" ? "selected" : "" ?>>Draft
                        </option>
                        <option value="pending" <?= get_input('status') == "pending" ? "selected" : "" ?>>Pending
                        </option>
                        <option value="private" <?= get_input('status') == "private" ? "selected" : "" ?>>Private
                        </option>
                        <option value="publish" <?= get_input('status') == "publish" ? "selected" : "" ?>>Publish
                        </option>
                    </select>
                </div>
                <!-- Price field -->
                <div class="form-group">
                    <label class="control-label" for="price">Price:</label>
                    <input data-parsley-trigger="keypress" type="text" class="form-control" id="price" name="price"
                           value="<?= get_input('price'); ?>" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Add product" name="addProduct">
            </form>

        </div>
        <!-- /.container -->
    </div>
<?php require_once("partials/_footer.php"); ?>