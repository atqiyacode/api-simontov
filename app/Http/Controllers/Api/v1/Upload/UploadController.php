<?php

namespace App\Http\Controllers\Api\v1\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Upload\StoreUploadSliderCoverRequest;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class UploadController extends Controller
{
    use ApiResponseHelpers;

    public $homeSliderPath;

    public function __construct()
    {
        $this->homeSliderPath = storage_path('app/public/home-slider');
    }

    public function homeSlider(StoreUploadSliderCoverRequest $request)
    {

        $file = $request->file('cover');
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

        DB::transaction(function () use ($file, $fileName) {
            if (!File::isDirectory($this->homeSliderPath)) {
                File::makeDirectory($this->homeSliderPath, 0775, true, true);
            }

            if ($file->getClientOriginalExtension() != 'svg') {
                $canvas = Image::canvas(300, 150);
                $resizeImage  = Image::make($file)->resize(300, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $canvas->insert($resizeImage, 'center');
                $canvas->save($this->homeSliderPath . '/' . $fileName);
            } else {
                $file->move($this->homeSliderPath, $fileName);
            }
        });
        return [
            'cover' => $fileName,
            'url' => request()->getSchemeAndHttpHost() . '/storage/home-slider/' . $fileName,
        ];
    }

    public function deleteHomeSlider($oldFile)
    {
        DB::transaction(function () use ($oldFile) {
            $old_image = str_replace(request()->getSchemeAndHttpHost() . '/storage/home-slider', '', $oldFile);
            if (File::exists($this->homeSliderPath . '/' . $old_image)) {
                File::delete($this->homeSliderPath . '/' . $old_image);
            }
        });
        return response()->json(trans('alert.success'), 200);
    }
}
