<?php $title = "Acceuil"; ?>
<?php require_once("partials/_header.php"); ?>
    <div class="main-content">
        <div class="container">

            <div class="jumbotron">
                <h1 class="lead" style="font-size: 60px"><?= WEBSITE_NAME ?> ?</h1>
                <?= $contenu['acceuil_intro'][get_session('locale')] ?>
            </div>


        </div>
        <!-- /.container -->
    </div>
<?php require_once("partials/_footer.php"); ?>