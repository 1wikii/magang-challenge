<?php foreach ($errors as $error) : ?>

   <div class="alert alert-warning" role="alert">
      <?= esc($error) ?>
   </div>
<?php endforeach ?>