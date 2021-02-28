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
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $woocommerce->delete('products/' . $id, ['force' => true]);
    }
    $products = $woocommerce->get('products', ['per_page' => 100, 'status' => 'publish']);
    if (!empty($_GET['exp'])) {
        header("Content-type: application/vnd-ms-excel");
        header("Content-disposition:attachment; filename=product.xls");
        if(!empty($rows)){
            $separator="\t";
            //Dynamically print out the column names as the first row in the document.
            //This means that each Excel column will have a header.
            echo implode($separator, ["Id","Name","Status","Price","Total Sales"]) . "\n";

            //Loop through the rows
            foreach($products as $product){

                //Create the row
                $row=[$product->id,$product->name,$product->status, $product->price, $product->total_sales];
                //Implode and print the columns out using the
                //$separator as the glue parameter
                echo implode($separator, $row) . "\n";
            }
        }
    }
    if (!empty($_GET['imp'])) {

    }
} catch (HttpClientException $e) {
    // Error message.
    set_flash($e->getMessage(), 'danger');
}
?>
<?php
$nbre_total_products = count($products);

if ($nbre_total_products >= 1) {
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
        $products = $woocommerce->get('products',
            [
                'per_page' => $limit,
                'page' => $page_num,
                'offset' => ($page_num - 1) * $limit,
                'status' => 'publish'
            ]);

    } catch (HttpClientException $e) {
        // Error message.
        set_flash($e->getMessage(), 'danger');
    }
    $pagination = '<nav class="text-center"><ul class="pagination">';

    if ($last_page != 1) {
        if ($page_num > 1) {
            $previous = $page_num - 1;
            $pagination .= '<li><a href="list.products.php?page=' . $previous . '" aria-label="Precedent"><span aria-hidden="true">&laquo;</span></a></li>';

            for ($i = $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++) {
                if ($i > 0) {
                    $pagination .= '<li> <a href="list.products.php?page=' . $i . '">' . $i . '</a></li>';
                }
            }
        }

        $pagination .= '<li class="active"><a href="#">' . $page_num . '</a></li>';

        for ($i = $page_num + 1; $i <= $last_page; $i++) {
            $pagination .= '<li><a href="list.products.php?page=' . $i . '">' . $i . '</a></li> ';

            if ($i >= $page_num + $nbre_pages_max_gauche_et_droite) {
                break;
            }
        }

        if ($page_num != $last_page) {
            $next = $page_num + 1;
            $pagination .= '<li><a href="list.products.php?page=' . $next . '"aria-label="Suivant"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    $pagination .= '</nav></ul>';
    require_once("views/list.products.view.php");
} else {
    set_flash("Aucun produit pour le moment...");
    redirect("index.php");
}
