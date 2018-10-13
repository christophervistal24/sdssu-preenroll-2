<?php

use App\Block;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Block::create([
       	'course' => 'CS',
       	'no_of_enrolled' => 0,
       	'block_name' => 'A',
       	'level' => 1
       ]);

       Block::create([
       	'course' => 'CS',
       	'no_of_enrolled' => 0,
       	'block_name' => 'A',
       	'level' => 2
       ]);

       Block::create([
       	'course' => 'CS',
       	'no_of_enrolled' => 0,
       	'block_name' => 'A',
       	'level' => 3
       ]);

       Block::create([
       	'course' => 'CS',
       	'no_of_enrolled' => 0,
       	'block_name' => 'A',
       	'level' => 4
       ]);

    }
}
