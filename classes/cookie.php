<?php
	
	class Cookie{

		public static function exists($name){
			return (isset($_COOKIE[$name])) ? true : false;
		}

		public static function get($name){
			return $_COOKIE[$name];
		}

		public static function put($name, $value, $time){
			setcookie($name, $value, $time);
		}
		

	}