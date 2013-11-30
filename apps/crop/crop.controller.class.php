<?php
class cropController{

	public $params = array();
	
	function upload(){

		$idCrop = $this->params[0];

		$r = SPDO::getInstance()->prepare("SELECT * FROM PROJECTS_CROP WHERE ID = ?");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute(array($idCrop));
		$crops = $r->fetchAll();
		if (!empty($crops))
			$crop = $crops[0];
		else
			$message = "Cet identifiant n'est associé à aucun crop.";

		debug($crop);

		if(!empty($_FILES['piczle']))
		{
			require_once('phar://'.WEBSITE_PATH.DS."lib".DS."imagine".DS.'imagine.phar');
			require_once(WEBSITE_PATH.DS.'inc'.DS.'class'.DS.'SPDO.class.php');
			
			$image = $_FILES['piczle'];

			if (empty($image['tmp_name']))
				$message = 'Impossible de récupérer votre Piczle';
			else
			{
				$imagine = new Imagine\Gd\Imagine();
				
				$image = $imagine->open($image['tmp_name']);
				$width = $image->getSize()->getWidth();
				$height = $image->getSize()->getHeight();
				
				if ($width != $crop->WIDTH OR $height != $crop->HEIGHT)
					$message = "Votre Piczle ne fait pas la bonne taille :( Assurez de vous de fournir un Piczle de ".$crop->WIDTH."px de long par ".$crop->HEIGHT."px de hauteur";
				else {

					$insert = SPDO::getInstance()->prepare("INSERT INTO PHOTOS_CROP(ID_CROP) VALUES(:idCrop)");
					$insert->execute(array(
						'idCrop' => $idCrop
						));
					$id = SPDO::getInstance()->lastInsertId();
					
					$image->save(WEBSITE_PATH.DS.'data'.DS.'piczle'.DS.$id.'.jpg');
					$image->save(WEBSITE_PATH.DS.'data'.DS.'piczle'.DS.$id.'_'.$tailleMiniature.'x'.$tailleMiniature.'.jpg', array('quality' => 100));
					
					header('Location: '.WEBSITE_LINK);
				}

			}
		}

		require_once("upload.view.php");
	}
}
?>