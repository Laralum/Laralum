<?php

namespace Laralum\Laralum\Commands;

use Illuminate\Console\Command;

class LaralumInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laralum:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows the laralum logo';

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
        $this->comment('                                   ');
        $this->comment('    ...........................    ');
        $this->comment('   .yyyyyyyyyyyyyyyyyyyyyyyyyyy.   ');
        $this->comment('   .yyyyyyyyysssyyyyyyyyyyyyyyy.   ');
        $this->comment('   .yyyyyyyy/...oyyyyyyyyyyyyyy.     _                     _                 ');
        $this->comment('   .yyyyyyyy:   oyyyyyyyyyyyyyy.    | |                   | |                ');
        $this->comment('   .yyyyyyyy:   oyyyyyyyyyyyyyy.    | |     __ _ _ __ __ _| |_   _ _ __ ___  ');
        $this->comment("   .yyyyyyyy:   oyyyyyyyyyyyyyy.    | |    / _` | '__/ _` | | | | | '_ ` _ \ ");
        $this->comment('   .yyyyyyyy:   oyyyyyyyyyyyyyy.    | |___| (_| | | | (_| | | |_| | | | | | |');
        $this->comment("   .yyyyyyyy:   oyyyyyyyyyyyyyy.    |______\__,_|_|  \__,_|_|\__,_|_| |_| |_|");
        $this->comment('   .yyyyyyyy:   -:::::::syyyyyy.                                             ');
        $this->comment('   .yyyyyyyy+`          syyyyyy.    Laralum Administration Panel - laralum.com');
        $this->comment('   .yyyyyyyyys++++++++++yyyyyyy.   ');
        $this->comment('   .yyyyyyyyyyyyyyyyyyyyyyyyyyy.   ');
        $this->comment('   .yyyyyyyyyyyyyyyyyyyyyyyyyyy.   ');
        $this->comment('    ...........................    ');
        $this->comment('                                   ');
        $this->line(' ');
    }
}
