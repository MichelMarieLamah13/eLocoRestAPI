<?php session_start(); ?>
<?php require_once('includes/init.php.'); ?>
<?php
require_once('filters/auth.filter.php');
require_once('vendor/autoload.php');
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

?>
<?php
//woocommerce
$woocommerce = new Client($_SESSION['link'],
    $_SESSION['ck'],
    $_SESSION['cs'],
    [
        'wp_api' => true, 'version' => 'wc/v1',
    ]);
try {
    $categories = $woocommerce->get('products/categories');
} catch (HttpClientException $e) {
    // Error message.
    set_flash($e->getMessage(), 'danger');
}
?>
    <!--Les inclusions nécessaires-->
<?php
//Si le formulaire a été soumis
if (isset($_POST['addProduct'])) {
    //Si tous les champs ont été remplis
    if (not_empty(['name', 'status', 'price'])) {
        $errors = []; //Tableau contenant l'ensemble des erreurs
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
            $data = [
                'name' => $name,
                'regular_price' => $price,
                'status'=>$status
            ];
            try {
                $woocommerce->post('products',$data);
            } catch (HttpClientException $e) {
                // Error message.
                set_flash($e->getMessage(), 'danger');
            }
            redirect('list.products.php');
        } else {
            save_input_data();
        }
    } else {
        $errors[] = "Veuillez SVP remplir tous les champs!";
        save_input_data();
    }
} else {
    clear_input_data();
}
?>
<?php
require_once("views/add.product.view.php");

