<?php
namespace App\Services;

use App\Models\Car;
use App\Models\Deal;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class ServiceService
{
    public function calculateDaysBetween($rentalStart, $rentalEnd)
    {
        // Create Carbon instances for the start and end dates
        $start = Carbon::parse($rentalStart);
        $end = Carbon::parse($rentalEnd);

        // Calculate the number of days between the two dates
        $days = $start->diffInDays($end, false); // Get the difference in days (can be negative)

        // Round up and ensure the result is not negative
        return max(ceil($days), 0);
    }

}
