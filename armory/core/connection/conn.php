<?php
	error_reporting(E_ALL);
	include_once("./config/config.php");
	class Database
	{
		static function getStatName($id)
		{
			$type = new StatType;
			
		}	
		static protected $is_init = false;
		static protected $info = array();
		static private function init()
		{
			if(Database::$is_init)
			{
				return;
			}
			$is_init = true;
			self::$info['db_user'] = config::get("db_user");
			self::$info['db_pass'] = config::get("db_pass");
			self::$info['db_world'] = config::get("db_world");
			self::$info['db_conn'] = config::get("db_conn");
			self::$info['db_port'] = config::get("db_port");
			self::$info['db_characters'] = config::get("db_characters");
		}
		static function Connection($base)
		{
			self::init();
			$db = new mysqli(self::$info['db_conn'], self::$info['db_user'], self::$info['db_pass'], self::$info[$base]);
			if($db->connect_errno > 0)
			{
				echo "Unable to connect to dabatase [" .  $db->connect_error ."]"; 
				die("Unable to connect to database [" .  $db->connect_error ."]");
			}
			return $db;
		}
		static function GetItem()
		{
			//
		}
		static function GetCharacter($name, $character)
		{
			$db = Database::Connection("db_characters");
			$statement = $db->prepare("SELECT * FROM `characters` WHERE `name` = ?");
			$statement->bind_param("s", $name);
			if(!$statement->execute())
			{
				die("Failed :/");
			}
			$statement->bind_result($guid, $account, $name, $race, $class, $gender, $level, $xp, $money, $playerBytes, $playerBytes2, $playerFlags, $position_x, $position_y, $postion_z, $map, $instance_id, $instance_mode_mask, $orientation, $taximask, $online, $cinematic, $totaltime, $leveltime, $logout_time, $is_logout_resting, $rest_bonus, $resettalents_cost, $resettalents_time, $trans_x, $trans_y, $trans_z, $trans_o, $transguid, $extra_flags, $at_login, $zone, $death_expire_time, $taxi_path, $conquestPoints, $totalHonorPoints, $totalKills, $todayKills, $yesterdayKills, $chosenTitle, $watchedFactin, $drunk, $health, $power1, $power2, $power3, $power4, $power5, $power6, $power7, $power8, $power9, $power10, $latency, $speccount, $activespec, $exploredZones, $equipmentCache, $knownTitles, $actionBars, $currentPetSlot, $petSlotUsed, $grandtableLevels, $talentFree, $deleteInfos_Account, $deleteInfos_Name, $deleteDate);
			while($statement->fetch())
			{
				$character->displayInfo($guid, $account, $name, $race, $class, $gender, $level, $xp, $money, $playerBytes, $playerBytes2, $playerFlags, $position_x, $position_y, $postion_z, $map, $instance_id, $instance_mode_mask, $orientation, $taximask, $online, $cinematic, $totaltime, $leveltime, $logout_time, $is_logout_resting, $rest_bonus, $resettalents_cost, $resettalents_time, $trans_x, $trans_y, $trans_z, $trans_o, $transguid, $extra_flags, $at_login, $zone, $death_expire_time, $taxi_path, $conquestPoints, $totalHonorPoints, $totalKills, $todayKills, $yesterdayKills, $chosenTitle, $watchedFactin, $drunk, $health, $power1, $power2, $power3, $power4, $power5, $power6, $power7, $power8, $power9, $power10, $latency, $speccount, $activespec, $exploredZones, $equipmentCache, $knownTitles, $actionBars, $currentPetSlot, $petSlotUsed, $grandtableLevels, $talentFree, $deleteInfos_Account, $deleteInfos_Name, $deleteDate);
			}
		}
		static function GetCharacterName($id)
		{
			$db = Database::Connection("db_characters");
			$statement = $db->prepare("SELECT `name` FROM `characters` WHERE `guid` = ?");
			$statement->bind_param("i", $id);
			if(!$statement->execute())
			{
				die("Failed :/");
			}
			$statement->bind_result($name);
			while($statement->fetch())
			{
				return $name;
			}
		}
		static function GetItemRAW($id, $item)
		{
			$db = Database::Connection("db_world");
			$statement = $db->prepare("SELECT * FROM `item_template` WHERE `entry` = ?");
			$statement->bind_param("i", $id);
			if(!$statement->execute())
			{
				die("Failed :/");
			}
			$statement->bind_result($entry, $class, $subclass, $unk0, $name, $displayid, $Quality, $Flags, $FlagsExtra, $BuyCount, $BuyPrice, $SellPrice, $InventoryType, $AllowableClass, $AllowableRace, $ItemLevel, $RequiredLevel, $RequiredSkill, $RequiedSkillRank, $requiredspell, $requiredhonorrank, $RequiredCityRank, $RequiredReputationFaction, $RequiredReputationRank, $maxcount, $stackable, $ContainerSlots, $stat_type1, $stat_value1, $stat_unk1_1, $stat_unk2_1, $stat_type2, $stat_value2, $stat_unk1_2, $stat_unk2_2, $stat_type3, $stat_value3, $stat_unk1_3, $stat_unk2_3, $stat_type4, $stat_value4, $stat_unk1_4, $stat_unk2_4, $stat_type5, $stat_value5, $stat_unk1_5, $stat_unk2_5, $stat_type6, $stat_value6, $stat_unk1_6, $stat_unk2_6, $stat_type7, $stat_value7, $stat_unk1_7, $stat_unk2_7, $stat_type8, $stat_value9, $stat_unk1_8, $stat_unk2_8, $stat_type9, $stat_value9, $stat_unk1_9, $stat_unk2_9, $stat_type10, $stat_value10, $stat_unk1_10, $stat_unk2_10, $ScalingStatDistribution, $ScalingStatValue, $DamageType, $delay, $RangedModRange, $spell_id1, $spelltrigger_1, $spellcharges_1, $spellppmRate_1, $spellcooldown_1m, $spellcategory_1, $spellcategorycooldown_1, $spellid_2, $spelltrigger_2, $spellcharges_2, $spellppmRate_2, $spellcooldown_2, $spellcategory_2, $spellcategorycooldown_2, $spellid_3, $spelltrigger_3, $spellcharges_3, $spellppmRate_3, $spellcooldown_3, $spellcategory_3, $spellcategorycooldown_3, $spellid_4, $spelltrigger_4, $spellcharges_4, $spellppmRate_4, $spellcooldown_4, $spellcategory_4, $spellcategorycooldown_4, $spellid_5, $spelltrigger_5, $spellcharges_5, $spellppmRate_5, $spellcooldown_5, $spellcategory_5, $spellcategorycooldown_5, $boding, $description, $PageText, $LanguageID, $PageMaterial, $startquest, $lockid, $Material, $sheath, $RandomProperty, $RandomSuffix, $block, $itemset, $MaxDurability, $area, $Map, $BagFamily, $TotemCategory, $socketColor_1, $socketContent_1, $socketColor_2, $socketContent_2, $socketColor_3, $socketContent_3, $socketBonus, $GemProperties, $RequiredDisenchantSkill, $ArmorDamageModifier, $Duration, $ItemLimitCategory, $HolidayId, $ScriptName, $DisenchantId, $FoodType, $minMoneyLoot, $maxMoneyLoot, $StatScalingFactor, $Field130, $Field131, $WDBVerified, $vipLevel);
			while($statement->fetch())
			{
				$item->displayItem($entry, $class, $subclass, $unk0, $name, $displayid, $Quality, $Flags, $FlagsExtra, $BuyCount, $BuyPrice, $SellPrice, $InventoryType, $AllowableClass, $AllowableRace, $ItemLevel, $RequiredLevel, $RequiredSkill, $RequiedSkillRank, $requiredspell, $requiredhonorrank, $RequiredCityRank, $RequiredReputationFaction, $RequiredReputationRank, $maxcount, $stackable, $ContainerSlots, $stat_type1, $stat_value1, $stat_unk1_1, $stat_unk2_1, $stat_type2, $stat_value2, $stat_unk1_2, $stat_unk2_2, $stat_type3, $stat_value3, $stat_unk1_3, $stat_unk2_3, $stat_type4, $stat_value4, $stat_unk1_4, $stat_unk2_4, $stat_type5, $stat_value5, $stat_unk1_5, $stat_unk2_5, $stat_type6, $stat_value6, $stat_unk1_6, $stat_unk2_6, $stat_type7, $stat_value7, $stat_unk1_7, $stat_unk2_7, $stat_type8, $stat_value9, $stat_unk1_8, $stat_unk2_8, $stat_type9, $stat_value9, $stat_unk1_9, $stat_unk2_9, $stat_type10, $stat_value10, $stat_unk1_10, $stat_unk2_10, $ScalingStatDistribution, $ScalingStatValue, $DamageType, $delay, $RangedModRange, $spell_id1, $spelltrigger_1, $spellcharges_1, $spellppmRate_1, $spellcooldown_1m, $spellcategory_1, $spellcategorycooldown_1, $spellid_2, $spelltrigger_2, $spellcharges_2, $spellppmRate_2, $spellcooldown_2, $spellcategory_2, $spellcategorycooldown_2, $spellid_3, $spelltrigger_3, $spellcharges_3, $spellppmRate_3, $spellcooldown_3, $spellcategory_3, $spellcategorycooldown_3, $spellid_4, $spelltrigger_4, $spellcharges_4, $spellppmRate_4, $spellcooldown_4, $spellcategory_4, $spellcategorycooldown_4, $spellid_5, $spelltrigger_5, $spellcharges_5, $spellppmRate_5, $spellcooldown_5, $spellcategory_5, $spellcategorycooldown_5, $boding, $description, $PageText, $LanguageID, $PageMaterial, $startquest, $lockid, $Material, $sheath, $RandomProperty, $RandomSuffix, $block, $itemset, $MaxDurability, $area, $Map, $BagFamily, $TotemCategory, $socketColor_1, $socketContent_1, $socketColor_2, $socketContent_2, $socketColor_3, $socketContent_3, $socketBonus, $GemProperties, $RequiredDisenchantSkill, $ArmorDamageModifier, $Duration, $ItemLimitCategory, $HolidayId, $ScriptName, $DisenchantId, $FoodType, $minMoneyLoot, $maxMoneyLoot, $StatScalingFactor, $Field130, $Field131, $WDBVerified, $vipLevel);
			}
		}
	}
	//Database::GetItemRAW(66585);
?>