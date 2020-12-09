<?php

namespace App\Http\Controllers;

use App\Users\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends Controller
{
    protected $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json($this->userService->getAll($request->query('role'))->toArrayWithMetadata());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return response()->json($this->userService->create($data)->toArrayWithMetadata());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->userService->show($id)->toArrayWithMetadata());
    }

    public function update($id, Request $request): JsonResponse
    {
        return response()->json($this->userService->update($id, $request->all())->toArrayWithMetadata());
    }
}
