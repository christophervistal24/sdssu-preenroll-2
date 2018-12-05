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
	function semesterWord($text) :string
	{
		if ($text == 1) {
			return 'First Semester';
		}
		return 'Second Semester';
	}

	function digitToWord(string $number)
	{
		return ($number == 1) ? strtoupper('1st') : strtoupper('2nd');
	}

	function findCharacterPosWithDelimeter(string $text , $delimeter)
	{
		$position = strpos($text , $delimeter);
		if ($position !== false) {
			return str_limit($text,$position);
		} else {
			return $text;
		}
	}


	function filterSubjectId($array = [])
	{
		$count_values     = count(session('old_dragged_subjects')) - 1;
		//get the previous dragged subject
		$prev_dragged_sub = session('old_dragged_subjects')[$count_values-1];
		//get the new dragged subject
		$new_dragged_sub  = session('old_dragged_subjects')[$count_values];
		//compare previous and new
		$collect_id       = array_diff($new_dragged_sub, $prev_dragged_sub);
        return $collect_id;
	}

	function hyphenate(string $str) : string {
		return substr($str , 0 , 2) . ' - ' . substr($str,2);
	}

	function convertKeySemesterToWord(string $semester)
	{
		$semesters = ['First semester' , 'Second semester'];
		$get_sem_portion = substr($semester,7);
		preg_match_all('/^\d/',$get_sem_portion, $digit);
		return $semesters[$digit[0][0] - 1];
	}



