<?php

namespace Laralum\Laralum\Commands;

use Illuminate\Console\Command;
use Laralum\Laralum\Packages;

class LaralumPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laralum:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all the laralum vendor views and configurations';

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
        $this->call('laralum:info');

        $this->info('Looking for installed packages...');

        $packages = Packages::all();

        $this->call('laralum:packages');

        $this->line(' ');
        $this->comment('- Found '.count($packages).' packages installed');

        if ($this->confirm('Do you wish to continue?')) {
            $this->info('Publishing packages...');
            $this->line(' ');

            $bar = $this->output->createProgressBar(count($packages));

            foreach ($packages as $package) {
                $provider = Packages::provider($package);
                if ($provider) {
                    if (class_exists('Laralum\\'.ucfirst($package)."\\$provider")) {
                        $pr = 'Laralum\\'.ucfirst($package)."\\$provider";
                    } elseif (class_exists('Laralum\\'.strtoupper($package)."\\$provider")) {
                        $pr = 'Laralum\\'.strtoupper($package)."\\$provider";
                    }

                    if ($pr) {
                        $this->callSilent('vendor:publish', [
                            '--provider' => $pr,
                            '--force' => true,
                        ]);
                    }
                }
                $bar->advance();
            }
            $bar->finish();
            $this->line(' ');
            $this->line(' ');
            $this->info('All the packages were published!');
        } else {
            $this->error('Publishing stopped');
        }
    }
}
