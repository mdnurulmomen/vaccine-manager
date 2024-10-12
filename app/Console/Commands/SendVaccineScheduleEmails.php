<?php

namespace App\Console\Commands;

use App\Models\UserVaccine;
use Illuminate\Console\Command;
use App\Notifications\VaccineNotification;

class SendVaccineScheduleEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:vaccine-schedule-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send users an email about their vaccine schedule';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $vaccinesToUpdate = UserVaccine::with('user')
        ->whereDate('schedule', "=", \Carbon\Carbon::tomorrow())
        ->where('is_completed', false)
        ->get();

        foreach ($vaccinesToUpdate as $vaccine) {
            $vaccine->user->notify(new VaccineNotification($vaccine->user));
        }
    }
}
