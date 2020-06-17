<?php


use eftec\ValidationOne;
include 'app.php';


$button=$validaton->def("")->post("button");

function validation($cupcake) {
	// returns true or false
}


if ($button) {

	$cupcake['Name'] = $validaton
		->def("")// what if the value is not read?, we should show something (or null)
		->ifFailThenDefault(false)// if fails then we show the same value however it triggers an error
		->type("varchar")// it is required to ind
		->condition("req", "this value (%field) is required")
		->condition("minlen", "The minimum lenght is 3", 3)
		->condition("maxlen", "The maximum lenght is 100", 100)
		->post('name'); // frm_name.  It also generates a message container called "name".
	
	$cupcake['Image'] = $validaton
		->def("")
		->ifFailThenDefault(false)// if fails then we show the same value however it triggers an error
		->type("file")
		->condition("image", "The file is not a right image")
		->condition("ext", "The file is incorrect", ['jpg', 'png','gif'])
		->condition("req", "this value (%field) is required")
		->getFile('image', false); // it returns an array [filename,filetmp]


	$cupcake['Price'] = $validaton
		->def("")// what if the value is not read?, we should show something (or null)
		->ifFailThenDefault(false)// if fails then we show the same value however it triggers an error
		->type("integer")
		->condition("req", "this value (%field) is required")
		->condition("gt", "The price must be great than 0", 0)
		
		->condition("between", "The price must be between %first and %second", [0,1000])
		->post('price'); // frm_price

	$cupcake['Description'] = $validaton
		->def("")// what if the value is not read?, we should show something (or null)
		->ifFailThenDefault(false)// if fails then we show the same value however it triggers an error
		->type("varchar")
		->condition("req", "this value (%field) is required")
		->post('description'); // frm_description

	if (empty($validaton->getMessages())) {
		// 1) the button was pressed and there is not error.
		move_uploaded_file($cupcake['Image'][1],'img/'.$cupcake['Image'][0]);
		$cupcake['Image']=$cupcake['Image'][0]; // now Image is only the name, not an array
        CupcakeRepo::insert($cupcake);
		header("Location:catalog_mysql.php");
	}
	
	
} else {
	$cupcake=CupcakeRepo::factoryNull();
}

$validaton->getMessageId('id')->firstError();


echo $blade->run("cupcakes.form",['cupcake'=>$cupcake,'postfix'=>'document','validaton'=>$validaton]);