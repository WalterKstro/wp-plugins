<?php

use App\Controllers\CarrouselController;

if (!defined('ABSPATH')) {
    exit;
}
$carrousel = new CarrouselController($wpdb);
$id_carrousel = sanitize_text_field($_GET['id']);
?>




<div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-50">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Imagen
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody id="tbody-images">
            <?php foreach ($carrousel->getCarrouselImages($id_carrousel) as $image) : ?>
                <tr class="bg-white border-b text-gray-900 font-medium even:bg-slate-200">
                    <th scope="row" class="px-6 py-4 whitespace-nowrap">
                        <?= $image->id ?>
                    </th>
                    <td class="px-6 py-4">
                        <?= $image->name ?>
                    </td>
                    <td class="px-6 py-4">
                        <a href="<?= $image->url ?>" class="w-6 h-6 block" target="_blank">
                            <svg class="w-6 h-6 text-gray-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="rgb(29 78 216)" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M9 2.2V7H4.2l.4-.5 3.9-4 .5-.3Zm2-.2v5a2 2 0 0 1-2 2H4v11c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm.4 9.6a1 1 0 0 0-1.8 0l-2.5 6A1 1 0 0 0 8 19h8a1 1 0 0 0 .9-1.4l-2-4a1 1 0 0 0-1.7-.2l-.5.7-1.3-2.5ZM13 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd" />
                            </svg>
                        </a>

                    </td>
                    <td class="px-6 py-4">
                        <button type="button" class="delete px-1 py-1  bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" id="<?= $image->id ?>">
                            <svg class="pointer-events-none w-6 h-6 text-gray-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path  class="delete" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>