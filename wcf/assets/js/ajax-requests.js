async function makeRequestAjax(idForm){
        
    const formData = new FormData()
    formData.append('action',object_js.hook)
    formData.append('nonce',object_js.nonce)
    formData.append('idForm',idForm)

    const response = await fetch(object_js.ajax_url,{
        method:'POST',
        body:formData,
        headers: {"Content-type": "application/json; charset=UTF-8"} 
    })

    console.log(response)
}