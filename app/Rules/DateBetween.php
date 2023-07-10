<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class DateBetween implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pickupDate = Carbon::parse($value)->startOfDay();
        $lastDate = Carbon::now()->addWeeks(1)->startOfDay();

        return $pickupDate >= Carbon::today() && $pickupDate <= $lastDate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tanggal reservasi harus berada antara hari ini dan 1 minggu ke depan.';
    }
}
