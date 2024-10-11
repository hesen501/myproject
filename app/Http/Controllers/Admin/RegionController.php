<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Region\StoreRequest;
use App\Http\Requests\Admin\Region\UpdateRequest;
use App\Services\RegionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    private RegionService $regionService;

    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }

    /**
     * Display a listing of the regions.
     */
    public function index(Request $request): JsonResponse
    {
        $regions = $this->regionService->getRegions($request);

        return response()->json($regions);
    }

    /**
     * Store a newly created region in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $region = $this->regionService->createRegion($request->validated());

        return response()->json([
            'id' => $region->id,
            'message' => 'Region created successfully',
        ], 201);
    }

    /**
     * Display the specified region.
     */
    public function show(string $id): JsonResponse
    {
        $region = $this->regionService->findRegionById($id);

        if (!$region) {
            return response()->json(['message' => 'Region not found'], 404);
        }

        return response()->json($region);
    }

    /**
     * Update the specified region in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $region = $this->regionService->findRegionById($id);

        if (!$region) {
            return response()->json(['message' => 'Region not found'], 404);
        }

        $region = $this->regionService->updateRegion($region, $request->validated());

        return response()->json($region);
    }

    /**
     * Remove the specified region from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->regionService->deleteRegion($id);
            return response()->json(['message' => 'Region deleted successfully'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Region not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the region'], 500);
        }
    }
}
