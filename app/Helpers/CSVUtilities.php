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

    public function removeHeader($request)
    {
       return preg_replace("/^\w.+/", '', file_get_contents($request->file('student_grades_csv')));
    }

    public function toArrayAndChunk($request,$chunked)
    {
       return array_chunk(
                array_filter(
                    preg_split("/\n/",
                        str_replace(
                            ',', "\n", $this->removeHeader($request)
                        )
                    )
                )
            , $chunked);
    }

}
