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

class CustomPoints_panelMembers extends panelMembers
{
	// Cuenta las unidades que cada jugador posee.
	// Count the units each player owns.
	public function unitCount($forMemberStatus=false)
	{
		$count=0;

		if($forMemberStatus)
			$Members = $this->ByStatus[$forMemberStatus];
		else
			$Members = $this->ByID;

		foreach($Members as $Member)
		$count += $Member->unitNo;

		return $count;
	}	
}

class RinascimentoVariant_panelMembers extends CustomPoints_panelMembers {}
