<?php
declare(strict_types=1);
ini_set('display_errors', '1');

class Element{
    public $nodeName;
    public $name=null;
    public $class=null;
    public $onClick=null;
    
    public $type=null;
    public $id=null;
    public $value=null;
    public $textContent='';
    public $style=null;
    public function __construct(string $_name=null){
        $this->name=$_name;
        return $this;
    }
    public function html(){
        $html= '<'.$this->nodeName
                .($this->id?' id="'.$this->id.'"':'')
                .($this->name?' name="'.$this->name.'"':'')
                .($this->type?' type="'.$this->type.'"':'')
                .($this->class?' class="'.$this->class.'"':'')
                .($this->onClick?' '.' onclick="'.$this->onClick.'"':'')
                .($this->value?' value="'.$this->value.'"':'')
                .($this->style?' style="'.$this->style.'"':'');
        switch ($this->nodeName){
            case 'label':
                $html.='>'.$this->textContent
                        .'</'.$this->nodeName.'>';
                break;
            case 'input':
                $html.='/>';
                break;
        }
        return $html;                
    }
}
class Label extends Element{
    public function __construct(string $_textContent,string $_name=""){
        $this->name=$_name;
        $this->textContent= $_textContent;
        $this->nodeName="label";
        return $this;
    } 
}
class Input extends Element{
    public function __construct(string $_type,string $_name=""){
        $this->nodeName="input";
        $this->type=$_type;
        $this->name=$_name;
        return $this;
    } 
}

?>