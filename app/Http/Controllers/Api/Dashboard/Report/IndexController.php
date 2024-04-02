<?php

namespace App\Http\Controllers\Api\Dashboard\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Report\ReportResource;
use App\Models\Report;

class IndexController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $reports = Report::paginate($data['entriesOnPage'], ['*'], 'page', $data['page']);
        return ReportResource::collection($reports);
    }
}
