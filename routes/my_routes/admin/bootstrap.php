<?php

//get all folders
$path = base_path() . '/routes/my_routes/admin/*/';
$directories = glob($path , GLOB_ONLYDIR);
for($i = 0; $i<count($directories); $i++)
{
    //require all
    require_once $directories[$i] . 'index.php';
}
