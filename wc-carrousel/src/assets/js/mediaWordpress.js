import { drawImages, cutPathImage } from "./utils.js"
import { createCarrousel } from "./carrousel.js"
let listImagesToSave = null


function openMediaFrame(){
    
    const instanceMediaFrame = window.wp.media({
        title: 'Seleccione o suba una imagen',
        button: {
            text: "Seleccionar imagen"
        },
        library: {
            type: 'image'
        },
        multiple: 'add'
    });

    

    if (!instanceMediaFrame) return;
    instanceMediaFrame.open();

    instanceMediaFrame.on('select', () => {
        const state = instanceMediaFrame.state();
        const attachment = state.get('selection')
        const images = attachment.map(e => {
            const { id, sizes, name } = e.toJSON()
            return {
                id,
                sizes,
                name
            }
        })

        drawImages(images)
        const imagesMaped = images.map(({ id, sizes, name }) => {
            return {
                id,
                url: cutPathImage(sizes.full.url),
                name
            }
        })
        
        listImagesToSave = imagesMaped
        if(this){
            setTimeout(() => {
                const idCarrousel = new URL(window.location.href).searchParams.get("id")
                const form = new FormData(document.createElement("form"))
                form.append("action", ajaxObjectImages.hook)
                form.append("nonce", ajaxObjectImages.nonce)
                form.append("images", JSON.stringify(listImagesToSave))
                form.append("id", idCarrousel)
                createCarrousel(form, ajaxObjectImages.url)
            }, 500)
        }
    });
};


export { openMediaFrame, listImagesToSave }