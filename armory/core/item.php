<?php
	$json = false;
	if(isset($_GET['json']) && $_GET['json'] == "true")
	{
		$json = true;
		header('Content-Type: application/json');		
	}
	else
	{
		echo '
			<html>
				<head>
					<style>
					* {
						background-color: black;
					}
					</style>
				</head>
			</html>
			';
	}
	include_once("./connection/conn.php");
	include_once("./func/stathandler.php");
	if(!isset($_GET['id']))
	{
		echo "No id...";
		die;
	}
	$id = htmlentities($_GET['id']);
	class Item
	{
		private static function MakeStat($id, $count)
		{
			$stat = StatHandler::getStat($id);
			return "<span style=\"color:white\">" . $count . $stat . "</span>";
		}
		private static function calculateItemPrice($cost)
		{
			$copper = $cost;
			$silver = 0;
			$gold = 0;
			while($copper - 100 >= 0)
			{
				$copper -= 100;
				$silver++;
			}
			while($silver - 100 >= 0)
			{
				$silver -= 100;
				$gold++;
			}
			return array("gold" => $gold, "silver" => $silver, "copper" => $copper);
		}
		function displayItem($entry, $class, $subclass, $unk0, $name, $displayid, $Quality, $Flags, $FlagsExtra, $BuyCount, $BuyPrice, $SellPrice, $InventoryType, $AllowableClass, $AllowableRace, $ItemLevel, $RequiredLevel, $RequiredSkill, $RequiedSkillRank, $requiredspell, $requiredhonorrank, $RequiredCityRank, $RequiredReputationFaction, $RequiredReputationRank, $maxcount, $stackable, $ContainerSlots, $stat_type1, $stat_value1, $stat_unk1_1, $stat_unk2_1, $stat_type2, $stat_value2, $stat_unk1_2, $stat_unk2_2, $stat_type3, $stat_value3, $stat_unk1_3, $stat_unk2_3, $stat_type4, $stat_value4, $stat_unk1_4, $stat_unk2_4, $stat_type5, $stat_value5, $stat_unk1_5, $stat_unk2_5, $stat_type6, $stat_value6, $stat_unk1_6, $stat_unk2_6, $stat_type7, $stat_value7, $stat_unk1_7, $stat_unk2_7, $stat_type8, $stat_value9, $stat_unk1_8, $stat_unk2_8, $stat_type9, $stat_value9, $stat_unk1_9, $stat_unk2_9, $stat_type10, $stat_value10, $stat_unk1_10, $stat_unk2_10, $ScalingStatDistribution, $ScalingStatValue, $DamageType, $delay, $RangedModRange, $spell_id1, $spelltrigger_1, $spellcharges_1, $spellppmRate_1, $spellcooldown_1m, $spellcategory_1, $spellcategorycooldown_1, $spellid_2, $spelltrigger_2, $spellcharges_2, $spellppmRate_2, $spellcooldown_2, $spellcategory_2, $spellcategorycooldown_2, $spellid_3, $spelltrigger_3, $spellcharges_3, $spellppmRate_3, $spellcooldown_3, $spellcategory_3, $spellcategorycooldown_3, $spellid_4, $spelltrigger_4, $spellcharges_4, $spellppmRate_4, $spellcooldown_4, $spellcategory_4, $spellcategorycooldown_4, $spellid_5, $spelltrigger_5, $spellcharges_5, $spellppmRate_5, $spellcooldown_5, $spellcategory_5, $spellcategorycooldown_5, $boding, $description, $PageText, $LanguageID, $PageMaterial, $startquest, $lockid, $Material, $sheath, $RandomProperty, $RandomSuffix, $block, $itemset, $MaxDurability, $area, $Map, $BagFamily, $TotemCategory, $socketColor_1, $socketContent_1, $socketColor_2, $socketContent_2, $socketColor_3, $socketContent_3, $socketBonus, $GemProperties, $RequiredDisenchantSkill, $ArmorDamageModifier, $Duration, $ItemLimitCategory, $HolidayId, $ScriptName, $DisenchantId, $FoodType, $minMoneyLoot, $maxMoneyLoot, $StatScalingFactor, $Field130, $Field131, $WDBVerified, $vipLevel)
		{
			if(isset($_GET['json']) || $_GET['json'] == true)
			{
				$array = array();
				$array['name'] = $name;
				if($ItemLevel > 0)
				{
					$array['item_level'] = $ItemLevel;
				}
				if($RequiredLevel > 0){
					$array('required_level'] = $RequiredLevel;
				}
				if($RequiredSkill > 0 || $RequiredSkill != ""){
					if($RequiedSkillRank > 0){
						$skills = array(
										171 => "Alchemy",
										164 => "Blacksmithing",
										333 => "Enchanting",
										202 => "Engineering",
										182 => "Herbalism",
										773 => "Inscription",
										755 => "Jewelcrafting",
										165 => "Letherworking",
										186 => "Mining",
										393 => "Skining",
										197 => "Tailoring",
										794 => "Archeology",
										185 => "Cooking",
										129 => "First Aid",
										356 => "Fishing"
										);
						echo "<span style=\"color:yellow\">Requires " . $skills[$RequiredSkill] . " (" . $RequiredSkillRank . ")</span><br>";
					}
				}
				if($RequiredReputationFaction > 0 || $$RequiredReputationFaction != ""){
					if($RequiredReputationRank > 0){
						/* Prety inappropiate, but since I was thinking of displaying expansion logo, I made this xD */
						$factions = array(
											1037 => array("faction" => "Alliance Vanguard", "expansion" => "WotLK"),
											1106 => array("faction" => "Argent Crusade", "expansion" => "WotLK"),
											529 => array("faction" => "Argent Dawn", "expansion" => "Vanilla"),
											1012 => array("faction" => "Ashtongue Deathsworn", "expansion" => "TBC"),
											1204 => array("faction" => "Avengers of Hyjal", "expansion" => "Cata"),
											1177 => array("faction" => "Baradin's Wardens", "expansion" => "Cata"),
											1133 => array("faction" => "Bilgewater Cartel", "expansion" => "Cata"),
											87 => array("faction" => "Bloodsail Buccaneers", "expansion" => "Vanilla"),
											21 => array("faction" => "Booty Bay", "expansion" => "Vanilla"),
											910 => array("faction" => "Brood of Nozdormu", "expansion" => "Vanilla"),
											609 => array("faction" => "Cenarion Circle", "expansion" => "Vanilla"),
											942 => array("faction" => "Cenarion Expedition", "expansion" => "TBC"),
											909 => array("faction" => "Darkmoon Faire", "expansion" => "Vanilla"),
											530=> array("faction" => "Darkspear Trolls", "expansion" => "Vanilla"),
											69 => array("faction" => "Darnassus", "expansion" => "Vanilla"),
											1172 => array("faction" => "Dragonmaw Clan", "expansion" => "Cata"),
											577 => array("faction" => "Everlook", "expansion" => "Vanilla"),
											930 => array("faction" => "Exodar", "expansion" => "TBC"),
											1068 => array("faction" => "Explorers' League", "expansion" => "WotLK"),
											1104 => array("faction" => "Frenzyheart Tribe", "expansion" => "WotLK"),
											729 => array("faction" => "Frostwolf Clan", "expansion" => "Vanilla"),
											369 => array("faction" => "Gadgetzan", "expansion" => "Vanilla"),
											92 => array("faction" => "Gelkis Clan Centaur", "expansion" => "Vanilla"),
											1134 => array("faction" => "Gilneas", "expansion" => "Cata"),
											54 => array("faction" => "Gnomeregan", "expansion" => "Vanilla"),
											1158 => array("faction" => "Guardians of Hyjal", "expansion" => "Cata"),
											1168 => array("faction" => "Guild", "expansion" => "Vanilla"),
											1178 => array("faction" => "Hellscream's Reach", "expansion" => "Cata"),
											946 => array("faction" => "Honor Hold", "expansion" => "TBC"),
											1052 => array("faction" => "Horde Expedition", "expansion" => "WotLK"),
											749 => array("faction" => "Hydraxian Waterlords", "expansion" => "Vanilla"),
											47 => array("faction" => "Ironforge", "expansion" => "Vanilla"),
											989 => array("faction" => "Keepers of Time", "expansion" => "TBC"),
											1090 => array("faction" => "Kirin Tor", "expansion" => "WotLK"),
											1098 => array("faction" => "Knights of the Ebon Blade", "expansion" => "WotLK"),
											978 => array("faction" => "Kurenai", "expansion" => "TBC"),
											1011 => array("faction" => "Lower City", "expansion" => "TBC"),
											93 => array("faction" => "Magram Clan Centaur", "expansion" => "Vanilla"),
											1015 => array("faction" => "Netherwing", "expansion" => "TBC"),
											1038 => array("faction" => "Ogri'la", "expansion" => "TBC"),
											76 => array("faction" => "Orgrimmar", "expansion" => "Vanilla"),
											1173 => array("faction" => "Ramkahen", "expansion" => "Cata"),
											470 => array("faction" => "Ratchet", "expansion" => "Vanilla"),
											349 => array("faction" => "Ravenholdt", "expansion" => "TBC"),
											1031 => array("faction" => "Sha'tari Skyguard", "expansion" => "TBC"),
											1077 => array("faction" => "Shattered Sun Offensive", "expansion" => "TBC"),
											809 => array("faction" => "Shen'dralar", "expansion" => "Vanilla"),
											911 => array("faction" => "Silvermoon City", "expansion" => "TBC"),
											890 => array("faction" => "Silverwing Sentinels", "expansion" => "Vanilla"),
											970 => array("faction" => "Sporeggar", "expansion" => "TBC"),
											730 => array("faction" => "Stormpike Guard", "expansion" => "Vanilla"),
											72 => array("faction" => "Stormwind", "expansion" => "Vanilla"),
											70 => array("faction" => "Syndicate", "expansion" => "Vanilla"),
											932 => array("faction" => "The Aldor", "expansion" => "TBC"),
											1156 => array("faction" => "The Ashen Verdict", "expansion" => "WotLK"),
											933 => array("faction" => "The Consortium", "expansion" => "TBC"),
											910 => array("faction" => "The Defilers", "expansion" => "Vanilla"),
											1135 => array("faction" => "The Earthen Ring", "expansion" => "Cata"),
											1126 => array("faction" => "The Frostborn", "expansion" => "WotLK"),
											1067 => array("faction" => "The Hand of Vengeance", "expansion" => "WotLK"),
											1073 => array("faction" => "The Kalu'ak", "expansion" => "WotLK"),
											509 => array("faction" => "The League of Arathor", "expansion" => "Vanilla"),
											941 => array("faction" => "The Mag'har", "expansion" => "TBC"),
											1105 => array("faction" => "The Oracles", "expansion" => "WotLK"),
											990 => array("faction" => "The Scale of the Sands", "expansion" => "TBC"),
											934 => array("faction" => "The Scryers", "expansion" => "TBC"),
											935 => array("faction" => "The Sha'tar", "expansion" => "TBC"),
											1094 => array("faction" => "The Silver Covenant", "expansion" => "WotLK"),
											1119 => array("faction" => "The Sons of Hodir", "expansion" => "WotLK"),
											1124 => array("faction" => "The Sunreavers", "expansion" => "WotLK"),
											1064 => array("faction" => "The Taunka", "expansion" => "WotLK"),
											967 => array("faction" => "The Violet Eye", "expansion" => "TBC"),
											1091 => array("faction" => "The Wyrmrest Accord", "expansion" => "WotLK"),
											1171 => array("faction" => "Therazane", "expansion" => "Cata"),
											59 => array("faction" => "Thorium Brotherhood", "expansion" => "Vanilla"),
											947 => array("faction" => "Thrallmar", "expansion" => "TBC"),
											81 => array("faction" => "Thunder Bluff", "expansion" => "Vanilla"),
											576 => array("faction" => "Timbermaw Hold", "expansion" => "Vanilla"),
											922 => array("faction" => "Tranquillien", "expansion" => "TBC"),
											68 => array("faction" => "Undercity", "expansion" => "Vanilla"),
											1050 => array("faction" => "Valiance Expedition", "expansion" => "WotLK"),
											1085 => array("faction" => "Warsong Offensive", "expansion" => "WotLK"),
											889 => array("faction" => "Warsong Outriders", "expansion" => "Vanilla"),
											1174 => array("faction" => "Wildhammer Clan", "expansion" => "Cata"),
											589 => array("faction" => "Wintersaber Trainers", "expansion" => "Vanilla"),
											270 => array("faction" => "Zandalar Tribe", "expansion" => "Vanilla")
											);
											
						$factionRank = "Honored"; //Filler
						
						echo "<span style=\"color:yellow\">Requires " . $factions[]["faction"] . " - " . $factionRank . "</span><br>";
											
					}
				}
				if($ContainerSlots > 0 || $ContainerSlots != "")
				{
					
				}
				if($stat_type1 != 0)
				{
					$array['stat_1'] = self::MakeStat($stat_type1, $stat_value1);
					
				}
				if($stat_type2 != 0)
				{
					$array['stat_2'] = self::MakeStat($stat_type2, $stat_value2);
					
				}
				if($stat_type3 != 0)
				{
					$array['stat_3'] = self::MakeStat($stat_type3, $stat_value3);
				}
				if($stat_type4 != 0)
				{
					$array['stat_4'] = self::MakeStat($stat_type4, $stat_value4);
				}
				if($stat_type5 != 0)
				{
					$array['stat_5'] = self::MakeStat($stat_type5, $stat_value5);
				}
				if(strlen($description) > 0)
				{
					$array['description'] = $description;
				}
				if($stackable > 0)
				{
					$array['stackable'] = $stackable;
				}
				if($SellPrice > 0)
				{
					$array['price'] = $SellPrice;
				}
				$array['displayid'] = $displayid;
				echo json_encode($array, JSON_PRETTY_PRINT);
				die;
			}
			$name = str_replace("|cff", "#", $name);
			/*
				echo "Name: ".$name."<br>";
				echo "Entry: ".$entry."<br>";
				echo "Display: ".$displayid."<br>";
			*/
			$b ="<br>";
			
			$cklr = array(0 => "#889D9D", 1 => "#FFF", 2 => "#1EFF0C", 3 => "#0070FF", 4 => "#A335EE", 5 => "#FF8000", 6 => "#E6CC80", 7 => "#E6CC80");
			echo "<span style='color:" . $cklr[$Quality] . "'>" . $name . "</span><br>";
			if($ItemLevel != 0)
			{
				echo "<span style=\"color:yellow\">Item Level " . $ItemLevel . "</span><br>";
			}
			$array_stats = array(
					1 => array("type" => $stat_type1, "value" => $stat_value1),
					2 => array("type" => $stat_type2, "value" => $stat_value2),
					3 => array("type" => $stat_type3, "value" => $stat_value3),
					4 => array("type" => $stat_type4, "value" => $stat_value4),
					5 => array("type" => $stat_type5, "value" => $stat_value5)
			);
			foreach($array_stats as $key => $value)
			{
				if($value["value"] > 0 && $value['type'] != 0)
				{
					echo self::MakeStat($value["type"], $value["value"]) . "<br>";
				}
			}
			/*
			if($stat_type1 != 0)
			{
				echo self::MakeStat($stat_type1, $stat_value1);
				echo '<br>';
			}
			if($stat_type2 != 0)
			{
				echo self::MakeStat($stat_type2, $stat_value2);
				echo '<br>';
			}
			if($stat_type3 != 0)
			{
				echo self::MakeStat($stat_type3, $stat_value3);
				echo '<br>';
			}
			if($stat_type4 != 0)
			{
				echo self::MakeStat($stat_type4, $stat_value4);
				echo '<br>';
			}
			if($stat_type5 != 0)
			{
				echo self::MakeStat($stat_type5, $stat_value5);
				echo '<br>';
			}
			*/
			if(strlen($description) > 0)
			{
				echo "<span style=\"color: yellow\">".$description."</span><br>";
			}
			if($stackable > 0)
			{
				echo "<span style=\"color:white\">Max Stack: " . $stackable" . </span><br>";
			}
			if($BuyPrice > 0)
			{
				$prices = self::calculateItemPrice($SellPrice);
				if($prices["gold"] > 0){
					$gold = $prices["gold"] . '<img src="./img/money-gold.gif" />';
				} else {
					$gold = null;
				}
				if($prices["silver"] > 0){
					$silver = $prices["silver"] . '<img src="./img/money-silver.gif" />';
				} else {
					$silver = null;
				}
				if($prices["copper"] > 0){
					$copper = $prices["copper"] . '<img src="./img/money-copper.gif" />';
				} else {
					$copper = null;
				}
			    echo "<span style=\"color:white\">Buy Price Price: " . $gold . $silver . $copper . "</span><br>";  
			}
			if($SellPrice > 0)
			{
				$prices = self::calculateItemPrice($SellPrice);
				if($prices["gold"] > 0){
					$gold = $prices["gold"] . '<img src="./img/money-gold.gif" />';
				} else {
					$gold = null;
				}
				if($prices["silver"] > 0){
					$silver = $prices["silver"] . '<img src="./img/money-silver.gif" />';
				} else {
					$silver = null;
				}
				if($prices["copper"] > 0){
					$copper = $prices["copper"] . '<img src="./img/money-copper.gif" />';
				} else {
					$copper = null;
				}
			    echo "<span style=\"color:white\">Sell Price: " . $gold . $silver . $copper . "</span><br>";  
			}
			echo $displayid . "<br>";
			/*
			 * NAME
			 * Item Level %u
			 * BINDING
			 * TYPE			TYPE_
			 * DAMAGE		SPEED
			 * (DPS)
			 * + %u %s
			 * + %u %s
			 * REQ_LEVEL
			 * Sell Price: 46G 61S 41C
			 */	
		}	
	}
	Database::GetItemRAW($id, new Item());
?>
