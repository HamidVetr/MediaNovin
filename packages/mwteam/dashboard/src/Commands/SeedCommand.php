<?php

namespace Mwteam\Dashboard\Commands;

use Illuminate\Console\Command;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'packages:seed';

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
        $this->call('db:seed', ['--class' => "Mwteam\\Dashboard\\Database\\Seeds\\PermissionTableSeeder"]);

        $packages = config('packages.packages');

        foreach ($packages as $package){
            $config = include base_path('packages/mwteam/'. $package.'/src/config.php');

            if (isset($config['seed'])){
                foreach ($config['seed'] as $seed){
                    $this->call('db:seed', ['--class' => $seed]);
                }
            }
        }

    }
}
