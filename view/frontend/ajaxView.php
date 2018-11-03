<?php 

ob_start();
    
    $nb_chapters = count($chapters);

    for($i=0; $i < $nb_chapters; $i++)
    {
        //echo $i;
?>
        <article class="chapter<?php if($i == 0 || $i == 3){ echo ' max-w';}?>">

            <h3><?= htmlspecialchars($chapters["$i"]['title']) ?> le <?= $chapters["$i"]['creation_date_fr'] ?></h3>
            
            <p><?= substr(nl2br(htmlspecialchars($chapters["$i"]['content'])), 0, 700) ?> ...</p>

            <div class="read-more">
                <a href="index.php?action=post&id=<?= $chapters["$i"]['id'] ?>#chapter-content" title="<?= htmlspecialchars($chapters["$i"]['title']) ?>">Lire la suite</a>
            </div>

        </article>

<?php
    }
?>

    </div>

<?php

        if($nextPage <= $nb_pages) 
        {
    ?>
            <p class="txt-center max-w">
                <a href="index.php?action=load-more-content&page=<?= $nextPage ?>" id="page-<?= $nextPage ?>" onclick="loadChapters(this, event)">Encore plus de chapitres</a>
            </p>

            <div class="content-page-<?= $nextPage ?>"></div>
<?php
        }

$content = ob_get_clean();

echo $content;

?>