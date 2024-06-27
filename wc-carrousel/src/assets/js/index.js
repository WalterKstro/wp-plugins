import { requestMakeCarrousel, openMediaExplorer,showModalCreateCarrousel, addNewImage, deleteItem, deleteCarrousel } from './eventListeners.js'

document.addEventListener("DOMContentLoaded", e => {
    
    const btnAddImage = document.querySelector("#add_image")
    const btnShowModalCreateCarrousel = document.querySelector("#create_carrousel")
    const parentExplorer = document.querySelector(".media-explorer")
    const formCreate = document.getElementById("form__create")
    const tbodyImages = document.querySelector("#tbody-images")
    const tbodyCarrousel = document.querySelector("#tbody-carrousel")

    if (!window.wp || !window.wp.media) return;
    
    // handler event click to add new image
    btnAddImage && addNewImage()
    // handler event click to show modal
    btnShowModalCreateCarrousel && showModalCreateCarrousel()
    // handler event click to show media frame explorer
    parentExplorer && openMediaExplorer()
    // handler event submit
    formCreate && requestMakeCarrousel()
    // handler event delete
    tbodyImages && deleteItem()
    // handler event delete carrousel
    tbodyCarrousel && deleteCarrousel()
})



