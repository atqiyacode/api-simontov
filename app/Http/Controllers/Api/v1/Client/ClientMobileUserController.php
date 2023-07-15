<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Events\v1\UserClientEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Client\UpdateAvatarRequest;
use App\Http\Requests\v1\Client\UpdateClientEmailRequest;
use App\Http\Requests\v1\Client\UpdateClientPasswordRequest;
use App\Http\Requests\v1\Client\UpdateClientPhoneRequest;
use App\Http\Resources\v1\Client\ClientCurrentResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use F9Web\ApiResponseHelpers;
use Image;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientMobileUserController extends Controller
{
    use ApiResponseHelpers;

    public $path;

    public function __construct()
    {
        $this->path = storage_path('app/public/ibr-avatar');
    }

    public function tokens(Request $request)
    {
        return $data = $request->user()->tokens;
        return $this->respondWithSuccess($data);
    }
    public function email(UpdateClientEmailRequest $request)
    {
        $user = auth()->user();
        $user->newEmail($request->email);
        $user->update();
        $data = new ClientCurrentResource($user);
        UserClientEvent::dispatch($user->id, $data);
        return $this->respondWithSuccess($data);
    }
    public function cancelEmail()
    {
        $user = auth()->user();
        $user->clearPendingEmail();
        $data = new ClientCurrentResource($user);
        UserClientEvent::dispatch($user->id, $data);
        return $this->respondWithSuccess($data);
    }
    public function resendEmail()
    {
        $user = auth()->user();
        $user->resendPendingEmailVerificationMail();
        $data = new ClientCurrentResource($user);
        UserClientEvent::dispatch($user->id, $data);
        return $this->respondWithSuccess($data);
    }
    public function phone(UpdateClientPhoneRequest $request)
    {
        $url = config('app.whatsapp_server_main') . '/contacts/' . $request->phone . '@s.whatsapp.net';
        $res = Http::get($url);
        if (!$res['exists']) {
            return response()->json([
                'title' => trans('alert.not_whatsapp_number'),
                'message' => trans('alert.not_whatsapp_number'),
                'errors' => [
                    'phone' => [trans('alert.not_whatsapp_number')]
                ],
            ], 422);
        }
        auth()->user()->update([
            'phone' => $request->phone
        ]);
        $data = new ClientCurrentResource(auth()->user());
        UserClientEvent::dispatch(auth()->user()->id, $data);
        return $this->respondWithSuccess($data);
    }
    public function password(UpdateClientPasswordRequest $request)
    {
        $user = auth()->user();
        $checkPassword = Hash::check($request->old_password, $user->password);
        if (!$checkPassword) {
            return response()->json([
                'title' => trans('auth.wrong_old_password'),
                'message' => trans('auth.wrong_old_password'),
                'errors' => [
                    'old_password' => [trans('auth.wrong_old_password')]
                ],
            ], 422);
        }

        $user->password = Hash::make($request->password);
        $user->update();
        $data = new ClientCurrentResource($user);
        UserClientEvent::dispatch($user->id, $data);
        return $this->respondWithSuccess($data);
    }
    public function avatar(UpdateAvatarRequest $request)
    {
        $user = auth()->user();
        $user->avatar = $request->file('file') ? $this->get_image($request->file('file'), $user->avatar) : $user->avatar;
        if ($user->isDirty()) {
            $user->update();
        }
        $data = new ClientCurrentResource($user);
        UserClientEvent::dispatch($user->id, $data);
        return $this->respondWithSuccess($data);
    }


    // handle avatar upload

    public function get_image($file, $old)
    {
        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path, 0775, true, true);
        }
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $canvas = Image::canvas(250, 250);
        $resizeImage  = Image::make($file)->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
        });

        $canvas->insert($resizeImage, 'center');

        $saveImage = $canvas->save($this->path . '/' . $fileName);

        if ($saveImage) {
            $this->delete_image($old);
        }
        return request()->getSchemeAndHttpHost() . '/storage/ibr-avatar/' . $fileName;
    }

    public function delete_image($old)
    {
        $old_image = str_replace(request()->getSchemeAndHttpHost() . '/storage/ibr-avatar', '', $old);
        if (File::exists($this->path . '/' . $old_image)) {
            File::delete($this->path . '/' . $old_image);
        }
    }
}
