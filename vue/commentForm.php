<?php ob_start(); ?>
<form action="index.php?route=addComment&id=<?= $article['articles_id'] ?>" method="post">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" placeholder="" value="" required name="nom">
      </div>
      <div class="form-group">             
        <label for="email">Email :</label>
        <input type="email" class="form-control" id="email" required name="email">
      </div>
  
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Votre commentaire</span>
        </div>
        <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
  <?php $content = ob_get_clean();?>