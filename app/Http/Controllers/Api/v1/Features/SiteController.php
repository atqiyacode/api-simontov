<?php

namespace App\Http\Controllers\Api\v1\Features;

use App\Events\v1\SiteEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Site\StoreSiteRequest;
use App\Http\Requests\v1\Site\UpdateSiteRequest;
use App\Http\Resources\v1\SiteResource;
use App\Models\v1\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        $rows = $request->rows ?? 10;
        $query = Site::canDelete()->when($request->has('search'), function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('lng', 'LIKE', "%{$keyword}%")
                ->orWhere('lat', 'LIKE', "%{$keyword}%");
        })
            ->orderBy('id', 'DESC');
        $data = SiteResource::collection($request->has('all') ? $query->get() : $query->paginate($rows));
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiteRequest $request)
    {
        $data = DB::transaction(function () use ($request) {
            $request->merge([
                'lng' => $request->longitude,
                'lat' => $request->lattitude,
            ]);
            $query = Site::create($request->all());
            SiteEvent::dispatch([
                "message" => 'Add New Site',
                "user" => auth()->user()->name
            ]);
            return new SiteResource($query);
        });
        return $this->respondWithSuccess([
            'message' => trans('alert.success-save'),
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        $data = new SiteResource($site);
        return $this->respondWithSuccess($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiteRequest $request, Site $site)
    {
        $request->merge([
            'lng' => $request->longitude,
            'lat' => $request->lattitude,
        ]);
        $site->update($request->all());
        $data = new SiteResource($site);
        SiteEvent::dispatch([
            "message" => 'Update Site',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-update'),
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        $site->delete();
        SiteEvent::dispatch([
            "message" => 'Delete Site',
            "user" => auth()->user()->name
        ]);
        return $this->respondWithSuccess([
            'message' => trans('alert.success-delete'),
        ]);
    }

    public function restore($id)
    {
        $site = Site::onlyTrashed()->whereId($id)->firstOrFail();
        $data = DB::transaction(function () use ($site) {
            $site->restore();
            return new SiteResource($site);
        });
        SiteEvent::dispatch($data);
        return response()->json([
            'message' => trans('alert.success-restored'),
        ], 200);
    }

    public function delete($id)
    {
        $site = Site::onlyTrashed()->whereId($id)->firstOrFail();
        DB::transaction(function () use ($site) {
            $data = new SiteResource($site);
            SiteEvent::dispatch($data);
            $site->forceDelete();
        });
        return response()->json([
            'message' => trans('alert.success-deleted-permanent'),
        ], 200);
    }
}
