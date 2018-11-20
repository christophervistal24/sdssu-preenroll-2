<?php
	function digitToYearLevel(string $year_level)
	{
		switch (strtolower($year_level)) {

				case 2:
						return ucwords('2nd year');
					break;

				case 3:
						return ucwords('3rd year');
					break;

				case 4:
						return ucwords('4th year');
					break;

				case  5:
						return ucwords('5th year');
					break;

				default : return ucwords('1st Year');
			}
	}

