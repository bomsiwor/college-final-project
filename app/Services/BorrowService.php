<?php

namespace App\Services;

use App\Models\Tool;
use App\Models\Borrow;
use App\Models\Returning;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BorrowService
{

    public function verify($data): bool
    {
        $validated = $data->validate([
            'status' => 'required',
            'verified_note' => 'nullable'
        ]);

        $meta = [
            'verificator_id' => Auth::user()->id,
            'verified_at' => now(),
        ];

        $validated += $meta;

        try {
            DB::transaction(function () use ($data, $validated) {
                Borrow::where('id', $data->id)->update($validated);
                if ($data->status == 'accepted') :
                    Tool::where('inventory_unique', $data->unique_id)->update(['status' => 'borrowed']);
                endif;
            });
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }

    public function returning($data): bool
    {
        try {
            DB::transaction(function () use ($data) {
                $data->actual_return_date = now()->addDays(10);
                $data->save();

                Returning::create([
                    'borrow_id' => $data->id,
                    'verificator_id' => Auth::user()->id,
                    'returning_date' => now()->addDays(10),
                    'condition' => 'good'
                ]);

                Tool::where('inventory_unique', $data->inventory_id)->update(['status' => 'available']);
            });
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }
}
