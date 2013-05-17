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

class MoveFlags_drawMap extends drawMap
{
	public function countryFlag($terrID, $countryID)
	{
		
		$flagBlackback = $this->color(array(0, 0, 0));
		$flagColor = $this->color($this->countryColors[$countryID]);

		list($x, $y) = $this->territoryPositions[$terrID];

		$coordinates = array(
			'top-left' => array( 
						 'x'=>$x-intval($this->fleet['width']/2+1),
						 'y'=>$y-intval($this->fleet['height']/2+1)
						 ),
			'bottom-right' => array(
						 'x'=>$x+intval($this->fleet['width']/2+1),
						 'y'=>$y+intval($this->fleet['height']/2-1)
						 )
		);

		imagefilledrectangle($this->map['image'],
			$coordinates['top-left']['x'], $coordinates['top-left']['y'],
			$coordinates['bottom-right']['x'], $coordinates['bottom-right']['y'],
			$flagBlackback);
		imagefilledrectangle($this->map['image'],
			$coordinates['top-left']['x']+1, $coordinates['top-left']['y']+1,
			$coordinates['bottom-right']['x']-1, $coordinates['bottom-right']['y']-1,
			$flagColor);
	}
}


class NeutralScBox_drawMap extends MoveFlags_drawMap
{
	/**
	* Marca las posiciones de los "centros neutrales" que tienen que ir
	* coloreados para indicar el bando de influencia si no esta ocupado.
	*
	* An array containing the XY-positions of the "neutral-SC-box" and 
	* the country-color it should be colored if it's still unoccupied.
	**/
	
	/** Formato: terrID => array (countryID, smallmapx, smallmapy, mapx, mapy)
	**/
	protected $nsc_info=array(
		   3 => array( 5,   53, 403,  140, 1018), // Tenerife
		  16 => array( 5,  518, 224,  1303, 572), // Mallorca
		  19 => array( 5,  195,  78,  499, 201),  // Lugo
		  22 => array( 5,  254,  97,  638, 237),  // Leon
		  25 => array( 5,  232, 229,  595, 572),  // Caceres
		  27 => array( 1,  216, 319,  543, 807),  // Huelva
		  32 => array( 5,  315, 105,  794, 264),  // Burgos
		  33 => array( 1,  349,  90,  880, 236),  // Vitoria
		  35 => array( 5,  383,  89,  964, 232),  // Pamplona
		  45 => array( 5,  283, 178,  723, 456),  // Avila
		  47 => array( 1,  336, 178,  842, 451),  // Guadalajara
		  51 => array( 1,  361, 203,  915, 519),  // Cuenca
		  52 => array( 1,  412, 239,  1049, 610), // Valencia
		  56 => array( 1,  283, 296,  713, 751),  // Cordoba
		  57 => array( 1,  315, 300,  784, 761),  // Jaen
		  61 => array( 1,  280, 346,  728, 844)   // Malaga	
	);
	
	/**
	* Situa el icono de centro neutral.
	* An array containing the neutral support-center icon image resource, and its width and height.
	* $image['image'],['width'],['height']
	* @var array
	**/
	protected $sc=array();
	
	/**
	* An array containing the information if one of the first 16 territories 
	* still has a neutral support-center (So we might not need to draw a flag)
	**/
	protected $nsc=array();

	protected function loadImages()
	{
		parent::loadImages();
		$this->sc = $this->loadImage('variants/GuerraCivil/resources/sc_'.($this->smallmap ? 'small' : 'large').'.png');	
	}

	/**
	* There are some territories on the map that belong to a country but have a supply-center
	* that is considered "neutral".
	* They are set to owner "Neutral" in the installation-file, so we need to check if they are
	* still "neutal" and paint the territory in the color of the country they "should" belong to.
	* After that draw the "Neutral-SC-overloay" on the map.
	**/
	public function ColorTerritory($terrID, $countryID)
	{
		parent::ColorTerritory($terrID, $countryID);

		if ((isset($this->nsc_info[$terrID][0])) && $countryID==0)
		{
			parent::ColorTerritory($terrID, $this->nsc_info[$terrID][0]);
			$this->nsc[$terrID]=$countryID;
			$sx=($this->smallmap ? $this->nsc_info[$terrID][1] : $this->nsc_info[$terrID][3]);
			$sy=($this->smallmap ? $this->nsc_info[$terrID][2] : $this->nsc_info[$terrID][4]);
			$this->putImage($this->sc, $sx, $sy);
		}
	}
		
	/* No need to draw the country flags for "neural-SC-territories if they get occupied by 
	** the country they should belong to
	*/
	public function countryFlag($terrID, $countryID)
	{
		if (isset($this->nsc[$terrID]) && ($this->nsc[$terrID] == $countryID)) return;
		parent::countryFlag($terrID, $countryID);
	}

}

class GuerraCivilVariant_drawMap extends NeutralScBox_drawMap {

	protected $countryColors = array(
		 0 =>  array(255, 217, 141), // Neutral
		 1 =>  array(222,  30,  17), // Republica
		 2 =>  array(160,  23,  39), // Popular
		 3 =>  array(216,  78,  94), // Milicias
		 4 =>  array(164,  12,  77), // Brigadas
		 5 =>  array(  0, 102, 204), // Nacional
		 6 =>  array(  1, 170, 232), // Sublevado
		 7 =>  array(  0, 195, 188), // Africano
		 8 =>  array( 60, 101, 154)  // Falange
	);
	
	protected function resources() {
		if( $this->smallmap )
		{
			return array(
				'map'     =>'variants/GuerraCivil/resources/smallmap.png',
				'army'    =>'variants/GuerraCivil/resources/smallarmy.png',
				'fleet'   =>'variants/GuerraCivil/resources/smallfleet.png',
				'names'   =>'variants/GuerraCivil/resources/smallmapNames.png',
				'standoff'=>'images/icons/cross.png'
			);
		}
		else
		{
			return array(
				'map'     =>'variants/GuerraCivil/resources/map.png',
				'army'    =>'variants/GuerraCivil/resources/army.png',
				'fleet'   =>'variants/GuerraCivil/resources/fleet.png',
				'names'   =>'variants/GuerraCivil/resources/mapNames.png',
				'standoff'=>'images/icons/cross.png'
			);
		}
	}
	
	// Draw the flags behind the units for a better readability
	public function countryFlag($terrName, $countryID)
	{
		$flagBlackback = $this->color(array(0, 0, 0));

		$flagColor = $this->color($this->countryColors[$countryID]);

		list($x, $y) = $this->territoryPositions[$terrName];

		$coordinates = array(
			'top-left' => array( 
							'x'=>$x-intval($this->fleet['width']/2+2)+1,
							'y'=>$y-intval($this->fleet['height']/2+2)+1
							),
			'bottom-right' => array(
							'x'=>$x+intval($this->fleet['width']/2+2)-1,
							'y'=>$y+intval($this->fleet['height']/2+2)-1
							)
			);

		imagefilledrectangle($this->map['image'],
			$coordinates['top-left']['x'], $coordinates['top-left']['y'],
			$coordinates['bottom-right']['x'], $coordinates['bottom-right']['y'],
			$flagBlackback);
		imagefilledrectangle($this->map['image'],
			$coordinates['top-left']['x']+1, $coordinates['top-left']['y']+1,
			$coordinates['bottom-right']['x']-1, $coordinates['bottom-right']['y']-1,
			$flagColor);
	}
	
	// No need to set transparency. Icans have transparent background
	//protected function setTransparancies() {}	
}

