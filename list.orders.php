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
    $products = $woocommerce->get('orders', ['per_page' => 100]);

} catch (HttpClientException $e) {
    // Error message.
    set_flash($e->getMessage(), 'danger');
}
?>
<?php
$nbre_total_products = count($products);

if($nbre_total_products>=1){
    $nbre_products_par_page = 5;

    $nbre_pages_max_gauche_et_droite = 4;

    $last_page = ceil($nbre_total_products / $nbre_products_par_page);

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page_num = $_GET['page'];
    } else {
        $page_num = 1;
    }

    if ($page_num < 1) {
        $page_num = 1;
    } else if ($page_num > $last_page) {
        $page_num = $last_page;
    }

    $limit = $nbre_products_par_page;

    try {
        $products = $woocommerce->get('orders',
            [
                'per_page' => $limit,
                'page' => $page_num,
                'offset' => ($page_num - 1)*$limit
            ]);

    } catch (HttpClientException $e) {
        // Error message.
        set_flash($e->getMessage(), 'danger');
    }
    $pagination = '<nav class="text-center"><ul class="pagination">';

    if ($last_page != 1) {
        if ($page_num > 1) {
            $previous = $page_num - 1;
            $pagination .= '<li><a href="list.orders.php?page=' . $previous . '" aria-label="Precedent"><span aria-hidden="true">&laquo;</span></a></li>';

            for ($i = $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++) {
                if ($i > 0) {
                    $pagination .= '<li> <a href="list.orders.php?page=' . $i . '">' . $i . '</a></li>';
                }
            }
        }

        $pagination .= '<li class="active"><a href="#">' . $page_num . '</a></li>';

        for ($i = $page_num + 1; $i <= $last_page; $i++) {
            $pagination .= '<li><a href="list.orders.php?page=' . $i . '">' . $i . '</a></li> ';

            if ($i >= $page_num + $nbre_pages_max_gauche_et_droite) {
                break;
            }
        }

        if ($page_num != $last_page) {
            $next = $page_num + 1;
            $pagination .= '<li><a href="list.orders.php?page=' . $next . '"aria-label="Suivant"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    $pagination .= '</nav></ul>';
    require_once("views/list.orders.view.php");
}else{
    set_flash("Aucune Commande pour le moment...");
    redirect("index.php");
}
