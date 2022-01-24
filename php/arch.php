
<script>
//($timestamp){
//return date('d/m/Y H:i:s',$timestamp);
function creeTextarea()
{
    return '<textarea id="txtMinified" name="txtMinified" spellcheck="false"></textarea>';
}
function creePanel($visible=true){
	$defaultrgrot=[0.0,-round(M_PI,2),round(M_PI,2),"any"];
	$defaultrgrot2=[0.0,0.0,round(M_PI*2,2),"any"];
	return creeGroup("autoRotate",["autorotx"=>[$defaultrgrot,["rotator.setrot",0]],
								"autoroty"=>[$defaultrgrot,["rotator.setrot",1]],
								"autorotz"=>[$defaultrgrot,["rotator.setrot",2]],
								"actualrotx"=>[$defaultrgrot2,[]],
								"actualroty"=>[$defaultrgrot2,[]],
								"actualrotz"=>[$defaultrgrot2,[]]],$visible,"rotator.setOnOff");
}
function creeLabel($namelbl,$defaultval=0){
	echo'<table>
			<tr>
			 <td>
				<label for="'.$namelbl.'"><b>'.$namelbl. '</b></label>
			 </td>
			 <td>
				<label id="'.$namelbl.'">'.$defaultval. '</label>
			 </td>
			</tr>
		</table>';
}

function creeGroup($groupName="paramView",$sliders,$checked=true,$nomProc=null){
	$check=$checked?"checked":"";
	$display=$checked?"block":"hidden";
	$grp= '<section class="group" id="gr'.$groupName. '"><strong>'.$groupName. ':</strong>
		on/off<input type="checkbox" id="cb'.$groupName. '" '.$check.' data-id="'.$groupName. '" oninput="ckChange(`tbl'.$groupName.'`,this.checked);">
		<table id="tbl'.$groupName. '"  '.$display.'>';?>
			<?php
			foreach( $sliders as $key => $value ){
				
				$grp.='<tr>
				<td><label for="rg'. $key.'">'.$key. '('.$value[0][1].' - '.$value[0][2].')</label></td>
				<td><input oninput="tbChangeSl(`rg'.$key.'`,this.value);" id="tb'.$key.'" value="'.$value[0][0].'" class="tb"  style="width:40px;"/></td>
				<td><input oninput="sliderChangeTb(`tb'.$key.'`,this.value);" type="range" id="rg'.$key.'" value="'.$value[0][0].'" min="'.$value[0][1].'" max="'.$value[0][2].'"  step="'.$value[0][3].'" class="slider"  /></td>
				</tr>';
				if(isset($value[1][0]))
					$grp.= '<script>
							document.getElementById("rg'.$key. '").addEventListener("input", function(e){console.log(e);'.$value[1][0].'('.$value[1][1] .',e.srcElement.value);}); 
							document.getElementById("tb'.$key. '").addEventListener("input", function(e){console.log(e);'.$value[1][0].'('.$value[1][1] .',e.srcElement.value);}); 
							</script>';
			}
		$grp.='</table></section>';
		if($nomProc)
			$grp.='<script>document.getElementById("cb'.$groupName. '").addEventListener("input", function(e){'.$nomProc.'(e.srcElement.checked);}
); </script>';
	return $grp;
}
?>
<script>
function sliderChangeTb(tb,val=""){
	document.getElementById(tb).value=val;
}
function tbChangeSl(sl,val=""){
	fval=parseFloat(val);
	if(fval>=document.getElementById(sl).min&&fval<=document.getElementById(sl).max)
		document.getElementById(sl).value=val;
}
function ckChange(tbl,val){
	var displayed=val?"block":"none";
	document.getElementById(tbl).style="display:"+displayed;
}
</script>