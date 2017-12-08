<?php



// These code snippets use an open-source library. http://unirest.io/php
// The code below requests data from the Recipe - Food - Nutrition api @ https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByNutrients
require_once 'src/Unirest.php';
$response = \Unirest\Request::verifyPeer(false);
//TODO: need to make this dynamic
$maxCalories = $_POST['maxCalories'];
$maxCarbs = 100;
$maxFat = 100;			
$maxProtein = 100;
$numResults = 10; //up to a max of 10
$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByNutrients?maxCalories=$maxCalories&maxCarbs=$maxCarbs&maxFat=$maxFat&maxProtein=$maxProtein&minCalories=0&minCarbs=0&minFat=-5&minProtein=0&number=$numResults&offset=0",
array(
"X-Mashape-Key" => "3Vwbmw6WzYmshlcSD24PEGzMqW08p1lP7vHjsn5MM6RRk6Cyhp",
"X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.mashape.com"
  )
);

//Displays Results from API Query
	$json = $response->body;	//get parsed body of response in array format (array of objects)
	//Displays Results
	for($i = 0;$i < count($json);$i++){
		printf('<br>ID: %s <br>',$json[$i]->id);
		printf('Title: %s <br>',$json[$i]->title);
		$image = $json[$i]->image;
		$imageData = base64_encode(file_get_contents($image));
		echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
		printf('<br>Image: %s <br>',$json[$i]->image);
		printf('Calories: %s <br>',$json[$i]->calories);
		printf('Protein: %s <br>',$json[$i]->protein);
		printf('Fat: %s <br>',$json[$i]->fat);
		printf('Carbs: %s <br>',$json[$i]->carbs);
	}
?>