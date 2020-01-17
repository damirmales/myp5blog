<?php
ob_start();
$errorException = null;
?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            if (!empty($errorException)) {
                ?>
                <div class="container alerte alert-warning">Erreur
                    <button type="button" class="close" data-dismiss="alert">&times;</button><?= $errorException ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<hr>
<?php $content = ob_get_clean(); ?>
<?php require 'templates/layout_errors.php'; ?>

