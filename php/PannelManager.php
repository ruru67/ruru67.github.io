<?php
declare(strict_types=1);
ini_set('display_errors', '1');
require_once('./php/PHPElements.php');
?>
<style type="text/css">
.panel{
    display:block;
    position:absolute;
    margin:0px;
    padding:2px;
    background-color: yellowgreen;
    border:1px darkslategray solid;
    border-radius: 2px;
    font-family: georgia;
    color:#1e1e1f;
}
.panelTopBar{
    font-size: medium;
}
.divPanelTitre{
    display: flex;
    font-size: medium;
}
.panelTitre{
    font-weight:bold;
    font-size: large;
}
.btonPlier{
    border: 1px black solid;
    width: 15px;
    display: block;
    text-align: center;
    border-radius: 3px;
    margin-right: 2px;
}
.divPanelContent{
    margin-top: 1px;
}
</style>
<?php
class Panel{
    //public float $fileName,$actionCallBack,$z;
    //public string $name,$title;
    public function __construct(string $_id,string $_title){//string $_username,string $_email, string $_status = self::STATUS_ACTIVE){
        $this->id=$_id;
        $this->title=$_title;
        $this->htmlString='';
    }
    public function init():void
    {
        $this->htmlString='';
        //return $this->htmlString;
    }
    public function addHtml(string $_html):void
    {
        $this->htmlString.=$_html;
    }
    public function addInput(string $_html,string $_classe='',string $_id):void
    {
        $input = new Input('text');
        $input->id=$_id;
        $input->value=$_html;
        $input->class=$_classe;
        $this->htmlString.=$input->html();
        //$this->htmlString.='<input id="'.$_id.'" class='.$classe.' type="text" value="'.$_html.'"/>';
    }
    public function addLabel(Label $label):void
    {
        $this->htmlString.=$label->html();
    }

    public function html():string
    {
        return '<section id='.$this->id.' class="panel">
                    <div class="divPanelTitre">
                    <label class="btonPlier panelTopBar" onclick="togglePanel(this)"> v </label><label class="panelTitre panelTopBar">'.$this->title.'</label>
                    </div>
                <div id="panelContent" class="divPanelContent">'.$this->htmlString.'</div>
                </section>';
    }
}
?>
<script>
    function togglePanel(e){
        let content=document.getElementById('panelContent');
        if(content.classList.contains('hidden'))
            content.className+='hidden';
        else
            content.classList.toggle('hidden');
        actuBtonDeplier(e);
    }
    function actuBtonDeplier(e){
        if(e.textContent.substr(0,2)==" v"){
            e.textContent=" > "+e.textContent.substr(2);
            return false;
        }
        else{
            e.textContent=" v "+e.textContent.substr(2);
            return true;
        }
    }
    
    function toggle(e){
        let show=actuBtonDeplier(e);
        if(show ) 
            deplier(e.nextElementSibling); 
        else 
            plier(e.nextElementSibling);
    }
    
    function deplier(e){
        if(e.classList.contains('hidden'))
            e.classList.toggle('hidden');
    }
    function plier(e){
        e.className+=" hidden";
    }
    
    
</script>

