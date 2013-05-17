<?php
/*
	Copyright (C) 2013 Diplomacy en Espa&ntilde;ol (www.webdiplo.com)

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

	---
	
	Changelog:
	0.5.1:   Primera configuraci&oacute;n/First setup
	0.5.2: 	Primera instalación y prueba. Cambios en mapas y detalles menores graficos/First install and test.
	
*/

defined('IN_CODE') or die('This script can not be run by itself.');

class GuerraCivilVariant extends WDVariant {
	public $id         =136;
	public $mapID      =136;
	public $name       ='GuerraCivil';
	public $fullName   ='Guerra Civil Espa&ntilde;ola [Playtesting]';
	public $description='Una variante ambientada en la Guerra Civil Espa&ntilde;ola, para ocho jugadores divididos en dos bandos.';
	public $author     ='Diplomacy en Espa&ntilde;ol';
	public $adapter    ='(Ader, JuankyDelaPaz, MAK, Neichof, Ovinomanc3r, Viejo)';
	public $version    ='0.5.2';
	public $homepage   = 'http://www.webdiplo.com/foro/Thread-Proyecto-variante-Guerra-Civil';
	public $disabled   =true;		

	public $countries=array(
		'Republica','Popular','Milicias','Brigadas','Nacional','Sublevado','Africano', 'Falange');

	public function __construct() {
		parent::__construct();

		// Coloca las unidades iniciales
		// Set starting Units
		$this->variantClasses['adjudicatorPreGame'] = 'GuerraCivil';
		
		// Colorea los territorios, dibuja los centros neutrales
		// Color the territories, Draw the "neutral" SC's
		$this->variantClasses['drawMap']            = 'GuerraCivil';

		// Javascript corrections (Build everywhere)
		$this->variantClasses['OrderInterface']     = 'GuerraCivil';
		
		// Construye en cualquier centro
		// Build everywhere
		$this->variantClasses['OrderInterface']     = 'GuerraCivil';
		$this->variantClasses['processOrderBuilds'] = 'GuerraCivil';
		$this->variantClasses['userOrderBuilds']    = 'GuerraCivil';
		
		// Condiciones para la victoria (el ganador necesita MADRID)
		// Custom Win Condition (Winner needs MADRID)
		$this->variantClasses['processMembers']     = 'GuerraCivil';
		
		//Nombres en Chatbox
		//Names in Chatbox
		$this->variantClasses['Chatbox']            = 'GuerraCivil';
		
	}
	
	
	public function initialize() {
		parent::initialize();
		$this->supplyCenterTarget = 19;
	}
	
	public function turnAsDate($turn) {
		if ( $turn==-1 ) return "Pre-game";
		else return ( $turn % 2 ? "Autumn, " : "Spring, " ).(floor($turn/2) + 1936);
	}

	public function turnAsDateJS() {
		return 'function(turn) {
			if( turn==-1 ) return "Pre-game";
			else return ( turn%2 ? "Autumn, " : "Spring, " )+(Math.floor(turn/2) + 1936);
		};';
	}

}


?>
