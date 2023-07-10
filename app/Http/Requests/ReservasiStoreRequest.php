<?php

namespace App\Http\Requests;

use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Illuminate\Foundation\Http\FormRequest;

class ReservasiStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_depan' => ['required'],
            'nama_belakang' => ['required'],
            'email' => ['required', 'email'],
            'tanggal_reservasi' => ['required', 'date', new DateBetween, new TimeBetween],
            'no_hp' => ['required'],
            'table_id' => ['required'],
            'kapasitas' => ['required'],

        ];
    }
}
