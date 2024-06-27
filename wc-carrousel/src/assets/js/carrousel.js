import { Modal} from '../../../node_modules/tw-elements/js/tw-elements.es.min.js';
import { deleteItem } from './eventListeners.js';
const modalElement = document.getElementById("modal_create");
const modalInstance = new Modal(modalElement);

async function createCarrousel(form, url) {
    try {
        const request = await fetch(url, {
            method: "POST",
            body: form,
        })

        const response = await request.json()

    } catch (error) {
        console.log(error)
    } finally {
        modalInstance.hide();
        location.reload()
    }
}

async function removeImage(id){
    const form = document.createElement("form")
    const formData = new FormData(form)
    const [delete_image] = objectDelete.hook

    formData.append("action", delete_image)
    formData.append("id", id)
    formData.append("nonce", objectDelete.nonce)

    try {
        const request = await fetch(objectDelete.url, {
            method: "POST",
            body: formData
        })
    } catch (error) {
        console.log(error)
    } finally{
        location.reload()
    }
}

async function deleteCarrouselAsync(id){
    const form = document.createElement("form")
    const formData = new FormData(form)
    const [_,delete_carrousel] = objectDelete.hook
    formData.append("action", delete_carrousel)
    formData.append("id", id)
    formData.append("nonce", objectDelete.nonce)

    try {
        const request = await fetch(objectDelete.url, {
            method: "POST",
            body: formData
        })
    } catch (error) {
        console.log(error)
    } finally{
        location.reload()
    }
}

export{
    createCarrousel,
    modalInstance,
    removeImage,
    deleteCarrouselAsync
}