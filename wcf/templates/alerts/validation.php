<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        const formContact = document.getElementById("form_contact");

        function validate(object) {
            for (const key in object) {
                if (object[key] === '') {
                    return false;
                }
            }

            return true;
        }

        function saveAnswer(evt) {
            const {nonce,...rest} = Object.fromEntries(new FormData(evt.target))
            
            if (!validate(rest)) {
                Swal.fire({
                    icon: "warning",
                    text: "Todos los campos son obligatorios",
                    showConfirmButton: false,
                    timer: 2500
                });
                evt.preventDefault()
            }
        }
        formContact.addEventListener('submit', saveAnswer);
    });
</script>