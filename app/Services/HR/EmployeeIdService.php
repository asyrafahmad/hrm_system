<?php

namespace App\Services\HR;

use Illuminate\Support\Facades\DB;

class EmployeeIdService
{
    public function generate(): string
    {
        return DB::transaction(function () {
            $sequence = DB::table('sequences')
                ->where('key', 'employee')
                ->lockForUpdate()
                ->first();

            if (!$sequence) {
                throw new \Exception('Employee sequence not found.');
            }

            $next = $sequence->current_value + 1;

            DB::table('sequences')
                ->where('key', 'employee')
                ->update(['current_value' => $next]);

            return 'E' . str_pad($next, 5, '0', STR_PAD_LEFT);
        });
    }
}
