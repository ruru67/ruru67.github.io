<?php
declare(strict_types=1);
ini_set('display_errors', '1');
require_once('./php/PHPElements.php');
require_once('./php/Tree.php');
require_once('./php/PannelManager.php');
require_once('./php/FileLoader.php');
?>
<style type="text/css">
.folder{
	background-color: gainsboro;
	
}
.folder:hover{
	background-color: lightblue;
}
.selected{
    background-color: aliceblue;
    border:1px solid gray;
}
.file{
    font-size : 0.9em;
	background-color: gainsboro;
	padding-left: 2px;
}
.file:hover{
	background-color: lightblue;
}
</style>
<?php

class File extends Element{ 
    public function __construct(Folder $_parentFolder=null,string $_name="",$_level=0){
        $this->level=$_level;
        $this->name=$_name;
        $this->parentFolder=$_parentFolder;
        return $this;
    }
}
class Folder extends Element{
    public function __construct(Folder $_parentFolder=null,string $_name="./",$_level=0){
        $this->level=$_level;
        $this->parentFolder=$_parentFolder;
        $this->name=$_name;
        $this->folders=array();
        $this->nbFolders=0;
        $this->files=array();
        $this->nbFiles=0;
        $this->selected=false;
        
        return $this;
    }
    public function getChemin():string{
        if($this->parentFolder){
            if(substr($this->parentFolder->name,-1)!=='/')
                return $this->parentFolder->getChemin().'/'.$this->name;
            else
                return $this->parentFolder->getChemin().$this->name;
        }
        else
            return $this->name;
    }
    
    public function addFolder(Folder $_folder):Folder{
        //echo 'Add Folder '.$_folder->name.'...';
        $this->folders[$this->nbFolders]=$_folder;
        $this->nbFolders++;
        return $this->folders[$this->nbFolders-1];
    }
    public function addFile(File $_file):File{
        //echo 'Add File '.$_file->name.'...';
        $this->files[$this->nbFiles]=$_file;
        $this->nbFiles++;
        return $this->files[$this->nbFiles-1];
    }
}

?>
