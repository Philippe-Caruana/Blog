<?php 

$title = htmlspecialchars($post['title']);

ob_start();

?>

<p id="chapter-content" class="backlink">

    <a href="index.php#chapters">Retour à la liste des chapitres</a>

</p>

<article>

    <h3><?= htmlspecialchars($post['title']) ?><em> le <?= $post['creation_date_fr'] ?></em></h3>
    
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

</article>

<section id="comments">

    <h3>Commentaires</h3>

    <?php

        while($comment = $comments->fetch())
        {
    ?>  
            <div class="frame">

                <p><?= '<b>' . htmlspecialchars($comment['author']) . '</b>, le ' . htmlspecialchars($comment['publish_date_fr']); ?></p>

                <p><?= htmlspecialchars($comment['comment']) ?></p>

            </div>
    <?php
        }
    ?>
    
</section>

<?php

    $content = ob_get_clean();
    
    require('view/frontend/template.php'); 

?>