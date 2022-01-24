<?php 
declare(strict_types=1);
ini_set('display_errors', '1');
?>


<?php
define("br","<br />");

function setDefaultTZ(){
	$tz=date_default_timezone_get();
	return 'Aujourd\'hui '.myDate().'('.$tz.')';
	
}
function infoFile($file='index.php')
{
	//$file='index.php';
	//	echo 'Fichier :'.$file.br;
	$stat = stat($file);

	/*
	* Affichage de la date et heure de l'accès à ce fichier,
	* identique à l'appel à la fonction fileatime()
	*/
	$d1= 'Date d\'accès : ' . cdate($stat['atime']);

	/*
	* Affiche de la date et heure de modification du fichier,
	* identique à l'appel à la fonction filemtime()
	*/
	$d2= 'Date modification : ' . cdate($stat['mtime']);
	return $d1.' '.$d2;
	/* Affichage du numéro du device */
	//echo 'Numéro du Device : ' . $stat['dev'].br;
	//dirurl("http://www.jeuchenille.com",true);
}

$tree=array();

function createDirectory(){
	$glo= glob_free('./','*');
	echo br.'glo'.br;
	foreach ($glo as $gl)
		echo $gl.br;
	echo br."<strong>dir tree</strong>".br;
	?>
	<form>
	<select>
	<?php
	echo get_tree2('./');
	?>
	</select>
	</form>
	<?php
}
function get_tree2($path = './'){
	//echo 'GET TREE2 :: '.$path.br;
	if (substr($path,-1) !== '/')
		$path .= '/';
	echo 'Chemin:'.$path;
	$dirs = glob_free($path,'*');
	//echo 'dir:'.$dirs;
	if(is_array($dirs))
		foreach ($dirs as $value){
			if(is_dir($value)){
				$tree .= '<option value="'.$value.'/">'.$value.'</option>';
				$tree.=get_tree2($value.'/');
			}
		}
	return $tree;
}
function get_tree($path = './'){
	if (substr($path,-1) !== '/')
		$path .= '/';
	$tree = array();
	$dirs =array();
	$dirs = glob($path.'*');
	foreach ($dirs as $value){
		if(is_dir($value))
			$tree .= "\n".$value.'/'.get_tree($value.'/');
			//$tree .= "\n".$value.'/'.get_tree($value.'/');
	}
	return $tree;
}
function glob_free($dir,$patern='*'){  //MARCHE LE MIEUX
	$tab = array();
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				$ext=explode('.',$file);
				$ext=$ext[count($ext)-1];
				if($ext==$patern || $patern=="*" && $file!='.' && $file!='..'){
					//echo $dir.'   '.$file.br;
					echo $file.br;
					$tab[]=$dir.$file;
				}
			}
			closedir($dh);
		}
	}
	return $tab;
}   


function dirurl($url,$inserePage=false){
	if(!$inserePage)
	echo '<textarea>';
	
	$homepage = file_get_contents($url);
	echo $homepage;
	if(!$inserePage)
	echo '</textarea>';
}
function cdate($timestamp){
	return date('d/m/Y H:i:s',$timestamp);
}
function myDate(){
	date_default_timezone_set("Europe/Paris");
	return date('d/m/Y H:i:s');
}
?>
