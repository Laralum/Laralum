<?php

namespace Laralum\Laralum\Commands;

use Illuminate\Console\Command;
use Laralum\Laralum\Packages;
use Laralum\Users\Models\User;

class LaralumSuperAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laralum:superadmins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all the laralum superadmins';

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
        $headers = ['Email', 'Name', 'Creation Date'];

        $admins = collect(config('laralum.superadmins'))->map(function ($admin) {
            $data = [$admin, '-', '-'];

            $user = User::where('email', $admin)->first();

            if ($user) {
                $data[1] = $user->name;
                $data[2] = $user->created_at;
            }

            return $data;
        });

        $this->table($headers, $admins);
    }
}
