<?php
	class StatHandler
	{
		private static $stats = array(3 => "Agility", 4 => "Strenght", 5 => "Intellect", 6 => "Spirit", 7 => "Stamina", 12 => "Defesne Rating", 13 => "Dodge Rating", 14 => "Parry Rating", 15 => "Block Rating");
		static function getStat($id)
		{
			if($id === 0 || $id == 0)
			 {
			 	return null;	
			 }
			$stat = self::$stats[$id];
			if($stat == NULL)
			{
				return self::$stats[3];
			}
			return self::$stats[$id];
		}	
	}

?>