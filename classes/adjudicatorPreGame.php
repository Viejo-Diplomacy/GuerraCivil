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

class GuerraCivilVariant_adjudicatorPreGame extends adjudicatorPreGame {
	
	// Coloca las unidades iniciales:
	// Set the staring units:
	protected $countryUnits = array(
		'Republica'=> array('Madrid'=>'Army' ,'Toledo'=>'Army','Badajoz'=>'Army'),
		'Popular'=> array('Oviedo'=>'Army' ,'Santander'=>'Army','Bilbao'=>'Fleet'),
		'Milicias'=> array('Gerona'=>'Fleet' ,'Barcelona'=>'Army','Tarragona'     =>'Army'),
		'Brigadas'=> array('Albacete'=>'Army' ,'Murcia'=>'Fleet','Almeria'=>'Army'),
		'Nacional'=> array('Valladolid'=>'Army' ,'Salamanca'=>'Army','Fuerteventura'=>'Fleet'),
		'Sublevado'=> array('La Coruna'=>'Fleet' ,'Pontevedra'=>'Fleet','Orense'=>'Army'),
		'Africano'=> array('Cadiz'=>'Army' ,'Ceuta'=>'Fleet','Melilla'=>'Fleet'),
		'Falange'=> array('Huesca'=>'Army' ,'Zaragoza'=>'Army','Soria'=>'Army')
	);
	
}

?>