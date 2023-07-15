<?php

namespace App\Http\Controllers\Api\v1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CompanyInformation\StoreCompanyInformationRequest;
use App\Http\Requests\v1\CompanyInformation\UpdateCompanyInformationRequest;
use App\Http\Resources\v1\CompanyInformationResource;
use App\Models\v1\CompanyInformation;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class CompanyInformationController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = CompanyInformation::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = CompanyInformationResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyInformationRequest $request)
    {
        $query = CompanyInformation::create($request->all());
        $data = new CompanyInformationResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyInformation $companyInformation)
    {
        return $this->respondWithSuccess([
            'data' => new CompanyInformationResource($companyInformation)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyInformationRequest $request, CompanyInformation $companyInformation)
    {
        $companyInformation->update($request->all());
        $data = new CompanyInformationResource($companyInformation);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyInformation $companyInformation)
    {
        $companyInformation->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        CompanyInformation::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        CompanyInformation::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
