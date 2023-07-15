<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\DeveloperNoteResource;
use App\Http\Resources\v1\FAQResource;
use App\Models\v1\DeveloperNote;
use App\Models\v1\FAQ;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientMobileDeveloperNoteController extends Controller
{
    use ApiResponseHelpers;

    public function index($id)
    {
        $query = DeveloperNote::where('slug', $id)->firstOrFail();
        $data = new DeveloperNoteResource($query);
        return $this->respondWithSuccess($data);
    }

    public function faq(Request $request)
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
}
