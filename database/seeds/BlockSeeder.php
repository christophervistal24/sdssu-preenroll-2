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
        'block_limit' => 45,
       	'level' => 1
       ]);

       Block::create([
       	'course' => 'CS',
       	'no_of_enrolled' => 0,
       	'block_name' => 'A',
        'block_limit' => 45,
       	'level' => 2
       ]);

       Block::create([
       	'course' => 'CS',
       	'no_of_enrolled' => 0,
       	'block_name' => 'A',
         'block_limit' => 45,
       	'level' => 3
       ]);

       Block::create([
        'course' => 'CS',
        'no_of_enrolled' => 0,
        'block_name' => 'A',
        'block_limit' => 45,
        'level' => 4
       ]);

       Block::create([
        'course' => 'CE',
        'no_of_enrolled' => 0,
        'block_name' => 'A',
        'block_limit' => 45,
        'level' => 1
       ]);

       Block::create([
        'course' => 'CE',
        'no_of_enrolled' => 0,
        'block_name' => 'A',
        'block_limit' => 45,
        'level' => 2
       ]);

       Block::create([
        'course' => 'CE',
        'no_of_enrolled' => 0,
        'block_name' => 'A',
        'block_limit' => 45,
        'level' => 3
       ]);

       Block::create([
        'course' => 'CE',
        'no_of_enrolled' => 0,
        'block_name' => 'A',
        'block_limit' => 45,
        'level' => 4
       ]);

       Block::create([
        'course' => 'CE',
        'no_of_enrolled' => 0,
        'block_name' => 'A',
        'block_limit' => 45,
        'level' => 5
       ]);
    }
}
