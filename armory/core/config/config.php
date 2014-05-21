<?php
	error_reporting(E_ALL);
	class configuration {
		static protected $settings = array();
		static function set($setting, $value) {
			self::$settings[$setting] = $value;
		}
		static function get($setting)
		{
			return self::$settings[$setting];
		}
	}
	class ext
	{
		public $set = array();
		static function init()
		{
			$set['type'] = 0; /* 0 = skyfire, 1 = trinitycore */ 
			$set['db_user'] = "root";
			$set['db_pass'] = "*****";
			$set['db_world'] = "world";
			$set['db_conn'] = "localhost";
			$set['db_port'] = 3306;
			$set['db_characters'] = "characters";
			
			//Do Not Edit
			foreach($set as $key => $value)
			{
				configuration::set($key, $value);
			}	
		}
	}
	class config
	{
		public static function get($string)
		{
			ext::init();
			return configuration::get($string);
		}
	}
?>