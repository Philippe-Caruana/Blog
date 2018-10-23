<?php 

$title = "Jean Forteroche : Billet simple pour l'Alaska";

ob_start();
    
?>
    <section>

        <h2 id="chapters">Liste des chapitres</h2>
    
        <div id="articles-container">
<?php
    
    while ($data = $posts->fetch())
    {
?>
        <article class="chapter">

            <h3><?= htmlspecialchars($data->title) ?> le <?= $data->creation_date_fr ?></h3>
            
            <p><?= substr(nl2br(htmlspecialchars($data->content)), 0, 700) ?> ...</p>

            <div class="read-more">
                <a href="index.php?action=post&id=<?= $data->id ?>#chapter-content" title="<?= htmlspecialchars($data->title) ?>">Lire la suite</a>
            </div>

        </article>

<?php
    }

$posts->closeCursor();

?>

        </div>

    </section>

<?php

$content = ob_get_clean();

require('view/frontend/template.php');

?>