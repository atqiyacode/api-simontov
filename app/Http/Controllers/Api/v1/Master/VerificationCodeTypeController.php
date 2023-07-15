<?php

namespace App\Http\Controllers\Api\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\VerificationCodeType\StoreVerificationCodeTypeRequest;
use App\Http\Requests\v1\VerificationCodeType\UpdateVerificationCodeTypeRequest;
use App\Http\Resources\v1\VerificationCodeTypeResource;
use App\Models\v1\VerificationCodeType;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class VerificationCodeTypeController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = VerificationCodeType::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = VerificationCodeTypeResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVerificationCodeTypeRequest $request)
    {
        $query = VerificationCodeType::create($request->all());
        $data = new VerificationCodeTypeResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(VerificationCodeType $verificationCodeType)
    {
        return $this->respondWithSuccess([
            'data' => new VerificationCodeTypeResource($verificationCodeType)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVerificationCodeTypeRequest $request, VerificationCodeType $verificationCodeType)
    {
        $verificationCodeType->slug = null;
        $verificationCodeType->update($request->all());
        $data = new VerificationCodeTypeResource($verificationCodeType);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VerificationCodeType $verificationCodeType)
    {
        $verificationCodeType->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }
}
