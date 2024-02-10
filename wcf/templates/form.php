<?php
if (!defined('ABSPATH')) {
    exit;
}

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;



include_once(dirname(__FILE__)."/../clases/Database.php");
include_once(dirname(__FILE__)."/../clases/Helpers.php");

function form(string $id){
    global $wpdb;
    if(isset($_POST['nonce'])){
        $request_database = new WFC_Database($wpdb);
        $request_database->saveForm(WFC_Helpers::clearArrayAnswers($_POST));
        
        if(sendEmail($id,WFC_Helpers::clearArrayAnswers($_POST))){
            include_once(dirname(__FILE__)."/alerts/success.php");
        };
    }
    
    $nonce = wp_create_nonce("wfc");
    $template = '
        <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="my-5">Formulario</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="" method="POST" id="form_contact">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" aria-describedby="namelHelp" name="first_name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                    </div>';
    $template.= "<input type='hidden' name='nonce' value='{$nonce}'>";
    $template.= "<input type='hidden' name='form_id' value='{$id}'>"; 
    $template.= '<button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>';

    return $template;
}


if( !function_exists("sendEmail") ){
    function sendEmail(string $id_form, array $data){
        global $wpdb;

        ["first_name" => $first_name, "email"=>$email,"phone" => $phone,"message" =>$message] = $data;
        $query_get_email_form = "select email from {$wpdb->prefix}_form where id='{$id_form}'";
        $email_form = $wpdb->get_results($query_get_email_form,"OBJECT");

        //Load Composer's autoloader
        require_once(dirname(__FILE__)."/../vendor/autoload.php");
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'server.aumenta.do';                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'informacion@viassanjose.com.gt';                     //SMTP username
            $mail->Password   = 'V@SFy9IvQBIvBXty';                               //SMTP password
            $mail->SMTPSecure = "ssl";            //Enable implicit TLS encryption
            $mail->Port       = 465;    
            
            $mail->setFrom('informacion@viassanjose.com.gt', "Plugin WCF");
            $mail->addAddress($email_form[0]->email, "WCF");
            $mail->isHTML(true);
            $mail->Subject = 'Mensaje de contacto';
            $mail->Body    = mb_convert_encoding(
                '
                <h3>Nuevo mensaje del formulario de contacto</h3>
                <ul>
                    <li>Nombre: '.$first_name.'</li>
                    <li>Email: '.$email.'</li>
                    <li>Phone: '.$phone.'</li>
                    <li>Message: '.$message.'</li>
                </ul>
            ','ISO-8859-1', 'UTF-8');


            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}