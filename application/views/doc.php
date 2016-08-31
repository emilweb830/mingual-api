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
		* Preprocess
			Checking Access Permission by Token in Request Header

		- get language list - done
			path: 	/api/languages/(:id)
			type: 	GET
			params: 
			return: 
			[
				{"id_lang":1,"name":"English","iso_code":"en","language_code":"en-us","active":1},
				{"id_lang":2,"name":"Russian","iso_code":"ru","language_code":"ru","active":1}
			]
			
		- get Country list - done
			path: /api/countries/(:id)
			type: 	GET
			return: 
			[	
				{"id_country":1,"country_code":"AF","country_name":"Afghanistan","flag":"http:\/\/mingual.com\/uploads\/flag\/af.png"},
				{"id_country":2,"country_code":"AL","country_name":"Albania","flag":"http:\/\/mingual.com\/uploads\/flag\/al.png"}
			]
			
		- Facebook Login - done
			path: 	/api/users/login
			type: 	GET
			params: access_token
			return: 
				{"status":true,"id_user":2,"token":"14b65d790fe71e162fbddf779751f05a"}
		
		- Logout - done
			Path: /api/users/logout
			Header: Token
			Type: 	GET
			Params: none			
			Return: {"status":true,"message":"Logout success."}

		- Get My Profile - done
			Path: 	/api/profile/me
			Header: Token
			Type: 	GET
			Params: none

		- Update My profile - done
			Path: 	/api/profile/me
			Header: Token
			Type: 	PUT
			Params: profileinfo ( example: {"latitude": "15.131543","longitude" : "15.2323"} )
					field list
					latitude 	: string
					longitude 	: string
					first_name 	: string
					last_name	: string
					gender		: char( m, f )
					age			: int
					id_country	: int
					hometown	: string
					teach_lang	: int
					learn_lang	: int
					about_me	: text
					experience	: text
					Photo 		: array
					
			return: 
				{"status":true,"message":"Update Success."}

		- Search - done
			Path: /api/users/search
			Header: Token
			Type: GET
			Params: offset : int
			Return: {
			  "status": true,
			  "count": 4,
			  "offset": 0,
			  "users": [
			    {
			      "id_user": 14,
			      "facebook_id": 101539461083312,
			      "latitude": 15.13,
			      "longitude": 15.23,
			      "first_name": "Test",
			      "last_name": "One",
			      "email": "",
			      "gender": "m",
			      "date_add": "2016-08-20 03:59:44",
			      "date_modified": "2016-08-20 03:59:44",
			      "age": 26,
			      "id_country": 142,
			      "hometown": "Mexico City",
			      "teach_lang": 2,
			      "learn_lang": 2,
			      "about_me": "",
			      "experience": "",
			      "token": "",
			      "active": 1,
			      "id": null,
			      "new_partner": 1,
			      "new_message": 1,
			      "vibration": 1,
			      "alert": 0,
			      "show_me": 1,
			      "id_teach_lang": 2,
			      "id_learn_lang": 2,
			      "sch_radius": 10,
			      "sch_city": "",
			      "sch_gender": "f",
			      "sch_age_low": 22,
			      "sch_age_high": 27,
			      "sch_type": "l",
			      "id_partner1": null,
			      "id_partner2": null,
			      "mingual_status1": null,
			      "mingual_status2": null,
			      "status": null
			    },
			    {
			      "id_user": 15,
			      "facebook_id": 101539461083313,
			      "latitude": 15.1313,
			      "longitude": 15.23,
			      ...			     
			    },
			    {
			      "id_user": 16,
			      "facebook_id": 101539461083333,
			      "latitude": 15.1313,
			      "longitude": 15.23,
			      ...
			    },
			    {
			      "id_user": 17,
			      "facebook_id": 101539461084444,
			      "latitude": 15.1313,
			      "longitude": 15.23,
			      ...
			    }
			  ]
			}

		- Get User Setting - done
			Path: /api/profile/setting
			Header: Token
			Type: GET
			Params: none
			Return: {	"id":3,"id_user":13,"new_partner":0,"new_message":1,"vibration":1,"alert":0,"show_me":1,
						"id_teach_lang":1,"id_learn_lang":2,"sch_radius":14,"sch_city":"New York","sch_gender":"m",
						"sch_age_low":24,"sch_age_high":27,"sch_type":"l"}

		- Update User Setting - done
			Path: /api/profile/setting
			Header: Token
			Type: PUT
			Params: new_partner, 
					new_messsage, 
					vibration, 
					alert, 
					show_me, 
					id_teach_lang,
					id_learn_lang,
					sch_radius,
					sch_city,
					sch_gender,
					sch_age_low,
					sch_age_high,
					sch_type
					
			Return: status

		- Delete Account - done
			Path: /api/profile/me
			Header: Token
			Type: Delete
			Params: none
			Return: status

		- Contact US - done
			Path: /api/contactus
			Header: Token
			Type: POST
			Params: comment
			Return: status

		- Mingual - done
			Path: /api/minguals/connect
			Header: Token
			Type: PUT
			Params: partner_id
			return: {"status":true,"message":"Congurats"}

		- Get User partner list -done
			Path: /api/minguals/partners
			Header: Token
			Type: GET
			Params: page_num
			Return: {
			  "status": true,
			  "count": 4,
			  "offset": 0,
			  "users": [
			    {
			      "id_user": 16,
			      "facebook_id": 101539461083333,
			      "latitude": 15.1313,
			      "longitude": 15.23,
			      "first_name": "Test",
			      "last_name": "Three",
			      "email": "",
			      "gender": "f",
			      "date_add": "2016-08-20 03:59:44",
			      "date_modified": "2016-08-20 03:59:44",
			      "age": 26,
			      "hometown": "Mexico City",
			      "teach_lang": {
			        "id_lang": 2,
			        "name": "Russian",
			        "iso_code": "ru",
			        "language_code": "ru",
			        "active": 1
			      },
			      "learn_lang": {
			        "id_lang": 2,
			        "name": "Russian",
			        "iso_code": "ru",
			        "language_code": "ru",
			        "active": 1
			      },
			      "about_me": "",
			      "experience": "",
			      "token": "",
			      "active": 1,
			      "country": {
			        "id_country": 142,
			        "country_code": "MX",
			        "country_name": "Mexico"
			      },
			      "photos": null
			    },
			    {
			      "id_user": 15,
			      "facebook_id": 101539461083313,
			      "latitude": 15.1313,
			      "longitude": 15.23,
			      ...			     
			    },
			    {
			      "id_user": 16,
			      "facebook_id": 101539461083333,
			      "latitude": 15.1313,
			      "longitude": 15.23,
			      ...
			    },
			    {
			      "id_user": 17,
			      "facebook_id": 101539461084444,
			      "latitude": 15.1313,
			      "longitude": 15.23,
			      ...
			    }
			  ]
			}

		- Unmatch - done
			Path: /api/minguals/unmatch
			Header: Token
			Type: PUT
			Params: partner_id
			Return: {"status":true,"message":"Congurats"}

		- Report - done
			Path: /api/users/report
			Header: Token
			Type: PUT
			Params: report_type, comment, date_add
		
		- Get Users - done
			Path: /api/users/(:id)
			Header: Token
			Type: GET
			Params: none
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