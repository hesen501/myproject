<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\StoreRequest;
use App\Http\Requests\Admin\City\UpdateRequest;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use Psy\Util\Json;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $cities = City::query()->with('translations');

        if ($request->filled('title')){
            $title = $request->input('title');
            $cities->whereHas('translations', function ($q) use ($title) {
                $q->where('title', 'like', '%' . $title . '%');
            });
        }

        if ($request->has('delivery_status')){
            $cities->where('delivery_status', $request->delivery_status);
        }

        $cities = $cities->paginate(10);

        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $city = City::query()->create($request->validated());

        if ($request->has('translations')) {
            foreach ($request->input('translations') as $key => $value) {
                $city->translations()->create([
                    'title' => $value,
                    'locale' => $key, // Adjust this based on your translation model
                ]);
            }
        }

        return response()->json($city->id,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $city = City::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'City not found'], 404);
        }
        return response()->json($city,200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $city = City::query()->findOrFail($id);
        $city->update($request->validated());

        if ($request->has('translations')) {
            foreach ($request->input('translations') as $translation) {
                if (isset($translation['id'])) {
                    $city->translations()->findOrFail($translation['id'])->update([
                        'title' => $translation['title'],
                        'locale' => $translation['locale'], // Adjust based on your model
                    ]);
                } else {
                    // Create a new translation if no ID exists
                    $city->translations()->create([
                        'title' => $translation['title'],
                        'locale' => $translation['locale'],
                    ]);
                }
            }
        }

        return response()->json($city);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $city = City::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'City not found'], 404);
        }

        $city->delete();

        return response()->json(null, 204);
    }
}
