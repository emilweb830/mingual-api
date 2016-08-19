<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mingual API</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>API Documentation v-1.0</h1>

	<div id="body">

	<pre>
		* request header
			Content-Type: application/json
			Token : $token
			
		- get language list
			path: 	/api/languages/(:id)
			type: 	GET
			params: 
			return: 
			[
				{"id_lang":1,"name":"English","iso_code":"en","language_code":"en-us","active":1},
				{"id_lang":2,"name":"Russian","iso_code":"ru","language_code":"ru","active":1}
			]
			
		- get Country list
			path: /api/countries/(:id)
			type: 	GET
			return: 
			[	
				{"id_country":1,"country_code":"AF","country_name":"Afghanistan","flag":"http:\/\/mingual.com\/uploads\/flag\/af.png"},
				{"id_country":2,"country_code":"AL","country_name":"Albania","flag":"http:\/\/mingual.com\/uploads\/flag\/al.png"}
			]
			
		- Facebook Login
			path: 	/api/users/login
			type: 	GET
			params: access_token
			return: 
				{"status":true,"id_user":2,"token":"14b65d790fe71e162fbddf779751f05a"}
		
		- Logout 
			path: /api/users/logout
			type: GET
			params: token
			return: {"status":true,"message":"Logout success."}
			
		- Update User profile
			path: 	/api/users/(:id)
			type: 	PUT
			params: profileinfo ( example: {"latitude": "15.131543","longitude" : "15.2323"} )
					field list
					latitude 	: string
					longitude 	: string
					first_name 	: string
					last_name	: string
					gender		: char( m, w )
					age			: int
					id_country	: int
					hometown	: string
					teach_lang	: int
					learn_lang	: int
					about_me	: text
					experience	: text
					
			return: 
				{"status":true,"message":"Update Success."}
		- Get User Profile
			path: 	/api/users/(:id)
			type: 	GET
			params: empty
			{"id_user":2,"facebook_id":10153946108396312,"latitude":15.131543,"longitude":15.2323,"first_name":"Michael","last_name":"Hochberg","gender":"m","age":10,"id_country":142,"hometown":"Mexico City","teach_lang":0,"learn_lang":0,"about_me":"","experience":"","active":1}
	</pre>
	<!--p>	To See All Pokemons : <a href='<?php echo base_url()?>manage/displayPokemons'> Click Here </a></p>
	<p>	To See All Pokemon Types : <a href='<?php echo base_url()?>manage/displayPokemonTypes'> Click Here </a></p>
	<p>	Add New Pokemon: <a href='<?php echo base_url()?>manage/add_pokemon'> Click Here </a></p>
	<p>	Updae New Pokemon:  <a href='<?php echo base_url()?>/manage/add_pokemon?id={id}'> Click Here </a></p>
	<p> Last Updated : 2016.07.27</p-->
	</div>

	<p class="footer"> all rights reserved 2016</p>
</div>

</body>
</html>