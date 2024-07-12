<?php

namespace App\Console\Commands;

use App\Models\Active;
use App\Models\User;
use App\Services\Notifier;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InsuranceIsEnding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:insurance-is-ending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Notifier $notifier)
    {
        $actives = Active::query()->where('osago', '=', Carbon::now()->addDays(10)->format('Y-m-d'))->get();
        $admins = User::query()->where('role_id', User::ROLE_ADMIN)->get();

        foreach ($admins as $admin) {
            foreach ($actives as $active) {
                $message = new \App\Messages\InsuranceIsEnding(Carbon::parse($active->osago), $active->getName());
                $notifier->notify($admin->phone_number, $message);
            }
        }

        return 1;
    }
}
