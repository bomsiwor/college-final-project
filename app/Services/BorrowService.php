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

    public function returning($data, $request): bool
    {
        $request->validate([
            'returning_date' => 'required|after_or_equal:today',
            'condition' => 'required'
        ]);

        try {
            DB::transaction(function () use ($data, $request) {
                $data->actual_return_date = $request->returning_date;
                $data->after_condition = $request->condition;
                $data->save();

                Returning::create([
                    'borrow_id' => $data->id,
                    'verificator_id' => Auth::user()->id,
                    'returning_date' => $request->returning_date,
                    'condition' => $request->condition
                ]);

                Tool::where('inventory_unique', $data->inventory_id)->update([
                    'status' => 'available',
                    'condition' => $request->condition
                ]);
            });
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }
}
