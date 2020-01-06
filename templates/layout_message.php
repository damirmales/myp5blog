<?php

if (isset($_SESSION["message email contact"])) { 
    ?>

  <br/><div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    ☝ <strong>Attention! </strong><?= $_SESSION["message email contact"] ?></div>



    <?php
    $_SESSION["message email contact"] = [];

}



