<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WFC_Helpers')) {
    class WFC_Helpers{
        public static function clearArrayFormCreate(array $data){
            /* REMOTE SAME FIELDS*/
            unset($data['nonce']);
            unset($data['action']);
            unset($data['id']);

            /* SANITIZE SAME FIELDS */
            $data["date"]   = date("Y-m-d");
            $data["name"]   = sanitize_text_field( $data["name"] );
            $data["email"]  = sanitize_text_field( $data["email"] );

            return $data;
        }

        public static function clearArrayAnswers(array $data){
            /* REMOTE SAME FIELDS*/
            unset($data['nonce']);

            /* SANITIZE SAME FIELDS */
            $data["date"]   = date("Y-m-d");
            $data["first_name"]   = sanitize_text_field( $data["first_name"] );
            $data["email"]  = sanitize_text_field( $data["email"] );
            $data["phone"]  = sanitize_text_field( $data["phone"] );
            $data["message"]  = sanitize_text_field( $data["message"] );
            $data["form_id"]  = sanitize_text_field( $data["form_id"] );

            return $data;
        }
        public static function clearArrayFormUpdate(array $data){
            /* REMOTE SAME FIELDS*/
            unset($data['nonce']);
            unset($data['action']);

            /* SANITIZE SAME FIELDS */
            $data["id"]   = sanitize_text_field( $data["id"] );
            $data["name"]   = sanitize_text_field( $data["name"] );
            $data["email"]  = sanitize_text_field( $data["email"] );

            return $data;
        }
        
    }
}