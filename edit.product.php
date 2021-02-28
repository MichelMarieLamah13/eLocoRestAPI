
<?php
session_start();
require_once('includes/init.php.');
require_once('filters/auth.filter.php');
require_once('vendor/autoload.php');
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
?>
<?php
//--On teste l'existence de l'id dans l'adresse
if (!empty($_GET['id'])) {
    //woocommerce
    $woocommerce = new Client($_SESSION['link'],
        $_SESSION['ck'],
        $_SESSION['cs'],
        [
            'wp_api' => true, 'version' => 'wc/v1',
        ]);
    try {
        $product = $woocommerce->get('products/'.$_GET['id']);
    } catch (HttpClientException $e) {
        // Error message.
        set_flash($e->getMessage(), 'danger');
    }

    if (!$product) {
        redirect('list.products.php');
    }

} else {
    //--Si l'id n'existe pas, on le redirige avec les bons
    redirect("list.products.php");
}

if (isset($_POST['editProduct'])) {
    $errors = [];
//--Si tous les champs ne sont pas vides
    if (not_empty(['name', 'status', 'price'])) {
        extract($_POST);
        if (mb_strlen($name) < 3) {
            $errors[] = "Name too short at least (3 characters)";
        }

        if (!in_array($status, ["draft", "pending", "private", "publish"])) {
            $errors[] = "Status must be one of these value ['draft','pending','private','publish']";
        }

        if ($price < 0) {
            $errors[] = "Price must not be negative";
        }
        if (count($errors) == 0) {
            //---Requete pour selectionner les users
            //--Ayant l'email ou le pseudo
            try {
                $data=[
                    'name'=>$name,
                    'status'=>$status,
                    'regular_price'=>$price
                ];
                $woocommerce->put('products/'.$_GET['id'],$data);
            } catch (HttpClientException $e) {
                // Error message.
                set_flash($e->getMessage(), 'danger');
            }


            set_flash('Le produit a été mis à jour avec succès', 'info');
            redirect("list.products.php");

        } else {
            save_input_data();
        }
    } else {
        $errors[] = "Veuillez, remplir tous les champs";
//--On sauvegarde les valeurs en session
        save_input_data();
    }
} else {
    clear_input_data();
}
require_once("views/edit.product.view.php");

