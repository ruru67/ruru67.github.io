<?php 
declare(strict_types=1);
require_once("PannelManager.php");
ini_set('display_errors', '1');
?>
<style type="text/css">

</style>
<?php
/* To use file loader:
      $fileLoader=new FileLoader();
      echo $fileLoader->html();
*/
class FileLoader  //TO DO GETTER AND SETTER
{
    public function __construct(string $_type="file",string $_extension="*")//TO DO change file to ?folder?
    {
        $this->fileName="";
        $this->action=null;
        $this->type=$_type;
        $this->extension=$_extension;
        $this->buttonTag='Charger...';
        $this->buttonId='btCharger';
        $this->buttonTitle='Parcourir';
        $this->fileLabelID=null;
    }
    public function addPostAction(string $_destFile){// POST html or php page exemple "minifyJS.php"
        $this->action=$_destFile;//enables to send file to another page via POST METHOD
    }
    public function setFileLabelID(string $_fileLabelID=""){
        $this->fileLabelID=$_fileLabelID;
    }
    public function setTag(string $_tag=""){
        $this->buttonTag=$_tag;
    }
    public function setTitle(string $_title=""){
        $this->buttonTitle=$_title;
    }
    public function setID(string $_id){ //TO DO change ID in script too !!!
        //if(_$id)
                $this->buttonId=$_id;
    }
    private function getLoadButton(string $_option='file',string $_extensionAccepted='*'):string  // To get the loader : 'file' or 'folder'
    {
        if($_option=='file')
                $option=' accept="'.$this->extension.'"';
        else
                $option='webkitdirectory directory multiple';
        if($this->fileLabelID){
            $loadCB=' onchange="load(\''.$this->fileLabelID.'\');"'; 
        }
        else
        $loadCB='';
        
        return ('<label class="lblBouton" style="font-size: small" for="'.$this->buttonId.'" title="'.$this->buttonTitle.'">'.$this->buttonTag.'</label>
        <input id="'.$this->buttonId.'" type="file" '.$option.$loadCB.' style="width:0px;">');
        //<input type="text" name="nomFichier" id="nomFichier">
    }

    private function getMethod():string  // MAY BE DEPRACATED
    {
        return ('<form  method="POST" action="'.$this->action.'" onsubmit="return true;" >
        '.$this->getButton().'
        <input type="text" name="nomFichier" id="nomFichier">
        <input type="submit" value="Minifier"/></p>
        </form>');
    }

    public function html():string
    {
        if(!$this->action)
            return $this->getLoadButton('folder');
        else
            return $this->getMethod();
    }
}
?>
<script>
      function submitForm(oFormElement)
      {
            var xhr = new XMLHttpRequest();
            xhr.onload = function(){ 
                  alert(xhr.responseText);
            }
            xhr.open(oFormElement.method, oFormElement.getAttribute("action"));
            xhr.send(new FormData(oFormElement));
            return false;
      }

      /////////////////////////////////////////
      ////// FILE LOADER
      /////////////////////////////////////////
	function load(fileLabelID)
      {
		//document.getElementById("btChargerJs").addEventListener('change',function() {
			var curFiles = document.getElementById('btCharger').files;
                  console.log(curFiles);
			if(curFiles.length === 0) 
				alert('No files currently selected for upload');
			else {
				
				console.log(curFiles[0]);
                        if(!document.getElementById(fileLabelID)){
                              console.log('Input Label ID <'+ fileLabelID+'> is set!');
                              
                        }
                        else
				      document.getElementById(fileLabelID).value=curFiles[0].name;
				var reader = new FileReader();
				reader.onload = function(file) {
					console.log(file.target.result);
                              
					//document.getElementById('txtMinified').value=file.target.result;
					
                              
                              //minify(curFiles[0]);
					/*var xhr=new XMLHttpRequest();
					//xhr.open("GET","src/BDD/xml_hiScore.php?type=submit&pseudo="+ch.nom+"&score="+ch.score.toString()+"&niveau="+niveau,true);
					xhr.open("GET","minifyJS.php?file="+curFiles[0],true);
					
					xhr.responseType="text";
					xhr.send();
					xhr.onload = function(e){
						if (xhr.status != 200){ 
							alert("Erreur " + xhr.status + " : " + xhr.statusText);
							//reject(false);
						}else{ 
							console.log (curFiles[0]);
							//alert(xhr.response.length + " octets  téléchargés\n" + JSON.stringify(xhr.response));
							//$("#hiscores").append( xhr.response);
							//resolve(true);
							console.log(e.target.response);
							//document.getElementById("txtMinified").value=e.target.response;
						}
					};*/
					
				}
				reader.readAsText(curFiles[0]);	
			}
		//});
	}
/*class FileLoader{
public float $x,$y,$z;
public function __construct(string $_username,string $_email, string $_status = self::STATUS_ACTIVE){
      $this->username=$_username;
      $this->status=$_status;
      $this->email=$_email;
}

public function setStatus(string $status): void
{
      if (!in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE])) {
            trigger_error(sprintf('Le status %s n\'est pas valide. Les status possibles sont : %s', $status, implode(', ', [self::STATUS_ACTIVE, self::STATUS_INACTIVE])), E_USER_ERROR);
      };

      $this->status = $status;
}
      protected function getStatus(): string
{
      return $this->status;
}
}*/
</script>

