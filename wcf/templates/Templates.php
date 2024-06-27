<?php
if (!defined('ABSPATH')) {
    exit;
}

require_once(dirname(__FILE__)."/form.php");
require_once(dirname(__FILE__)."/table_answers.php");

if (!class_exists('WFC_Templates')) {
    class WFC_Templates{
        
        public static function getTemplateForm(string $id){
            return form($id);
        }
        public static function getTemplateMessages(array $messages){
            return render_template_answers($messages);
        }
    }
}