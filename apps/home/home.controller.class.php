<?php
class homeController{

	public $params = array();
	
	function home(){

		$r = SPDO::getInstance()->prepare("SELECT * FROM  PHOTOS_MASTER");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute();
		$photosMaster = $r->fetchAll();

		//use Imagine\Image\ImageInterface;
		//require_once('phar://'.WEBSITE_PATH.DS."lib".DS."imagine".DS.'imagine.phar');
		//$imagine = new Imagine\Gd\Imagine();
		//$image = $imagine->open(WEBSITE_PATH.DS.'data'.DS.'master'.DS.'1.jpg');

		require_once("home.view.php");
	}

	function projects(){
		$idMaster = (int) isset($this->params[0]) ? $this->params[0] : 0;

		$r = SPDO::getInstance()->prepare("
			SELECT 
				PM.ID AS MASTER_ID, 
				PM.WIDTH AS MASTER_WIDTH, 
				PM.HEIGHT AS MASTER_HEIGHT,
				P.ID AS PROJECT_ID,
				P.SUBJECT AS PROJECT_SUBJECT,
				PC.LEFT AS CROP_LEFT,
				PC.TOP AS CROP_TOP,
				PC.WIDTH AS CROP_WIDTH,
				PC.HEIGHT AS CROP_HEIGHT
			FROM PHOTOS_MASTER PM
			LEFT JOIN PROJECTS P ON P.ID_MASTER=PM.ID
			LEFT JOIN PROJECTS_CROP PC ON P.ID=PC.ID_PROJECT
			WHERE PM.ID=:MASTER_ID
			ORDER BY P.ID ASC");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->bindValue(':MASTER_ID', $idMaster, PDO::PARAM_INT);
		$r->execute();
		$projects = $r->fetchAll();

		require_once("projects.view.php");

	}
}
?>