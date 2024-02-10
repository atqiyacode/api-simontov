<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceTemplate\UpdateInvoiceTemplateRequest;
use App\Http\Requests\InvoiceTemplate\CreateInvoiceTemplateRequest;
use App\Http\Resources\InvoiceTemplate\InvoiceTemplateResource;
use App\Models\InvoiceTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvoiceTemplateController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection
    {
        $invoiceTemplates = InvoiceTemplate::useFilters()->dynamicPaginate();

        return InvoiceTemplateResource::collection($invoiceTemplates);
    }

    public function store(CreateInvoiceTemplateRequest $request): JsonResponse
    {
        $invoiceTemplate = InvoiceTemplate::create($request->validated());

        return $this->responseCreated('InvoiceTemplate created successfully', new InvoiceTemplateResource($invoiceTemplate));
    }

    public function show(InvoiceTemplate $invoiceTemplate): JsonResponse
    {
        return $this->responseSuccess(null, new InvoiceTemplateResource($invoiceTemplate));
    }

    public function update(UpdateInvoiceTemplateRequest $request, InvoiceTemplate $invoiceTemplate): JsonResponse
    {
        $invoiceTemplate->update($request->validated());

        return $this->responseSuccess('InvoiceTemplate updated Successfully', new InvoiceTemplateResource($invoiceTemplate));
    }

    public function destroy(InvoiceTemplate $invoiceTemplate): JsonResponse
    {
        $invoiceTemplate->delete();

        return $this->responseDeleted();
    }

   
}
