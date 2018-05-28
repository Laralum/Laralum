<?php

namespace Laralum\Laralum\Commands;

use Illuminate\Console\Command;

class LaralumCreatePackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laralum:create-package {name} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new laralum package {name : Package name} {--path : Location to create the package}';

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
        $name = $this->argument('name');
        $path = $this->option('path') ? base_path().'/'.$this->option('path').'/'.$name : __DIR__.'/../../'.$name;

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
            $this->info('Project root created at: '.$path);

        // Create package structure here
        } else {
            $this->error("The folder '$path' already exists");
        }
    }
}
