<?php 

$title = "Bienvenue dans l'interface d'administration"; ?>

<?php ob_start(); ?>

<section id="comments-panel">
	
	<h3>
		<i class="far fa-comments"></i> Modération des commentaires
	</h3>

	
		
		<div class="txt-center">
			<p class="alert alert-info inline">Seuls les commentaires ayant été signalés au moins 3 fois apparaitront dans cette liste</p>
		</div>

	<?php

		if (isset($_GET['republish-comment']) && $_GET['republish-comment'] == 'success') 
		{
			echo '<div class="txt-center"><p class="alert alert-success inline fade-out mt-none">Le commentaire a bien été republié.</p></div>';
		}

		if (isset($_GET['republish-comment']) && $_GET['republish-comment'] == 'failed') 
		{
			echo '<div class="txt-center"><p class="alert alert-danger inline fade-out mt-none">Le commentaire n\'a pas pu être republié.</p></div>';
		}

		if (isset($_GET['delete-comment']) && $_GET['delete-comment'] == 'success') 
		{
			echo '<div class="txt-center"><p class="alert alert-success inline fade-out mt-none">Le commentaire a bien été supprimé.</p></div>';
		}

		if (isset($_GET['delete-comment']) && $_GET['delete-comment'] == 'failed') 
		{
			echo '<div class="txt-center"><p class="alert alert-danger inline fade-out mt-none">Le commentaire n\'a pas pu être supprimé.</p></div>';
		}

		if(empty($comments)) {
			echo '<div class="txt-center"><p class="alert alert-dark inline">Aucun commentaire n\'a été signalé 3 fois ou plus.</p></div>';		
		}

		foreach ($comments as $comment) {
		?>
				<div class="frame">

					<div>
						<p>
							<strong><?= htmlspecialchars($comment->username); ?></strong> le <?= $comment->date_fra; ?>
						</p>
						<p><?= nl2br(htmlspecialchars($comment->comment)); ?></p>
						<div>
							<span class="nb_report"><?= $comment->nb_report; ?> signalements</span>
								
							<a href="index.php?action=republish-comment&id=<?= htmlspecialchars($comment->id); ?>" title="Republier le commentaire" class="m-rl">
								<i class="far fa-paper-plane"></i> Republier
							</a>
							<a data-link="index.php?action=delete-comment&id=<?= $comment->id; ?>" onclick="showModal(this, event)" href="#" title="Supprimer le commentaire">
								<i class="fas fa-trash-alt" style="color:#ff3333"></i> Supprimer
							</a>

						</div>
					</div>

				</div>
		<?php 
		}
		?>
			

		<?php //echo '<p>Il y a ' . $nb_comments . ' commentaires, donc ' . $nb_pages_comments . ' pages à afficher</p>'; ?>
		
		<?php

			if($nb_pages_comments >= 2)
			{
				echo '<div class="pagination">';

				for($i=1; $i<= $nb_pages_comments; $i++)
				{
					if((!isset($_GET['comment-page']) && $i == 1) || (isset($_GET['comment-page']) && $i == $_GET['comment-page']))
					{
						echo '<span class="current-page">' . $i . '</span>';

					}
					else
					{
						echo '<a class="next-page" href="index.php?action=admin&comment-page=' . $i . '" title="Se rendre sur la page ' . $i . '">' . $i . '</a>';
					}

				}

				echo '</div>';
			}
		?>
</section>

