<?php

namespace Mwteam\Dashboard\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'packages:seed {--package= : The package to be seed} {--table= : The table to be seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed packages';

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
        $packages = config('packages.packages');

        foreach ($packages as $package){
            if(is_null($this->option('package')) || $this->option('package') == $package){
                $config = include base_path('packages/mwteam/'. $package.'/src/config.php');

                if (isset($config['seed'])){
                    foreach ($config['seed'] as $table => $seed){
                        if (is_null($this->option('table')) || $this->option('table') == $table){
                            $this->call('db:seed', ['--class' => $seed]);
                        }
                    }
                }
            }
        }
    }
}
