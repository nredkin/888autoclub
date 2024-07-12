<?php

namespace App\Console\Commands;

use App\Messages\OverduePayment;
use App\Models\Deal;
use App\Services\Notifier;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OverduePaymentNotifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:overdue-payment';

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
        $deals = Deal::query()->with(['payments' => function ($q) {
            $q->where('created_at', '<=', Carbon::now());
        },'schedule','schedule.paydays' => function ($q) {
            $q->where('date', '<=', Carbon::now());
        }])->get();

        foreach ($deals as $deal) {
            $paid = 0;

            foreach ($deal->payments as $payment) {
                $paid += $payment->rent + $payment->buyout;
            }

            $schedule = $deal->schedule;

            $mustBePaid = 0;

            if ($schedule) {
                foreach ($schedule->paydays as $payday) {
                    $mustBePaid += $deal->cost_of_rent + $deal->cost_of_buyout;
                }
            }

            if ($mustBePaid > $paid) {
                try {
                    $notifier->notify($deal->client->phone_number, new OverduePayment(($schedule->paydays->last())->date));
                } catch (\Exception $e) {
                    \Log::error($e->getMessage());
                }
            }
        }
    }
}
