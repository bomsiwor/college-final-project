<?php

namespace App\Services;

use App\Models\Tool;
use App\Models\Radioactive;
use App\Models\RadioactiveBorrow;
use Illuminate\Support\Facades\DB;
use App\Models\RadioactiveReturning;
use Illuminate\Support\Facades\Auth;

class RadioactiveBorrowService
{

    public function verify($data)
    {
        $validated = $data->validate([
            'id' => 'required',
            'status' => 'required',
            'unique_id' => 'required',
            'verified_note' => 'nullable'
        ]);

        $meta = [
            'verificator_id' => Auth::user()->id,
            'verified_at' => now(),
            'inventory_id' => $validated['unique_id']
        ];

        $validated += $meta;
        unset($validated['unique_id']);

        try {
            DB::transaction(function () use ($validated) {
                RadioactiveBorrow::where('id', $validated['id'])->update($validated);

                if ($validated['status'] == 'accepted') :
                    Radioactive::where('inventory_unique', $validated['inventory_id'])->update(['status' => 'borrowed']);
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
        ]);

        try {
            DB::transaction(function () use ($data, $request) {
                $data->actual_return_date = $request->returning_date;
                $data->save();

                Radioactive::where('inventory_unique', $data->inventory_id)->update([
                    'status' => 'available',
                ]);

                RadioactiveReturning::create([
                    'borrow_id' => $data->id,
                    'verificator_id' => Auth::user()->id,
                    'returning_date' => $request->returning_date,
                ]);
            });
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }

    public function apiReturning($data, $request)
    {
        try {
            DB::transaction(function () use ($data, $request) {
                $data->actual_return_date = $request->returning_date;
                $data->save();

                RadioactiveReturning::create([
                    'borrow_id' => $data->id,
                    'verificator_id' => Auth::user()->id,
                    'returning_date' => $request->returning_date,
                ]);

                Radioactive::where('inventory_unique', $data->inventory_id)->update([
                    'status' => 'available',
                ]);
            });
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }
}
