<?php

namespace App\Http\Controllers\API;

use App\Events\UserDetailEvent;
use App\Events\UserEvent;
use App\Events\UserLocationEvent;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = $request->has('all') ? $this->service->getAll() : $this->service->getPaginate();
        return $response->getResult();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $query = $this->service->create($request->all());
        UserEvent::dispatch($query->getResult());
        UserDetailEvent::dispatch($query->getResult());
        UserLocationEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->service->findById($id)->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $query = $this->service->update($id, $request->all());
        UserEvent::dispatch($query->getResult());
        UserDetailEvent::dispatch($query->getResult());
        UserLocationEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $query = $this->service->delete($id);
        UserEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restore($id)
    {
        $query = $this->service->restore($id);
        UserEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDelete($id)
    {
        $query = $this->service->forceDelete($id);
        UserEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function destroyMultiple(Request $request)
    {
        $query = $this->service->destroyMultiple($request->ids);
        UserEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function restoreMultiple(Request $request)
    {
        $query = $this->service->restoreMultiple($request->ids);
        UserEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function forceDeleteMultiple(Request $request)
    {
        $query = $this->service->forceDeleteMultiple($request->ids);
        UserEvent::dispatch($query->getResult());
        return $query->toJson();
    }

    public function exportCsv()
    {
        return Excel::download(new UserExport, 'User.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportPdf()
    {
        return Excel::download(new UserExport, 'User.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportExcel()
    {
        return Excel::download(new UserExport, 'User.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
