<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaihaRequest;
use App\Http\Requests\UpdateLaihaRequest;
use App\Http\Resources\LaihaResource;
use App\Models\Laiha;

class LaihaController extends Controller
{
    public function index()
    {
        $laihas = Laiha::with('levels')->get();
        return LaihaResource::collection($laihas);
    }

    public function show(Laiha $laiha)
    {
        $laiha->load('levels');
        return new LaihaResource($laiha);
    }

    public function store(LaihaRequest $request)
    {
        $validate = $request->validated();
        $laiha = Laiha::create($validate);
        return new LaihaResource($laiha);
    }

    public function update(UpdateLaihaRequest $request, Laiha $laiha)
    {
        $validate = $request->validated();
        $laiha->update($validate);
        return new LaihaResource($laiha);
    }

    public function destroy(Laiha $laiha)
    {
        $laiha->delete();
        return response()->json([
            'status' => true,
            'message' => 'Laiha Deleted Successfully'
        ], 200);
    }
}
