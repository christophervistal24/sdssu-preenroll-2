<?php
namespace App\Helpers;
use Laracsv\Export;

class CSVUtilities
{
    public $records;
    public function addNewProperty(Export $csv , string $property , string $values)
    {
        $records = $this->records;
        $csv->beforeEach(function ($records) use($property,$values) {
            $records->$property =  $values;
        });
    }

}
