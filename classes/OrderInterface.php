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

//Amplia los centros permitidos para inclurir centros nooriginarios.
// Expand the allowed SupplyCenters array to include non-home SCs.
class BuildAnywhere_OrderInterface extends OrderInterface
{
	/**
    * Call the parent constructor transparently to keep things working
    */
   public function __construct($gameID, $variantID, $userID, $memberID, $turn, $phase, $countryID,
      setMemberOrderStatus $orderStatus, $tokenExpireTime, $maxOrderID=false)
   {
      parent::__construct($gameID, $variantID, $userID, $memberID, $turn, $phase, $countryID,
         $orderStatus, $tokenExpireTime, $maxOrderID);
   }

   
	protected function jsLoadBoard() {
		parent::jsLoadBoard();

		if( $this->phase=='Builds' ) {
			libHTML::$footerIncludes[] = '../variants/GuerraCivil/resources/supplycenterscorrect.js';
			foreach(libHTML::$footerScript as $index=>$script)
				if(strpos($script, 'loadBoard();') )
					libHTML::$footerScript[$index]=str_replace('loadBoard();','loadBoard();SupplyCentersCorrect();', $script);
		}
	}
}		

// Unit-Icons in javascript-code		
//class CustomIcons_OrderInterface extends NoMove_OrderInterface
//{
//	protected function jsLoadBoard() {
//		parent::jsLoadBoard();
//
//		libHTML::$footerIncludes[] = '../variants/GuerraCivil/resources/iconscorrect.js';
//		foreach(libHTML::$footerScript as $index=>$script)
//			if(strpos($script, 'loadOrdersModel();'))
//				libHTML::$footerScript[$index]=str_replace('loadOrdersModel();','loadOrdersModel();IconsCorrect();', $script);
//	}
//}

class GuerraCivilVariant_OrderInterface extends OrderInterface {}
