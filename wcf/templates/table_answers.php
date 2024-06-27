<?php
if (!defined('ABSPATH')) {
    exit;
}

function render_template_answers(array $messages){
    $template = '
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo</th>
                <th scope="col">Mensaje</th>
                <th scope="col">Fecha</th>
            </tr>
            </thead>
            <tbody>
            ';
    foreach($messages as $message){
        $template.="
            <tr>
                <th>{$message->id}</th>
                <td>{$message->first_name}</td>
                <td>{$message->phone}</td>
                <td>{$message->email}</td>
                <td>{$message->message}</td>
                <td>{$message->date}</td>
            </tr>
        ";
    };

    $template.="
            </tbody>
        </table>
    ";
    return $template;
}