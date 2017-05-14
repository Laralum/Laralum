<?php

namespace Laralum\Laralum\Commands;

use Illuminate\Console\Command;
use Laralum\Laralum\Packages;

class LaralumPackages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laralum:packages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all the laralum installed packages';

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
        $headers = ['Package List'];

        $packages = collect(Packages::all())->map(function ($package) {
            return [ucfirst($package)];
        });

        $this->table($headers, $packages);
    }
}
