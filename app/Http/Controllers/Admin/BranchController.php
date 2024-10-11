<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Branch\StoreRequest;
use App\Http\Requests\Admin\Branch\UpdateRequest;
use App\Services\BranchService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private BranchService $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $filters = [
            'title' => $request->input('title'),
            'delivery_status' => $request->input('delivery_status'),
        ];

        $branches = $this->branchService->getAllBranches($filters);

        return response()->json($branches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $branch = $this->branchService->createBranch($request->validated());

        return response()->json([
            'id' => $branch->id,
            'message' => 'Branch created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $branch = $this->branchService->findBranchById($id);

        return $branch
            ? response()->json($branch)
            : response()->json(['message' => 'Branch not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        try {
            $branch = $this->branchService->updateBranch($id, $request->validated());
            return response()->json($branch);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Branch not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->branchService->deleteBranch($id);
            return response()->json(['message' => 'Branch deleted successfully'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Branch not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the branch'], 500);
        }
    }
}
