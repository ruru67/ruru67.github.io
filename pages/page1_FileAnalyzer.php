<?php
declare(strict_types=1);
ini_set('display_errors', '1');
require_once("php/ProgramManager.php");
?>
<header><h3>PROGRAM MANAGER - FILE ANALYZER</h3></header>
<?php

$programManager=new ProgramManager();
echo $programManager->html();
?>