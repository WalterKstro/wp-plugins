<?php
if (!defined('ABSPATH')) {
    exit;
}
 ?>

<div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_title"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="form">
                    <div class="mb-3">
                        <label for="field_name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="field_name" name="name" placeholder="Formulario de login">
                    </div>

                    <div class="mb-3">
                        <label for="field_email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="field_email" aria-describedby="emailHelp" name="email" placeholder="ejemplo@gmail.com">
                    </div>
                    
                    <input type="hidden" name="nonce" value="<?=  wp_create_nonce('wcf') ?>">
                    <input type="hidden" name="action" id="type_action">
                    <input type="hidden" name="id" id="form_id">

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>