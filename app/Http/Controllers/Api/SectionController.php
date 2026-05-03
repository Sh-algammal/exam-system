<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Http\Requests\SectionUpdateRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //
    public function index ()
    {
        $sections=Section::with("level")->get();
        return SectionResource::collection($sections);
    }
    public function show(Section $section)
    {
        $section->load(['level', 'courses']);
        return new SectionResource($section);
    }
    public function store(SectionRequest $request)
    {
        $validate=$request->validated();
        $section=Section::create($validate);
        return new SectionResource($section->load("level"));
    }
    public function update(SectionUpdateRequest $request,Section $section)
    {
        $validate=$request->validated();

       $section->update($validate);
        return new SectionResource($section->load("level"));
    }
public function destroy(Section $section)
{
    $section->delete();
    return response()->json([
            'status' => true,
            'message' => 'Section Deleted Successfully'
        ], 200);
}


}
