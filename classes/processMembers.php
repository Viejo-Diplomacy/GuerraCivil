<?php
/*
	Copyright (C) 2013 Diplomacy en Espa&ntilde;ol (www.webdiplomacy.com.es)

	This file is part of the Rinascimento variant for webDiplomacy

	The GuerraCivil variant for webDiplomacy" is free software:
	you can redistribute it and/or modify it under the terms of the GNU Affero
	General Public License as published by the Free Software Foundation, either 
	version 3 of the License, or (at your option) any later version.

	The GuerraCivil variant for webDiplomacy is distributed in the hope
	that it will be useful, but WITHOUT ANY WARRANTY; without even the implied 
	warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	See the GNU General Public License for more details.

	You should have received a copy of the GNU Affero General Public License
	along with webDiplomacy.  If not, see <http://www.gnu.org/licenses/>.

*/

defined('IN_CODE') or die('This script can not be run by itself.');

class NeutralMember
{
	public $supplyCenterNo;
	public $unitNo;
}

// bevore the processing add a minimal-member-object for the "neutral  player"
class NeutralUnits_processMembers extends processMembers
{
	function countUnitsSCs()
	{
		$this->ByCountryID[count($this->Game->Variant->countries)+1] = new NeutralMember();
		parent::countUnitsSCs();
		unset($this->ByCountryID[count($this->Game->Variant->countries)+1]);
	}
}

// El ganador neccesita ocupar MADRID
// Winner need to occupie MADRID
class CustomWinCondition_processMembers extends NeutralUnits_processMembers
{
	function checkForWinner()
	{
		global $DB, $Game;

		$win=parent::checkForWinner();
		if ($win == false) return false;
		
		list($rom_stat)=$DB->sql_row("SELECT countryID FROM wD_TerrStatus WHERE terrID=46 AND GameID=".$Game->id);
		if ($rom_stat == $win->countryID)
			return $win;
		else
			return false;
	}
}
	

class GuerraCivilVariant_processMembers extends processMembers {}
