<?php 
declare(strict_types=1);
ini_set('display_errors', '1');
require_once('panels\panelFileTree.php');
//require_once("PannelManager.php");
ini_set('display_errors', '1');

class ProgramManager{
    public Folder $folder;
    public string $title;
    public Tree $tree;
    public function __construct(string $_folderName="./",string $_title=""){
        $this->folder=new Folder (null,$_folderName);
        $this->title=$_title;
        $this->tree=new Tree($this->folder);
    }
    public function html():string
    {
        return $this->tree->html();
    }
}
?>
<script>
    let selectedItem={element:null,type:null};//Folder;
    function selectElement(e,eType){
        console.log("select",e);
        
        if(selectedItem.element && selectedItem.element!=e){
            selectedItem.element.classList.toggle('selected');
        }
        e.classList.add('selected');
        selectedItem.element=e;
        selectedItem.type=eType;
    }
</script>