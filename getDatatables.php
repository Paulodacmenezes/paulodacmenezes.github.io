<?php

include("classes/dbhClass.php");
include("classes/colaboradorClass.php");


$colab = new Colaborador;
$colabs = $colab->getColabsLoja();

 

echo json_encode(array('data' => $colabs));