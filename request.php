<?php
// These code snippets use an open-source library. http://unirest.io/php
// The code below requests data from the Recipe - Food - Nutrition api @ https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByNutrients
require_once 'src/Unirest.php';	//including header

$response = \Unirest\Request::verifyPeer(false);
//TODO: need to make this dynamic
$maxCalories = $_POST['maxCalories'];
$maxCarbs = $_POST['maxCarbs'];
$maxFat = $_POST['maxFat'];			
$maxProtein = $_POST['maxProtein'];
$minCalories = $_POST['minCalories'];
$minCarbs = $_POST['minCarbs'];
$minFat = $_POST['minFat'];
$minProtein = $_POST['minProtein'];
$numResults = 1; //up to a max of 10
//API request for Recipe
$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByNutrients?maxCalories=$maxCalories&maxCarbs=$maxCarbs&maxFat=$maxFat&maxProtein=$maxProtein&minCalories=$minCalories&minCarbs=$minCarbs&minFat=$minFat&minProtein=$minProtein&number=$numResults&offset=0",
array(
"X-Mashape-Key" => "3Vwbmw6WzYmshlcSD24PEGzMqW08p1lP7vHjsn5MM6RRk6Cyhp",
"X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.mashape.com"
  )
);

//Displays Results from API Query
	$json = $response->body;	//get parsed body of response in array format (array of objects)
	//Displays Results
	if($json == null){	//handle for no results
		printf("No Results Found!");
	}
	for($i = 0;$i < count($json);$i++){
		//printf('<br>ID: %s <br>',$json[$i]->id);
		printf('Title: %s <br>',$json[$i]->title);
		$image = $json[$i]->image;
		$imageData = base64_encode(file_get_contents($image));
		echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
		//printf('<br>Image: %s <br>',$json[$i]->image);
		printf('<br> Calories: %s <br>',$json[$i]->calories);
		printf('Protein: %s <br>',$json[$i]->protein);
		printf('Fat: %s <br>',$json[$i]->fat);
		printf('Carbs: %s <br> <h2>Ingredients:</h2>',$json[$i]->carbs);
		
		$recID = $json[$i]->id;	//current recipe ID
		// These code snippets use an open-source library. http://unirest.io/php
		//API request for recipe ingredients
		$responseI = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/$recID/information?includeNutrition=false",
		  array(
			"X-Mashape-Key" => "3Vwbmw6WzYmshlcSD24PEGzMqW08p1lP7vHjsn5MM6RRk6Cyhp",
			"Accept" => "application/json"
		  )
		);
		$jsonI = $responseI->body;
		for($j = 0;$j < count($jsonI->extendedIngredients);$j++){
			printf('%s <br>',$jsonI->extendedIngredients[$j]->originalString);
		}
	}
?>