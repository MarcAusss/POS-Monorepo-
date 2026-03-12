<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Fruit::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                                  ->store('images', 'public');
        }

        $fruit = Fruit::create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            'image_path'  => $imagePath,
        ]);

        return response()->json($fruit, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fruit = Fruit::findOrFail($id);

        return response()->json($fruit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fruit = Fruit::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($fruit->image_path) {
                Storage::disk('public')->delete($fruit->image_path);
            }

            $fruit->image_path = $request->file('image')
                                          ->store('images', 'public');
        }

        $fruit->name        = $request->input('name', $fruit->name);
        $fruit->description = $request->input('description', $fruit->description);
        $fruit->save();

        return response()->json($fruit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fruit = Fruit::findOrFail($id);

        // Delete image from storage if it exists
        if ($fruit->image_path) {
            Storage::disk('public')->delete($fruit->image_path);
        }

        $fruit->delete();

        return response()->json(['message' => 'Fruit deleted successfully']);
    }
}