<div class="container">    
    <h1>Qui est David ?</h1>
    <?php 
    foreach($props as $article){?>
        <h2><?= $article->title ?></h2>
        <small>Ecrit le <?= $article->date ?></small>
        <p><?= $article->content ?>
        </p>
    <?php }
    ?>
</div>