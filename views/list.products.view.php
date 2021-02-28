<?php $title = "Liste des utilisateurs"; ?>
<?php require_once("partials/_header.php"); ?>
    <div class="main-content">
        <div class="container">
            <h1 class="lead">Liste des Produits</h1>

            <div class="row">
                <div class="col col-md-6">
                    <a href="add.product.php" class="btn btn-primary" title="Add a product"><i
                            class="fas fa-plus-circle"></i>
                        Add a
                        product</a>
                </div>
                <div class="col col-md-6">
                    <span class="pull-right">
                        <a href="?exp=excel" class="btn btn-success" title="Export to excel"><i
                                class="fas fa-file-export"></i>
                            Export</a>
                    <a href="?imp=excel" class="btn btn-warning" title="Import from excel"><i
                            class="fas fa-file-import"></i>
                        Import</a>
                    </span>

                </div>

            </div>
            <?php if ($nbre_total_products > 0): ?>

                <div class="row">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total Sales</th>
                            <th scope="col">Picture</th>
                            <th scope="col" colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <th scope="row"><?= $product->id ?></th>
                                <td><?= $product->name ?></td>
                                <td><?= $product->status ?></td>
                                <td><?= $product->price ?></td>
                                <td><?= $product->total_sales ?></td>
                                <td><img height='50px' width='50px' src='<?= $product->images[0]->src ?>'></td>
                                <td><a href="edit.product.php?id=<?= $product->id ?>" class="btn btn-info"
                                       title="Edit this product"><i
                                            class="fas fa-edit"></i></a></td>
                                <td><a href="?id=<?= $product->id ?>" class="btn btn-danger" title="Delete this product"
                                       onclick="return confirm('Do you really want to delete this product?');"><i
                                            class="fas fa-trash"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div id="pagination"><?= $pagination ?></div>
            <?php endif; ?>
        </div>
        <!-- /.container -->
    </div>
<?php require_once("partials/_footer.php"); ?>