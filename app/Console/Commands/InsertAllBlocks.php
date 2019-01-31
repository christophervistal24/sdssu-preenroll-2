<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Block;

class InsertAllBlocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert all Blocks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
       $this->info("Successfully insert all blocks");
    }
}
