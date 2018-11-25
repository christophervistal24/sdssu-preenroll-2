<?php
namespace App\Traits;

trait SchedUtils
{
	public function explodeGivenSubject(string $delimeter,string $subject) :array
	{
		return $this->fill_data(explode($delimeter, $subject));
	}

	public function fill_data(array $subject) : array
	{
		$string_key = ['start_time','end_time','days','room'];
		$sched_credentials = [];
		foreach ($string_key as $key => $value) {
			$sched_credentials[$value] = str_replace('-','',$subject[$key]);
		}
        return array_map('trim',$sched_credentials);
	}
}
?>
