<?php

namespace App\Http\Controllers\Api\v1\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AuthVerificationMethod\StoreAuthVerificationMethodRequest;
use App\Http\Requests\v1\AuthVerificationMethod\UpdateAuthVerificationMethodRequest;
use App\Http\Resources\v1\AuthVerificationMethodResource;
use App\Models\v1\AuthVerificationMethod;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class AuthVerificationMethodController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = AuthVerificationMethod::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = AuthVerificationMethodResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthVerificationMethodRequest $request)
    {
        $query = AuthVerificationMethod::create($request->all());
        $data = new AuthVerificationMethodResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AuthVerificationMethod $authVerificationMethod)
    {
        return $this->respondWithSuccess([
            'data' => new AuthVerificationMethodResource($authVerificationMethod)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthVerificationMethodRequest $request, AuthVerificationMethod $authVerificationMethod)
    {
        $authVerificationMethod->update($request->all());
        $data = new AuthVerificationMethodResource($authVerificationMethod);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuthVerificationMethod $authVerificationMethod)
    {
        $authVerificationMethod->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }
}
