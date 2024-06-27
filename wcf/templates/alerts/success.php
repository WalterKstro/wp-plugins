<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<script>
    Swal.fire({
            icon: "success",
            text: "Hemos recibido tu mensaje",
            showConfirmButton: false,
            timer: 2500
        })
        .then(result => {
            location.href = window.location.href;
        })
</script>