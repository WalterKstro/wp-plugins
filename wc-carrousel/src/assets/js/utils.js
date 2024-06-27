const wrapperImages = document.getElementById("images")


/**
 * Removes the origin from the given image path.
 *
 * @param {string} path - The image path.
 * @return {string} The image path with the origin removed.
 */
function cutPathImage(path) {
    return path.replace(window.location.origin, "")
}


/**
    * Draws images based on the input array of images.
    *
    * @param {array} images - The array of images to be drawn.
    */
function drawImages(images) {
    
    if(wrapperImages) { 
        wrapperImages.innerHTML = ""

        for (const { id, sizes, name } of images) {
            const image = document.createElement("img")
            image.src = cutPathImage(sizes.thumbnail.url)
            image.id = id
            image.alt = name
            image.classList.add("h-auto", "max-w-full", "rounded-lg")
            wrapperImages.appendChild(image)
        }
    };

}




export {
    drawImages,
    cutPathImage,
}