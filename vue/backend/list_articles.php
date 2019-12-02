<?php ob_start(); 

foreach ($articlesEdited as $post) {
    # code...
print_r($post);

}

 $content = ob_get_clean();
require'templates/layout_backend.php'; 

