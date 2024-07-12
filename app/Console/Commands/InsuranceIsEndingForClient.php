<?php

namespace App\Console\Commands;

use App\Messages\OverdueInsurance;
use App\Models\Active;
use App\Models\Deal;
use App\Models\User;
use App\Services\Notifier;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InsuranceIsEndingForClient extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:insurance-is-ending-for-client';

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
        $message = new OverdueInsurance(Carbon::now());
        $actives = Active::where('osago', '<=', Carbon::now()->format('Y-m-d'))->pluck('id');

        $allDeals = Active::with('deals.client')->whereIn('id', $actives)->get();

        $phoneNumbers = $allDeals->pluck('client.phone_number')->unique();

        foreach ($phoneNumbers as $phoneNumber) {
            $notifier->notifyWithBranchProfileId($phoneNumber, '74226ea6-806d', $message);
            $notifier->notify($phoneNumber, $message);
        }
    }
}
