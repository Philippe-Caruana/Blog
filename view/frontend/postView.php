<?php 

$title = htmlspecialchars($post->title);

ob_start();

?>

<p id="chapter-content" class="backlink">

    <a href="index.php#chapters">Retour à la liste des chapitres</a>

</p>

<article>

    <h3><?= htmlspecialchars($post->title) ?><em> le <?= $post->creation_date_fr ?></em></h3>
    
    <p><?= nl2br(htmlspecialchars($post->content)) ?></p>

</article>

<section id="comments">

    <h3>Commentaires</h3>
    
    <?php
        
        if(!empty($_SESSION)) {

            if(isset($_GET['report']) && $_GET['report'] == "success")
            {
        ?>      
                <div style="text-align: center">
                    <p class="alert alert-success fade-out inline">Merci. Le commentaire a bien été signalé.</p>
                </div>
        <?php
            }
        }

        while($comment = $comments->fetch())
        {
    ?>      
            <div class="frame">
                
                <p>
                    <?= '<b>' . htmlspecialchars($comment->username) . '</b>, le ' . htmlspecialchars($comment->publish_date_fr);

                if($comment->groups_id === "1") {
                    echo '<span class="author">Auteur</span>';
                }

                if (!empty($_SESSION)) {
                    if (!in_array($comment->id, $reportedCommentsId) && $comment->username !== $_SESSION['username'] && $comment->groups_id !== "1") {
    ?>              
                        <span class="float-r">
                        
                            <i class="fas fa-exclamation-triangle"></i>

                            <a href="index.php?action=report&id=<?= $comment->posts_id ?>&comment-id=<?= $comment->id ?>" title="Signaler le commentaire de <?= htmlspecialchars($comment->username); ?>">Signaler</a>

                        </span>
    <?php
                    }
                }
    ?>
                </p>
        
                <p><?= htmlspecialchars($comment->comment) ?></p>

            </div>
    <?php
        }
    
        if(!empty($_SESSION)) {
    ?>         
            <div id="add-comment">

                <form method="post" action="index.php?action=addComment&id=<?= $post->id ?>">

                    <label for="comment">Ajouter un commentaire <i class="far fa-comment-dots"></i></label>

                    <textarea id="comment" name="comment"></textarea>
                    
                    <div>

                        <input type="submit" value="Envoyer">

                    </div>

                </form>

            </div>
    <?php 
        }
        else {
    ?>
            <div style="text-align: center">
                <p class="alert alert-primary fade-out inline">Pour me laisser un commentaire, veuillez vous <a href="index.php?action=login#authentication" class="alert-link">connecter.</a></p>
            </div>
    <?php
        }
    ?>

</section>

<?php

    $content = ob_get_clean();
    
    require('view/frontend/template.php'); 

?>