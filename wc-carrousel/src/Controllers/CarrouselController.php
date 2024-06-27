<?php

namespace App\Controllers;

use wpdb;

if (!defined('ABSPATH')) {
    exit;
}


if (!class_exists("CarrouselController")) {
    class CarrouselController
    {

        private wpdb $wpdb;
        private string $table_carrousel;
        private string $table_carrousel_image;

        public function __construct($wpdb)
        {
            $this->wpdb = $wpdb;
            $this->table_carrousel = "{$this->wpdb->prefix}carrousel";
            $this->table_carrousel_image = "{$this->wpdb->prefix}image";
        }

        public function getCarrousels()
        {
            return $this->wpdb->get_results("select * from {$this->table_carrousel}");
        }
        public function getCarrousel($id)
        {
            return $this->wpdb->get_results("select * from {$this->table_carrousel} where id = {$id}");
        }
        public function getCarrouselImages($id)
        {
            return $this->wpdb->get_results("select * from {$this->table_carrousel_image} where carrousel_id = {$id}");
        }

        public function createCarrousel($title)
        {
            $this->wpdb->insert($this->table_carrousel, [
                'name' => sanitize_text_field($title),
                'date' => date('Y-m-d')
            ]);
            return $this->wpdb->insert_id;
        }

        public function deleteImage($id) {

            return $this->wpdb->delete($this->table_carrousel_image, ['id' => sanitize_text_field($id)]);   
        }

        public function createCarrouselImages($images, $id_carrousel)
        {
            foreach ($images as $image) {

                $name = $image['name'];
                $id = $image['id'];
                $url = $image['url'];

                $this->wpdb->insert($this->table_carrousel_image, [
                    'carrousel_id' => $id_carrousel,
                    'name' => sanitize_text_field($name),
                    'wordpress_media_id' => sanitize_text_field($id),
                    'url' => sanitize_text_field($url)
                ]);
            }
        }

        public function deleteImages($id_carrousel)
        {
            return $this->wpdb->delete($this->table_carrousel_image, ['carrousel_id' => $id_carrousel]);
        }
        public function deleteCarrousel($id_carrousel)
        {
            return $this->wpdb->delete($this->table_carrousel, ['id' => $id_carrousel]);
        }
    }
}
