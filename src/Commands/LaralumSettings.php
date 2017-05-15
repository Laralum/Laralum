<?php

namespace Laralum\Laralum\Commands;

use Illuminate\Console\Command;
use Laralum\Settings\Models\Settings;

class LaralumSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laralum:settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all the laralum settings';

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

        $this->table(
            ['Base URL'], [
            [config('laralum.settings')['base_url']],
        ]);

        $this->table(
            ['API URL'], [
            [config('laralum.settings')['api_url']],
        ]);

        $s = Settings::first();

        $this->table(
            ['APP Name'], [
            [$s->appname],
        ]);

        $this->table(
            ['Description'], [
            [$s->description],
        ]);

        $this->table(
            ['Keywords'], [
            [$s->keywords],
        ]);

        $this->table(
            ['Author'], [
            [$s->author],
        ]);
    }
}
