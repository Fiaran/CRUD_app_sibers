<?php
if(isset($_SESSION['message'])) :
    ?>

    <div class="msg" role="alert">
        <strong>Хэй!</strong> <?= $_SESSION['message']; ?>

    </div>

    <?php
    unset($_SESSION['message']);
endif;
?>