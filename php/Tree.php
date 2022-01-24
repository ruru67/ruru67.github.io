<?php
declare(strict_types=1);
ini_set('display_errors', '1');
//require_once("./php/PannelManager.php");
?>
<style type="text/css">
.tree{
    background-color: gainsboro;
    padding: 1px;
}
.dashedBorder{
    border-left: 1px black dashed;
    margin-left: 7px;
}
</style>
<?php
class Tree{
    public function __construct(Folder $_rootFolder,string $_id='panelFileTree',string $_titre='Explorer'){//'panelFileTree','Explorer'
        $this->id=$_id;
        $this->titre=$_titre;
        $this->panelFileTree=new Panel($this->id,$this->titre);
        $this->rootFolder=$_rootFolder;
        get_tree3($this->rootFolder);
        $this->currentFolder=$this->rootFolder;
        $this->fileLoader=new FileLoader();
        $this->fileLoader->setTag('...');
        $this->fileLoader->setTitle('Charger un répertoire local');
        $this->fileLoader->setFileLabelID('lblFolder');
    }
    private function htmlTree($folder){
        $txt='';
        $marge=($folder->level>0?3:0);//5*($folder->level)+1;  
        for($i=0;$i<$folder->nbFolders; $i++){
            $label = new Label(' > '.$folder->folders[$i]->name);
            $label->className='folder';
            $label->onClick='toggle(this);selectElement(this,\'folder\');';
            $label->style='margin-left:'.$marge.'px';

            $this->panelFileTree->addLabel($label);
            $this->panelFileTree->addHtml('<div  class="verticalFlex dashedBorder hidden">');
            $this->htmlTree($folder->folders[$i]);
            $this->panelFileTree->addHtml('</div>');
        }
        for($i=0;$i<$folder->nbFiles; $i++){
            $label = new Label($folder->files[$i]->name);
            $label->className='file';
            $label->onClick='selectElement(this,\'file\')';
            $label->style='margin-left:'.$marge.'px';
            $this->panelFileTree->addLabel($label);
           
        }
    }
    public function html():string{
        $this->panelFileTree->init();
        $this->panelFileTree->addInput($this->currentFolder->name,'lbl','lblFolder');
        $this->panelFileTree->addHtml($this->fileLoader->html());
        $this->panelFileTree->addHtml('<div class="tree verticalFlex">');
        $this->htmlTree($this->currentFolder);
        $this->panelFileTree->addHtml('</div>');
        return $this->panelFileTree->html();
    }
}

//$tree=array();
function get_tree3(Folder $folder){//$path = './'
    $path=$folder->getChemin();
    //echo '_____ EXPLORE '.$path.'  _____'.br;
    if (substr($path,-1) !== '/')
        $path .= '/';
    //echo 'Chemin:'.$path;
    $dirs = glob_free3($path,'*');
    //echo 'dir:'.$dirs;
    if(is_array($dirs))
        foreach ($dirs as $dirfile){

            $value=$dirfile->fullPath();
            if(is_dir($value)){
                //$folder->addFolder(new Folder($folder,$dirfile->file,$folder->level+1));
                $newFolder=new Folder($folder,$dirfile->file,$folder->level+1);
                $folder->addFolder($newFolder);
                
                //echo $dirfile->file.' is a folder from '.$dirfile->dir.br;
                get_tree3($newFolder);
                //get_tree3($value.'/');
            }
            else{
                $newFile=new File($folder,$dirfile->file,$folder->level+1);
                $folder->addFile($newFile);
                //echo $dirfile->file.' is a file from '.$dirfile->dir.br;
            }
        }
}
function glob_free3($dir,$patern='*'){  //MARCHE LE MIEUX
    $tab = array();
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                $ext=explode('.',$file);
                $ext=$ext[count($ext)-1];
                if($ext==$patern || $patern=="*" && $file!='.' && $file!='..'){
                    //echo $dir.'   '.$file.br;
                    //echo $file.br;
                    //$tab[]=$dir.$file;
                    $tab[]=new dirFile($dir,$file);
                }
            }
            closedir($dh);
        }
    }
    return $tab;
}
class dirFile{
    public function __construct(string $_dir,string $_file){
        $this->dir=$_dir;
        $this->file=$_file;
    }
    public function fullPath():string{
        return $this->dir.$this->file;
    }
}
?>