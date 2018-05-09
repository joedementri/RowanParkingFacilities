<?php

function lotIDtoLotName($passedID) {

	switch ($passedID) {
		case 1:
			return "Lot A";
			break;
		case 2:
			return "Lot B";
			break;
		case 3:
			return "Lot C";
			break;
		case 4:
			return "Lot D";
			break;
		case 5:
			return "Lot E";
			break;
		case 8:
			return "Lot A-1";
			break;
		case 9:
			return "Lot B-1";
			break;
		case 10:
			return "Lot C-1";
			break;
		case 11:
			return "Lot D-1";
			break;
		case 12:
			return "Lot E-1";
			break;
		default:
			return "N/A";
			break;

	}

}

?>