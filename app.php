<?php

use eftec\bladeone\BladeOne;
use eftec\PdoOne;
use eftec\ValidationOne;

include "vendor/autoload.php";
include "CupcakeDataBase.php";
include "AbstractCupcakeRepo.php";
include "CupcakeRepo.php";


// we created the new connection to the database :-)
// database located at 127.0.0.1, user root and password: abc.123, schema = cupcakes
$pdoOne=new PdoOne('mysql',"127.0.0.1","root","abc.123","cupcakes");
$pdoOne->logLevel=3;
$pdoOne->open();

$blade=new BladeOne(); // it will create the folders compiles/ . The folder views/ must be created
					   // if they are not create then you should create it manually

$validaton=new ValidationOne("frm_");



