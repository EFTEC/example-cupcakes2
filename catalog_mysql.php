<?php
include "app.php";

$cupcakes=(CupcakeRepo::order('name'))::toList();

echo $blade->run("cupcakes.catalog"
	,['cupcakes'=>$cupcakes,'postfix'=>'mysql']);