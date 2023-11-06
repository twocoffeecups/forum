<?php

namespace App\Http\Controllers\Admin\UnApprovedReason;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UnApprovedReason\UnApprovedReasonStoreRequest;
use App\Http\Requests\Admin\UnApprovedReason\UnApprovedReasonUpdateRequest;
use App\Models\UnApprovedReason;

class UnApprovedReasonController extends Controller
{

    protected function index()
    {
        return response()->json(['reasons' => UnApprovedReason::all()]);
    }

    protected function store(UnApprovedReasonStoreRequest $request)
    {
        $data = $request->validated();
        //dd($data);
        $reason = UnApprovedReason::firstOrCreate($data);
        return response()->json(['message' => 'Unapproved reason created.']);
    }

    protected function show(UnApprovedReason $reason)
    {
        return response()->json(['reason' => $reason]);
    }

    protected function update(UnApprovedReasonUpdateRequest $request, UnApprovedReason $reason)
    {
        $data = $request->validated();
        //dd($data);
        foreach($data as $key => $value) {
            $reason->$key = $value;
        }
        $reason->save();
        return response()->json(['message' => 'Unapproved reason updated.']);

    }

    protected function delete(UnApprovedReason $reason)
    {
        $reason->delete();
        return response()->json(['message' => 'Unapproved reasons deleted.']);
    }

    protected function status(UnApprovedReason $reason)
    {
        $reason->status = !$reason->status;
        $reason->save();
        return response()->json(['message' => 'Unapproved reasons status changed.']);
    }

}
