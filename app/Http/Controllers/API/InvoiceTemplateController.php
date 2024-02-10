<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceTemplate\UpdateInvoiceTemplateRequest;
use App\Http\Resources\InvoiceTemplate\InvoiceTemplateResource;
use App\Models\InvoiceTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvoiceTemplateController extends Controller
{
    public function __construct()
    {
    }

    public function index(): JsonResponse
    {
        $invoiceTemplate = InvoiceTemplate::firstOrFail();
        return $this->responseSuccess(null, new InvoiceTemplateResource($invoiceTemplate));
    }

    public function update(UpdateInvoiceTemplateRequest $request, InvoiceTemplate $invoiceTemplate): JsonResponse
    {
        $invoiceTemplate->update($request->validated());

        return $this->responseSuccess('InvoiceTemplate updated Successfully', new InvoiceTemplateResource($invoiceTemplate));
    }
}
