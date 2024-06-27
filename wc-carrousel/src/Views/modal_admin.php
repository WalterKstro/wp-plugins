<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<!--Vertically centered modal-->
<div data-twe-modal-init aria-hidden="true" class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="modal_create" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
    <div  data-twe-modal-dialog-ref class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
        <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
                <!-- Modal title -->
                <h5 class="text-gray-900 text-xl font-medium leading-normal" id="exampleModalCenterTitle">
                    Crear nuevo carrousel
                </h5>
                <!-- Close button -->
                <button type="button" class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300" data-twe-modal-dismiss aria-label="Close">
                    <span class="[&>svg]:h-6 [&>svg]:w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="relative p-4">
                <form class="w-full" method="POST" action="" id="form__create">
                    <div class="mb-5">
                        <label for="title" class="block mb-2 text-base font-medium text-gray-900">Nombre del carrousel</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border  border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Los productos más vendidos" required />
                        <input type="hidden" class="hidden" name="nonce" value="<?= wp_create_nonce('kstro'); ?>">
                    </div>
                    <div class="mb-5">
                        <label for="images" class="flex items-center gap-2 mb-2 text-base font-medium text-gray-900">
                            Selecciona las imagenes
                            <button type="button" class="media-explorer px-1 py-1  bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <svg class="media-explorer w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path class="media-explorer" fill-rule="evenodd" d="M5 4a2 2 0 0 0-2 2v1h10.968l-1.9-2.28A2 2 0 0 0 10.532 4H5ZM3 19V9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm9-8.5a1 1 0 0 1 1 1V13h1.5a1 1 0 1 1 0 2H13v1.5a1 1 0 1 1-2 0V15H9.5a1 1 0 1 1 0-2H11v-1.5a1 1 0 0 1 1-1Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </label>
                    </div>
                    <div id="images" class="flex items-center gap-2 mb-5 flex-wrap"></div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Crear nuevo carrousel</button>
                </form>
            </div>
        </div>
    </div>
</div>