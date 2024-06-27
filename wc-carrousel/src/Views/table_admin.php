<?php

use App\Controllers\CarrouselController;

if (!defined('ABSPATH')) {
    exit;
}
$carrousel = new CarrouselController($wpdb);
?>




<div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-50">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Titulo
                </th>
                <th scope="col" class="px-6 py-3">
                    Shortcode
                </th>
                <th scope="col" class="px-6 py-3">
                    Agregar imagen
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody id="tbody-carrousel">
            <?php foreach ($carrousel->getCarrousels() as $carrousel) : ?>
                <tr class="bg-white border-b text-gray-900 font-medium">
                    <th scope="row" class="px-6 py-4 whitespace-nowrap">
                        <?= $carrousel->id ?>
                    </th>
                    <td class="px-6 py-4">
                        <?= $carrousel->name ?>
                    </td>
                    <td class="px-6 py-4">
                        [wc_carrousel id="<?= $carrousel->id ?>"]
                    </td>
                    <td class="px-6 py-4">
                        <a href="<?= admin_url('admin.php?page=wc-carrousel/src/admin/editar.php&id=' . $carrousel->id . '') ?>" class="w-6 h-6 block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="rgb(29 78 216)" viewBox="0 0 24 24">
                                <path d="M4 5h13v7h2V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-2H4V5z"></path>
                                <path d="m8 11-3 4h11l-4-6-3 4z"></path>
                                <path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path>
                            </svg>
                        </a>

                    </td>
                    <td class="px-6 py-4">
                        <button id="<?= $carrousel->id ?>" type="button" class="delete px-1 py-1  bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <svg class="pointer-events-none w-6 h-6 text-gray-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>