const ACTIONS = {
    create: 1,
    update: 2,
    select: 3,
    delete: 4
};

function createModal(title,action,idModal) {
    
    const modalForm = new bootstrap.Modal(idModal)
    let titleModal = document.getElementById('modal_title')
    const fieldAction = document.getElementById('type_action')

    if(action === ACTIONS.select) { titleModal = document.getElementById('modal_title_messages') }
    
    modalForm.show()
    titleModal.textContent = title
    fieldAction.value = action
    
};

/** TRIGGERS SHOW MODALS */
function createForm(title = "Default title") {
    const fieldName = document.getElementById('field_name')
    const fieldEmail = document.getElementById('field_email')
    const fieldIdForm = document.getElementById('form_id')
    fieldName.value = ''
    fieldEmail.value = ''
    fieldIdForm.value = ''

    createModal(title,ACTIONS.create,"#modal_form")
};

function editForm(title = "Default title",...rest) {
    createModal(title,ACTIONS.update,"#modal_form")
    fillFieldsFormEdit(rest)
};
function showMessages(title = "Default title",idForm){
    createModal(title, ACTIONS.select,"#modal_messages");
    makeRequestAjax(idForm)    
};


function fillFieldsFormEdit(arrayFields){
    const [idForm,name,email] = arrayFields
    const fieldName = document.getElementById('field_name')
    const fieldEmail = document.getElementById('field_email')
    const fieldIdForm = document.getElementById('form_id')

    fieldName.value = name
    fieldEmail.value = email
    fieldIdForm.value = idForm
};
function formValidate(name,email) {

    if (name === '' || email === '') {
        Swal.fire({
            icon: "warning",
            text: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 2500
        });
    }

    return (name !== '' && email !== '') ? true : false;
};

function saveForm(evt) {
    const form = evt.target
    const { name, email } = Object.fromEntries(new FormData(form))

    if( !formValidate(name,email) ){ evt.preventDefault() }
};


async function makeRequestAjax(idForm){
    const wrapper = document.getElementById('modal-body')
    const formData = new FormData()
    formData.append('action',object_js.hook)
    formData.append('nonce',object_js.nonce)
    formData.append('idForm',idForm)
    formData.append('security', object_js.nonce)

    
    const response = await fetch(object_js.ajax_url,{
        method:'POST',
        body:formData,
    })
    const data = await response.text()
    wrapper.innerHTML = data
    
};

function modalDeleteForm(idForm){
    
    Swal.fire({
        title: "¿Esta seguro?",
        text: "Recuerda eliminar el shortcode de este formulario",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#0d6efd",
        confirmButtonText: "Proceder",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {

            const formDelete = document.getElementById("form_delete");
            const fieldIdForm = document.getElementById("field_id_form");
            const fieldAction = document.getElementById("field_action");

            fieldIdForm.value = idForm
            fieldAction.value = ACTIONS.delete

            formDelete.submit()
        }
      });
};

document.addEventListener("DOMContentLoaded", (event) => {
    const formCreate = document.getElementById("form");
    formCreate.addEventListener('submit', saveForm);
});
