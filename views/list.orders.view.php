<?php $title = "Liste des utilisateurs"; ?>
<?php require_once("partials/_header.php"); ?>
    <div class="main-content">
        <div class="container">
            <h1 class="lead">Liste des Commandes</h1>

            <div class="row">
                <a href="" class="btn btn-primary" title="Add an order"><i class="fas fa-plus-circle"></i> Add an order</a>
            </div>
            <?php if ($nbre_total_products > 0): ?>
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Status</th>
                            <th scope="col" colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <th scope="row"><?= $product->id ?></th>
                                <td><?= $product->billing->first_name ?>&nbsp;<?= $product->billing->last_name ?></td>
                                <td><?= $product->billing->address_1 ?>&nbsp;,<?= $product->billing->address_2 ?></td>
                                <td><?= $product->billing->phone ?></td>
                                <td><?= $product->date_created ?></td>
                                <td><?= $product->status ?></td>
                                <td><a href="" class="btn btn-info" title="Edit this order"><i class="fas fa-edit"></i></a>
                                </td>
                                <td><a href="" class="btn btn-danger" title="Delete this order"><i
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