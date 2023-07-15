<?php

namespace App\Http\Controllers\Api\v1\Info;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\FAQ\StoreFAQRequest;
use App\Http\Requests\v1\FAQ\UpdateFAQRequest;
use App\Http\Resources\v1\FAQResource;
use App\Models\v1\FAQ;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = FAQ::when($request->has('search'), function ($query) use ($keyword) {
            $query->where('label', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = FAQResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFAQRequest $request)
    {
        $query = FAQ::create($request->all());
        $data = new FAQResource($query);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $faq)
    {
        return $this->respondWithSuccess([
            'data' => new FAQResource($faq)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFAQRequest $request, FAQ $faq)
    {
        $faq->slug = null;
        $faq->update($request->all());
        $data = new FAQResource($faq);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        FAQ::onlyTrashed()->whereId($id)->firstOrFail()->restore();
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        FAQ::onlyTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
