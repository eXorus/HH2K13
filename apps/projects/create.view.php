<?php
require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php");
?>

<?php if (isset($erreur)): ?>
	<div class="alert alert-danger">
		<?php echo $erreur ?>
	</div>
<?php endif ?>

	<form action="" method="post" id="form">
		<p>
			<label for="subject">Titre de votre projet</label><input type="text" id="subject" name="subject" />
		</p>
		<p>
			<button id="ajouter" class="btn btn-success">Ajoutez des crops' Piczle</button>
			<input type="submit" onclick="genererFormulaire();" value="Créer mon projet !" class="btn btn-success" id="genererFormulaire" disabled/>
		</p>
	</form>
			
	<section id="mainPhoto" style="background-image: url('<?php echo WEBSITE_LINK; ?>data/master/<?php echo $photoMaster->ID; ?>.jpg'); width:<?php echo $photoMaster->WIDTH; ?>px; height:<?php echo $photoMaster->HEIGHT; ?>px"></section>



<?php
require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");
?>