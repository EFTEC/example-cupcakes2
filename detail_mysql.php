<?php

include "app.php";

$id=$validaton->type('integer')->get('id');
$cupcake=CupcakeRepo::first($id);
echo $blade->run("cupcakes.detail",['cupcake'=>$cupcake,'postfix'=>'mysql']);