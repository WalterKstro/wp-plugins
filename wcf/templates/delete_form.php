<?php
if (!defined('ABSPATH')) {
    exit;
}
 ?>

<div class="row">
    <div class="col">
        <form action="" method="POST" id="form_delete">
            <input type="hidden" id="field_action" name="action">
            <input type="hidden" id="field_id_form" name="id">   
            <input type="hidden" id="field_nonce" name="nonce" value="<?= wp_create_nonce("wfc") ?>">
        </form>
    </div>
</div>