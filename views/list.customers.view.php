<?php $title = "Liste des utilisateurs"; ?>
<?php require_once("partials/_header.php"); ?>
    <div class="main-content">
        <div class="container">
            <h1 class="lead">Liste des Customers</h1>

            <div class="row">
                <a href="" class="btn btn-primary" title="Add a product"><i class="fas fa-plus-circle"></i> Add a
                    Customer</a>
            </div>
            <?php if ($nbre_total_products > 0): ?>
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Name</th>
                            <th scope="col">Billing Address</th>
                            <th scope="col">Total Orders</th>
                            <th scope="col">Total spent</th>
                            <th scope="col">Avatar</th>
                            <th scope="col" colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <th scope="row"><?= $product->id ?></th>
                                <td><?= $product->email ?></td>
                                <td><?= $product->first_name ?>&nbsp;,<?= $product->last_name ?></td>
                                <td><?= $product->billing->address_1 ?></td>
                                <td><?= $product->orders_count ?></td>
                                <td><?= $product->total_spent ?></td>
                                <td><img height='50px' width='50px' src='<?= $product->avatar_url ?>'></td>
                                <td><a href="" class="btn btn-info" title="Edit this customer"><i
                                            class="fas fa-edit"></i></a></td>
                                <td><a href="" class="btn btn-danger" title="Delete this customer"><i
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