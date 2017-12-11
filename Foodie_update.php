

<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Foodie!!</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
  <!----Google Sign in----->
  <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
  <meta name="google-signin-client_id" content="907553346354-juk0nteslv0njocphvgsr19757q7dt0f.apps.googleusercontent.com">
  <body>
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

		function renderButton() {
			gapi.signin2.render('my-signin2', {
			'scope': 'profile email',
			'width': 240,
			'height': 50,
			'longtitle': true,
			'theme': 'dark',
			'onsuccess': onSuccess,
			'onfailure': onFailure
		})};
	};
    </script>
  </body>
 <!--------------------> 
</html>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<span class="logo"><img src="images/logo.png" alt="" width="150" height="150" /></span>
						<h1>Foodie!!</h1>
						<p>
						Template built by <a href="https://twitter.com/ajlkn">@ajlkn</a> for <a href="https://html5up.net">HTML5 UP</a>.</p>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="#intro" class="active">Introduction</a></li>
							<li><a href="#first">Generate Recipe</a></li>
							<li><a href="#second">Results</a></li>
							<li><a href="#cta">About</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Introduction -->
							<section id="intro" class="main">
								<div class="spotlight">
									<div class="content">
										<header class="major">
											<h2>What is Foodie?</h2>
										</header>
										<h3>Foodie is a web service which allows users to get suggested recipes based on a metric (Calories, Protein, Fats, or Carbs). 
										These recipes fit the specified metrics and include a recipe ingreedients list in case the user would want to make it. All this
										information can then be exported to a Google Sheets associated with the users Google account.
										</h3>
										<ul class="actions">
											
										</ul>
									</div>
									<span class="image"><img src="images/logo.png" alt="" /></span>
								</div>
							</section>

						<!-- First Section -->
							<section id="first" class="main special">
								<header class="major">
									<h2>Generate Recipes</h2>
								</header>
								<ul class="features">
								<script>
									function getfield(){
										var i = document.getElementById("user_input");
										var obj = document.getElementById("type");
										document.getElementById("result_val").innerHTML = 
										i.value + " " + obj.options[obj.selectedIndex].text;
									}
								</script>
								</ul>
								<footer class="major">
									<ul class="actions">
										<script>
										function ajax_post(){
											// Create our XMLHttpRequest object
											var hr = new XMLHttpRequest();
											// Create some variables we need to send to our PHP file
											var url = "request_update.php";
											var maxCal = 2000;
											var maxPro = 100;
											var maxFat = 100;
											var maxCar = 250;
											var minCal = 0;
											var minPro = 0;
											var minFat = 0;
											var minCar = 0;
											if(document.getElementById("type").value == "Calories"){
												maxCal = document.getElementById("nutValue").value;
												minCal = maxCal - 10;
											}
											if(document.getElementById("type").value == "Protein"){
												maxPro = document.getElementById("nutValue").value;
												minPro = maxPro - 10;
											}
											if(document.getElementById("type").value == "Fat"){
												maxFat = document.getElementById("nutValue").value;
												minFat = maxFat - 10;
											}
											if(document.getElementById("type").value == "Carbs"){
												maxCar = document.getElementById("nutValue").value;
												minCar = maxCar - 10;
											}
											
											//var ln = document.getElementById("last_name").value;
											var vars = "maxCalories="+maxCal+"&maxProtein="+maxPro+"&maxFat="+maxFat+"&maxCarbs="+maxCar+"&minCalories="+minCal+"&minProtein="+minPro+"&minFat="+minFat+"&minCarbs="+minCar;
											hr.open("POST", url, true);
											// Set content type header information for sending url encoded variables in the request
											hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
											// Access the onreadystatechange event for the XMLHttpRequest object
											hr.onreadystatechange = function() {
												if(hr.readyState == 4 && hr.status == 200) {
													var return_data = hr.responseText;
													document.getElementById("results56").innerHTML = return_data;
												}
											}
											// Send the data to PHP now... and wait for response to update the status div
											hr.send(vars); // Actually execute the request
											document.getElementById("results56").innerHTML = "processing...";
										}
										</script>
										<label for="text_info">I want to recipes with</label> 
										<input id='nutValue' type="text" name = "uInp" value="250"/>
										<select name="uOpt" id="type">
											<option value="Calories">Calories</option>
											<option value="Protein">Protein</option>
											<option value="Fat">Fat</option>
											<option value="Carbs">Carbs</option>
										</select>
										<input name="generate" type="submit" value="Generate" onclick="ajax_post();">
										</br>
									</ul>
								</footer>
								
							</section>

						<!-- Second Section -->
							<section id="second" class="main special">
								<header class="major">
									<h2>Results</h2>
									<body>
										<br />
										<p id="result_val"></p>
										<div id="results56"></div>
									</body>
									<ul class="actions">
										</br>
										<li><a href="https://www.google.com/sheets/about/" class="button special">Export to Google Sheets</a></li>
									</ul>
								</header>
								<p class="content">
								</p>
								<footer class="major">
									<ul class="actions">
									</ul>
								</footer>
							</section>

						<!-- Get Started -->
							<section id="cta" class="main special">
								<header class="major">
									<h2>About</h2>
									<h3>This website was created as a submittion for a class project (CSCE 315). The project requirements
									were to create a web-based application whose primary mode of interaction is through a web browser. 
									 An additional requirement was to include at least 3 existing web services(APIs). The whole implementation 
									is to be based primarily on HTML. The team members invloved in this project are detailed below under Contact Info.
									</h3>
								</header>
								<footer class="major">
									<ul class="actions">
										<li><a href="https://github.tamu.edu/wasiq123/Foodie" class="button special">Our GitHub</a></li>
									</ul>
								</footer>
							</section>

					</div>

				<!-- Footer -->
					<footer id="footer">
						<section>
							<h4>Througout the design and implementation of this website, we conducted user-studies. These studies were done on classmates and were done to help get feedback on our website. This helped us by giving us ideas on what to improve/add.</h4>
							<p></p>
							<ul class="actions">
								<li><a href="https://docs.google.com/spreadsheets/d/e/2PACX-1vR0v-_YRoRBSInhXvGxApiFVEqaPJIko5ajxKZXjIg9C1KelU9nmifgkeGoA6akKolyJXFZaDoKCOa7/pubhtml" class="button">Study Results</a></li>
							</ul>
						</section>
						<section>
							<h2>Contact Info</h2>
							<dl class="alt">
								<dt>Memebers:</dt>
								<dd>Christian Tovar</dd>
								<dd>Anthony Truncale</dd>
								<dd>Wasiq Siddiqui</dd>
								<dt>Email: </dt>
								<dd><a href = "#">CtovarV2@gmail.com</dd>
								<!-- Fill in other members -->
								
							</dl>
							<!--
							<ul class="icons">
								<li><a href="#" class="icon fa-twitter alt"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon fa-facebook alt"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon fa-instagram alt"><span class="label">Instagram</span></a></li>
								<li><a href="#" class="icon fa-github alt"><span class="label">GitHub</span></a></li>
								<li><a href="#" class="icon fa-dribbble alt"><span class="label">Dribbble</span></a></li>
							</ul>-->
						</section>
						<p class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>