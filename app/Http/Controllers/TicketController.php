<?php


namespace App\Http\Controllers;


use App\Tickets\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController
{
    protected $ticketService;

    function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json($this->ticketService->getAll()->toArrayWithMetadata());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return response()->json($this->ticketService->create($data)->toArrayWithMetadata());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->ticketService->show($id)->toArrayWithMetadata());
    }

    public function update($id, Request $request): JsonResponse
    {
        return response()->json($this->ticketService->update($id, $request->all())->toArrayWithMetadata());
    }
}
