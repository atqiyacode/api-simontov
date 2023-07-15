<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Register\NewRegisterRequest;
use App\Http\Requests\v1\Register\RegisterCheckRequest;
use App\Http\Resources\v1\RegisterEmployeeResource;
use App\Models\User;
use App\Models\v1\Employee;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    use ApiResponseHelpers;

    public function index(NewRegisterRequest $request)
    {
        if (config('app.env') === 'production') {
            $url = config('app.whatsapp_server_main') . '/contacts/' . $request->phone;
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
        }
        DB::transaction(function () use ($request) {
            $user = User::create([
                'username' => $request->code,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email ? $request->email : $request->code . '@fakemail.com',
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('employee');
        });
        return $this->respondOk(trans('auth.success.register', ['name' => $request->name]));
    }

    public function check(RegisterCheckRequest $request)
    {
        $query = Employee::where([
            'nik' => $request->nik,
            'code' => $request->code,
        ])->first();

        if (!$query) {
            return response()->json([
                'title' => trans('messages.response.error'),
                'message' => trans('auth.nik_not_match'),
                'errors' => [
                    'code' => [
                        trans('auth.nik_not_match')
                    ]
                ],
            ], 422);
        }
        $data = new RegisterEmployeeResource($query);
        return $this->respondWithSuccess($data);
    }
}
