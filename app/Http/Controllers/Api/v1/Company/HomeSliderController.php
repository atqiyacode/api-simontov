<?php

namespace App\Http\Controllers\Api\v1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\HomeSlider\StoreHomeSliderRequest;
use App\Http\Requests\v1\HomeSlider\UpdateHomeSliderRequest;
use App\Http\Resources\v1\HomeSliderResource;
use App\Models\v1\HomeSlider;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use File;

class HomeSliderController extends Controller
{
    use ApiResponseHelpers;

    public $path;

    public function __construct()
    {
        $this->path = storage_path('app/public/home-slider');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = HomeSlider::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = HomeSliderResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeSliderRequest $request)
    {
        $query = HomeSlider::create($request->all());
        $data = new HomeSliderResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeSlider $homeSlider)
    {
        return $this->respondWithSuccess([
            'data' => new HomeSliderResource($homeSlider)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeSliderRequest $request, HomeSlider $homeSlider)
    {
        if ($homeSlider->cover != $request->cover) {
            $this->deleteImage($homeSlider->cover);
        }
        $homeSlider->update($request->all());
        $data = new HomeSliderResource($homeSlider);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeSlider $homeSlider)
    {
        $homeSlider->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        HomeSlider::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        $homeSlider = HomeSlider::onlyTrashed()->whereId($id)->firstOrFail();
        $this->deleteImage($homeSlider->cover);
        $homeSlider->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }

    public function deleteImage($oldFile)
    {
        $old_image = str_replace(request()->getSchemeAndHttpHost() . '/storage/home-slider', '', $oldFile);
        if (File::exists($this->path . '/' . $old_image)) {
            File::delete($this->path . '/' . $old_image);
        }
    }
}
