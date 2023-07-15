<?php

namespace App\Http\Controllers\Api\v1\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\MobileAppMenu\StoreMobileAppMenuRequest;
use App\Http\Requests\v1\MobileAppMenu\UpdateMobileAppMenuRequest;
use App\Http\Resources\v1\MobileAppMenuResource;
use App\Models\v1\MobileAppMenu;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class MobileAppMenuController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = MobileAppMenu::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = MobileAppMenuResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMobileAppMenuRequest $request)
    {
        $request->merge([
            'mobile_status_id' => $request->status,
        ]);
        $query = MobileAppMenu::create($request->all());
        $data = new MobileAppMenuResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MobileAppMenu $mobileAppMenu)
    {
        return $this->respondWithSuccess([
            'data' => new MobileAppMenuResource($mobileAppMenu)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMobileAppMenuRequest $request, MobileAppMenu $mobileAppMenu)
    {
        $request->merge([
            'mobile_status_id' => $request->status,
        ]);
        $mobileAppMenu->slug = null;
        $mobileAppMenu->update($request->all());
        $data = new MobileAppMenuResource($mobileAppMenu);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MobileAppMenu $mobileAppMenu)
    {
        $mobileAppMenu->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        MobileAppMenu::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        MobileAppMenu::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
