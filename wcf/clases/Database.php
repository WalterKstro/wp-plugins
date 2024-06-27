<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WFC_Database')) {
    
    class WFC_Database{
        private $database;
        private $table_form;
        private $table_answers;

        public function __construct(wpdb $database){
            $this->database = $database;        
            $this->table_answers = "{$database->prefix}_answers";
            $this->table_form = "{$database->prefix}_form";
        }

        public function getForms(){
            return $this->database->get_results("select * from {$this->table_form}");
        }
        public function createForm(array $data){
            $this->database->insert($this->table_form,$data); 
        }
        public function updateForm(array $data){
            $id_form = $data['id'];
            unset($data['id']);

            $this->database->update($this->table_form,$data,["id" => $id_form]); 
        }
        public function saveForm(array $data){
            $this->database->insert($this->table_answers,$data);
        }
        public function getAnswers(string $id_form){
            return $this->database->get_results("select * from {$this->table_answers} where form_id={$id_form}");
        }
        
        public function deleteForm(string $id_form){
            $this->database->delete($this->table_answers,['form_id' => $id_form]);
            $this->database->delete($this->table_form,['id' => $id_form]);
        }
        

    }
}