<section id="edit-articles-panel">
	
	<h3>
		<i class="far fa-edit"></i> Édition des articles
	</h3>
	
	<div class="txt-center">
		<p class="alert alert-info inline">Liste des articles par ordre de parution (du plus récent au plus ancien). Cliquez dessus pour lire l'article et le modifier.</p>
	</div>
	
	<?php

		if (isset($_GET['delete-post']) && $_GET['delete-post'] == 'success') 
		{
			echo '<div class="txt-center"><p class="alert alert-success inline fade-out mt-none">L\'article a bien été supprimé.</p></div>';
		}

		if (isset($_GET['delete-post']) && $_GET['delete-post'] == 'failed') 
		{
			echo '<div class="txt-center"><p class="alert alert-danger inline fade-out mt-none">L\'article n\'a pas pu être supprimé.</p></div>';
		}
	
		$num_article = 1;

		while($post = $posts->fetch())
		{
	?>
			<div class="frame">

				
				<div>

					<p><?= $num_article ?>. 

						<a href="index.php?action=post&id=<?= $post->id ?>#chapter-content"><?= $post->title; ?></a>
					
					</p>
					<p>

						<a href="#" onclick="showModal(this, event)" data-link="index.php?action=delete-post&id=<?= $post->id ?>" title="Supprimer l'article <?= $post->title ?>"><i class="fas fa-trash-alt" style="color:#ff3333"></i> Supprimer</a> 
				
					
						<a href="index.php?action=edit-post&id=<?= $post->id ?>#chapter-content" title="Modifier l'article <?= $post->title ?>" class="m-rl"><i class="far fa-edit"></i> Modifier</a>
					

					
						<a href="index.php?action=post&id=<?= $post->id ?>#chapter-content" title="Visualiser l'article <?= $post->title ?>"><i class="fas fa-eye" style="color:#3c6382"></i> Visualiser</a>
					

					
						<span style="margin: 0px 12px"> <b>Date de publication :</b> <?= $post->publish_date; ?></span>

					</p>

				</div>

				

			</div>
	<?php
			$num_article++;
		}
	?>

	<div id="myModal" class="modal">

		<div class="modal-content">

			<div class="modal-header">
				<span class="close">&times;</span>
				<h3>Êtes-vous sûr de vouloir supprimer cet article ?</h3>
			</div>

			<div class="modal-body">
				<p style="margin-bottom:0px">
					<a href="#" id="confirmation-btn-modal" class="btn btn-primary" title="Confirmer la suppression de l'article">Oui</a>
					<a href="#" id="cancel-post-delete" class="btn btn-danger" title="Annuler et revenir sur la page d'administration">Non</a>
				</p>
			</div>
		</div>

	</div>
	
	<?php /*echo '<p>Il y a ' . $nb_posts . ' articles, donc ' . $nb_pages_posts . ' pages à afficher</p>'; */?>
	<?php

	if($nb_pages_posts >= 2)
	{
		echo '<div class="pagination">';

		for($i=1; $i<= $nb_pages_posts; $i++)
		{
			if((!isset($_GET['chapter-page']) && $i == 1) || (isset($_GET['chapter-page']) && $i == $_GET['chapter-page']))
			{
				echo '<span class="current-page">' . $i . '</span>';

			}
			else
			{
				echo '<a class="next-page" href="index.php?action=admin&chapter-page=' . $i . '#edit-articles-panel" title="Se rendre sur la page ' . $i . '">' . $i . '</a>';
			}

		}

		echo '</div>';
	}
	?>
</section>

<section id="create-articles-panel">
	
	<h3>
		<i class="fas fa-pencil-alt"></i> Rédaction d'un nouvel article
	</h3>
	
	<?php

	if (isset($_GET['publish-post']) && $_GET['publish-post'] == 'success') 
	{
		echo '<div class="txt-center"><p class="alert alert-success inline fade-out">L\'article a bien été publié.</p></div>';
	}

	if (isset($_GET['publish-post']) && $_GET['publish-post'] == 'failed') 
	{
		echo '<div class="txt-center"><p class="alert alert-danger inline fade-out">L\'article n\'a pas pu être publié.</p></div>';
	}

	if (isset($_GET['empty-fields']) && $_GET['empty-fields'] == 'true') 
	{
		echo '<div class="txt-center"><p class="alert alert-danger inline fade-out">Vous devez renseigner tous les champs.</p></div>';
	}
	?>

	<form method="post" action="index.php?action=publish-post">

		<div class="frame">
			
			<label for="title">Titre de l'article</label>

			<input type="text" id="title" name="title">

		</div>

		<div class="frame">
			
			<label for="content">Contenu de l'article</label>

			<textarea id="content-article" name="content"></textarea>
			
			<div style="text-align:center">
			
				<input class="btn btn-primary" type="submit" value="Publier l'article">
				
			</div>

		</div>

	</form>

</section>

<?php $content = ob_get_clean();

require('view/frontend/template.php');

?>