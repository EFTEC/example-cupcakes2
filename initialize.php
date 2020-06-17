<?php

include 'app.php';

echo "<h1>Creating tables</h1>";
echo "<h2>Remember to edit app.php and set the correct user and password</h2>";

echo "<ul>";

$sql='CREATE SCHEMA `cupcakes`';

try {
    $pdoOne->runRawQuery($sql);
    echo "<li>OK: create schema</li>";
} catch (Exception $e) {
    echo "<li style='background-color: red'>Unable to create schema!</li>";
}


$sql=<<<TAG
CREATE TABLE `cupcakes` (
  `IdCupcake` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NULL,
  `Image` VARCHAR(45) NULL,
  `Price` DECIMAL(10,2) NULL,
  `Description` VARCHAR(2000) NULL,
  PRIMARY KEY (`IdCupcake`))
TAG;


$rows=<<<TAG
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Chocolate', 'cupcake1.jpg', '20', 'Chocolate');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Cupcake Normal', 'cupcake2.jpg', '30', 'Cupcake Normal');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Gourmet', 'cupcake3.jpg', '35.5', 'Gourmet');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Apple Pie', 'cupcake4.jpg', '43.3', 'Apple Pie');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Sprinkles', 'cupcake5.jpg', '24.3', 'Sprinkles');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Butter', 'cupcake6.jpg', '32.2', 'Butter');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Lemon', 'cupcake7.jpg', '22.3', 'Lemon');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Brownies', 'cupcake8.jpg', '32.2', 'Brownies');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Bubbly', 'cupcake9.jpg', '33.2', 'Bubbly');
TAG;

try {
    $pdoOne->runRawQuery($sql);
    echo "<li>OK: create table</li>";
} catch (Exception $e) {

    echo "<li style='background-color: red'>Unable to create table!</li>";
}

try {
    $pdoOne->runMultipleRawQuery($rows);
    echo "<li>OK: insert data!</li>";
} catch (Exception $e) {
    echo "<li style='background-color: red'>Unable to insert data!</li>";
}

try {
    $relations=['cupcakes'=>'Cupcake'];
    $code=$pdoOne->generateBaseClass('CupcakeDataBase','',$relations);
    file_put_contents('CupcakeDataBase.php',$code);
    echo "<li>OK: CupcakeDataBase.php created</li>";
} catch (Exception $e) {
    echo "<li style='background-color: red'>Unable to create CupcakeDataBase.php!</li>";
}

try {
    $relations=['cupcakes'=>'CupcakeRepo'];
    $code=$pdoOne->generateCodeClass('cupcakes','',null,$relations,[],null,null,'CupcakeDataBase');
    file_put_contents('CupcakeRepoExt.php',$code);
    echo "<li>OK: CupcakeRepoExt.php created</li>";
    if(!file_exists('CupcakeRepo.php')) {
        $code=$pdoOne->generateCodeClassRepo('cupcakes','',$relations,[]);
        file_put_contents('CupcakeRepo.php',$code);
        echo "<li>OK: CupcakeRepo.php created</li>";
    } else {
        echo "<li style='background-color: yellow'>Skipped the creation of CupcakeRepo.php</li>";
    }
} catch (Exception $e) {
    echo "<li style='background-color: red'>Unable to create CupcakeRepoExt.php!</li>";
}



echo "</ul>";