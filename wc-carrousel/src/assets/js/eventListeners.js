import { openMediaFrame,listImagesToSave } from './mediaWordpress.js'
import { createCarrousel, modalInstance, removeImage,deleteCarrouselAsync } from './carrousel.js'

const formCreate = document.getElementById("form__create")
const parentExplorer = document.querySelector(".media-explorer")
const btnShowModalCreateCarrousel = document.querySelector("#create_carrousel")
const wrapperImages = document.getElementById("images")
const btnAddImage = document.querySelector("#add_image")
const tbodyImages = document.querySelector("#tbody-images")
const tbodyCarrousel = document.querySelector("#tbody-carrousel")

function requestMakeCarrousel() {
    formCreate.addEventListener("submit", evt => {
        evt.preventDefault()

        const form = new FormData(evt.target)
        form.append("action", objectJs.hook)
        form.append("nonce", objectJs.nonce)
        form.append("images", JSON.stringify(listImagesToSave))
        createCarrousel(form, objectJs.url)
    })
}

function openMediaExplorer() {
    
    parentExplorer.addEventListener("click", e => {
        const isOpenExplorer = e.target.classList.contains('media-explorer')
        if (isOpenExplorer) {
            openMediaFrame()
        }
        return null;
    })
}

function showModalCreateCarrousel() {
    btnShowModalCreateCarrousel.addEventListener("click", e => {
        wrapperImages.innerHTML = ""
        modalInstance.show();
    })
}

function addNewImage() {
    btnAddImage.addEventListener("click", e => {
        openMediaFrame.call(true)
    })
}

function deleteItem(){
    tbodyImages.addEventListener("click", e => {
        const target = e.target
        const isValid = target.classList.contains("delete")
        if (isValid) {
            const id = target.getAttribute("id")
            removeImage(id)
        }
    })
}

function deleteCarrousel(){
    tbodyCarrousel.addEventListener("click", e => {
        const target = e.target
        const isValid = target.classList.contains("delete")
        if (isValid) {
            const id = target.getAttribute("id")
            deleteCarrouselAsync(id)
        }
    })
}
export {
    requestMakeCarrousel,
    openMediaExplorer,
    showModalCreateCarrousel,
    addNewImage,
    deleteItem,
    deleteCarrousel
}