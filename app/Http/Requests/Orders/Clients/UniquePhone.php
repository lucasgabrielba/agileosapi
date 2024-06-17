<?php

namespace App\Http\Requests\Orders\Clients;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniquePhone implements ValidationRule
{
    public function validate(string $attribute, mixed $phones, \Closure $fail): void
    {

        if (! is_array($phones)) {
            $fail('O telefone deve ser um array válido.');

            return;
        }

        foreach ($phones as $phone) {
            $exists = DB::table('clients')
                ->whereJsonContains('phones', $phone)
                ->exists();

            if ($exists) {
                $fail('Um ou mais telefones já estão em uso.');

                return;
            }
        }
    }
}
