<?php
session_start();
require_once('includes/init.php.');
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
    $orders = $woocommerce->get('orders',['per_page' => 100]);
    $products = $woocommerce->get('products', ['per_page' => 100, 'status' => 'publish']);
    $customers = $woocommerce->get('customers',['per_page' => 100]);
    $ordersCount = count($orders);
    $customersCount = count($customers);
    $productsCount = count($products);
    //you can set any date which you want
    $query = ['date_min' => '2021-01-01', 'date_max' => '2021-12-31'];
    $sales = $woocommerce->get('reports/sales', $query);
    $salesTotal = $sales[0]->total_sales;

} catch (HttpClientException $e) {
    // Error message.
    set_flash($e->getMessage(), 'danger');
}
//--On teste l'existence de l'id dans l'adresse
if (!empty($_GET['id'])) {
    //--Si l'id existe, on recupère les données en bd
    $user = find_user('id', $_GET['id'], 'users');
    if (!$user) {
        redirect('index.php');
    }

} else {
    //--Si l'id n'existe pas, on le redirige avec les bons
    redirect("profile.php?id=" . get_session('user_id'));
}

require_once("views/profile.view.php");

