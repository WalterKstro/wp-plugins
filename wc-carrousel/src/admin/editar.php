<?php 
use App\Controllers\CarrouselController;
if (!defined('ABSPATH')) {
    exit;
}

if( isset($_GET['id']) ){
    $controllerInstance = new CarrouselController($wpdb);
    $carrousel = $controllerInstance->getCarrousel(sanitize_text_field($_GET['id']));
}
?>

<?php  if(!isset($_GET['id']) || !$carrousel): ?>
    <script>window.location.href = '/wp-admin/admin.php?page=wc-carrousel/src/admin/index.php';</script>
    exit;
<?php endif; ?>

<div class="wrap">
    <?php require_once(dirname(__FILE__) . "/../Views/head_admin_edit.php"); ?>
    <?php require_once(dirname(__FILE__) . "/../Views/table_images.php"); ?>
</div>