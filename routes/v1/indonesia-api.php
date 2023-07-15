<?php

use Illuminate\Support\Facades\Route;
use App\Http\Resources\v1\IndonesiaResource;
use App\Http\Resources\v1\IndonesiaVillageResource;
use Illuminate\Http\Request;

Route::middleware(['multilang', 'force.json', 'auth:api'])->prefix('indonesia')->group(function () {

    Route::get('/province', function () {
        $data = Cache::rememberForever('provinces', function () {
            return \Indonesia::allProvinces();
        });
        return response()->json(IndonesiaResource::collection($data), 200);
    });
    Route::get('/city', function (Request $request) {
        $provinceId = $request->province;
        $data = Cache::rememberForever('cities-' . $provinceId, function () use ($provinceId) {
            return \Indonesia::findProvince($provinceId, ['cities']);
        });
        return response()->json(IndonesiaResource::collection($data->cities ?? []), 200);
    });
    Route::get('/district', function (Request $request) {
        $cityId = $request->city;
        $data = Cache::rememberForever('districts-' . $cityId, function () use ($cityId) {
            return \Indonesia::findCity($cityId, ['districts']);
        });
        return response()->json(IndonesiaResource::collection($data->districts ?? []), 200);
    });
    Route::get('/village', function (Request $request) {
        $districtId = $request->district;
        $data = Cache::rememberForever('villages-' . $districtId, function () use ($districtId) {
            return \Indonesia::findDistrict($districtId, ['villages']);
        });
        return response()->json(IndonesiaResource::collection($data->villages ?? []), 200);
    });

    Route::get('/village/{id}', function ($id) {
        $data = \Indonesia::findVillage($id, ['province', 'city', 'district', 'district.city', 'district.city.province']);
        return response()->json(new IndonesiaVillageResource($data), 200);
    });
});
