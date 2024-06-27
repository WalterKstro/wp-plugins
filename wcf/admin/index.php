<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once(dirname(__FILE__) . '/../clases/Database.php');
require_once(dirname(__FILE__) . '/../clases/Helpers.php');


global $wpdb;
$requests_database = new WFC_Database($wpdb);

if( isset($_POST['nonce']) ){
    if( $_POST['action'] == 1 ){ 
        $requests_database->createForm(WFC_Helpers::clearArrayFormCreate($_POST));
     }

    if( $_POST['action'] == 2 ){
        $requests_database->updateForm(WFC_Helpers::clearArrayFormUpdate($_POST));
    }

    if( $_POST['action'] == 4 ){
        $requests_database->deleteForm($_POST['id']);
    }
}


$forms = $requests_database->getForms();

?>


<div class="wrap"><!--CLASE DE WORDPRESS-->
    <div class="container-fluid">
        <?php include_once(dirname(__FILE__)."/../templates/delete_form.php")  ?>
        <div class="row mb-5">
            <div class="col d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Forms</h3>
                <button type="button" class="btn btn-primary" id="modal_btn" onclick="createForm('Crear formulario');"><span class="lh-base dashicons dashicons-plus"></span> Crear formulario</button>
            </div>
        </div>
        <div class="row">
            <!-- Modal -->
            <?php include_once(dirname(__FILE__)."/modals/createUpdate.php")  ?>
            <?php include_once(dirname(__FILE__)."/modals/showMessages.php")  ?>
        </div>
        <div class="row">
            <div class="col table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Mensajes</th>
                            <th scope="col">Shortcode</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($forms as $form) : ?>
                            <tr>
                                <th><?= $form->id  ?></th>
                                <td><?= $form->name  ?></td>
                                <td><?= $form->email  ?></td>
                                <td><?= $form->date ?></td>
                                <td class="text-center"><button class="btn btn-sm" onclick="showMessages('Ver mensajes','<?= $form->id?>')"><span class="dashicons dashicons-format-chat"></span></button></td>
                                <td>[wfc_form id=<?= $form->id ?>]</td>
                                <td>
                                    <span><button type="button" class="btn btn-sm" onclick="editForm('Editar formulario','<?= $form->id ?>','<?= $form->name ?>','<?= $form->email ?>')"><span class="dashicons dashicons-edit"></span></button></span>
                                    <span><button type="button" class="btn btn-sm" onclick="modalDeleteForm('<?= $form->id ?>')"><span class="dashicons dashicons-trash"></span></button></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

