<?php
require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php");

if(isset($_SESSION['login'])){
	if($myprojects == true){
		echo '<strong>Filtre</strong> : <a href="'.WEBSITE_LINK.'projects">Tous les projets</a> - Mes projets';
	}
	else{
		echo '<strong>Filtre</strong> : Tous les projets - <a href="'.WEBSITE_LINK.'projects'.DS.'myprojects">Mes projets</a>';
	}
}

$idCurrentProject = 0;

foreach($projects as $project){

	if($idCurrentProject != $project->PROJECT_ID){

		if($idCurrentProject != 0){
			echo '</div>';
		}
		$idCurrentProject = $project->PROJECT_ID;

		echo '<h2><a href="'.WEBSITE_LINK.'projects'.DS.'view'.DS.$project->PROJECT_ID.'">'.$project->PROJECT_SUBJECT.' - '.$project->PROJECT_LOGIN.'</a></h2>';
				
		echo '<div style="position: relative;background-image:url('.WEBSITE_LINK.'data'.DS.'master'.DS.$project->MASTER_ID.'.jpg);width: '.$project->MASTER_WIDTH.'px; height: '.$project->MASTER_HEIGHT.'px;">';
	}
	
	echo '<a href="'.WEBSITE_LINK.'crop'.DS.'upload'.DS.$project->CROP_ID.'"  style="display: block; position: absolute; left:'.$project->CROP_LEFT.'px; top: '.$project->CROP_TOP.'px;width: '.$project->CROP_WIDTH.'px; height: '.$project->CROP_HEIGHT.'px;background-color: black;opacity:0.5;border: 1px solid red;"></a>';
}

require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");
?>
