<?php

namespace App\Modelos;

if (!defined('ABSPATH')) {
    exit;
}


if (!class_exists("Carrousel")) {
    class Carrousel{

        private int $id;
        private string $title;
        private string $date;
        private array $images;

        public function __construct($id, $title, $date, $images)
        {
            $this->id = $id;
            $this->title = $title;
            $this->date = $date;
            $this->images = $images;
        }
    }
}