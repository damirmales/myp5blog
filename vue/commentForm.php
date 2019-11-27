<?php ob_start();

if (!empty($commentErrorMessage)){
?>
<br/><div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    ☝ <strong>Attention! </strong><br>
    <?php
      foreach ($commentErrorMessage as $err) {

          echo $err.'<br/>';
      }
      echo '</div>';
      }
      ?>

<form action="index.php?route=addComment&id=<?= $article['articles_id'] ?>" method="post" name="commentForm">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" placeholder="" value=""  name="nom">
      </div>
      <div class="form-group">             
        <label for="email">Email :</label>
        <input type="email" class="form-control" id="email"  name="email">
      </div>
  
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Votre commentaire</span>
        </div>
        <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="commentFormBtn">Envoyer</button>
    </form>

  <?php $formComment= ob_get_clean();?>

<?php require'vue/comments.php'; ?>
