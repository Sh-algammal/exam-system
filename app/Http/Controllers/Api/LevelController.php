<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest;
use App\Http\Requests\LevelUpdateRequest;
use App\Http\Resources\LevelResource;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    //
    public function index()
    {
        $levels = Level::with("laiha")->get();
        return LevelResource::collection($levels);
    }

    public function show(Level $level)
    {
        $level->load(['laiha', 'sections']);
        return new LevelResource($level);
    }

    public function store(LevelRequest $request)
    {
        $validate = $request->validated();
        $level = Level::create($validate);
        return new LevelResource($level->load("laiha"));
    }

    public function update(LevelUpdateRequest $request, Level $level)
    {
        $validate = $request->validated();
        $level->update($validate);
        return new LevelResource($level->load("laiha"));
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return response()->json([
            'status' => true,
            'message' => 'Level Deleted Successfully'
        ], 200);
    }
}
