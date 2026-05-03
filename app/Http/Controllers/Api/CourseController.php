<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function index()
    {
        $courses = Course::with("section")->get();
        return CourseResource::collection($courses);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file-input' => 'required|mimes:xlsx,csv,xls|max:5120',
        ]);

        $file = $request->file('file-input');
        
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            
            if (count($rows) <= 1) {
                return response()->json(['message' => 'Empty file or missing data'], 400);
            }
            
            // قراءة رأس الجدول وتوحيد الحروف لتسهيل المطابقة (تحويل المسافة إلى underscore)
            $headers = array_shift($rows);
            $headers = array_map(function($header) {
                return strtolower(trim(str_replace(' ', '_', $header ?? '')));
            }, $headers);
            
            $importedCount = 0;

            foreach ($rows as $row) {
                // دمج رأس الجدول مع القيم
                $rowData = array_combine($headers, $row);
                
                // التأكد من وجود البيانات الأساسية حتى لا يحدث خطأ
                if (empty($rowData['course_name']) || empty($rowData['section_id'])) {
                    continue; 
                }

                Course::create([
                    'section_id' => $rowData['section_id'] ?? null,
                    'course_name' => $rowData['course_name'] ?? null,
                    'course_code' => $rowData['course_code'] ?? null,
                    'day' => $rowData['day'] ?? null,
                    // تحويل وتأكيد صيغة التاريخ
                    'date' => !empty($rowData['date']) ? date('Y-m-d', strtotime($rowData['date'])) : null,
                    'doctor' => $rowData['doctor'] ?? null,
                    'location' => $rowData['location'] ?? null,
                ]);
                $importedCount++;
            }
            
            return response()->json([
                'status' => true,
                'message' => "Successfully imported $importedCount courses."
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error importing file: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Course $course)
    {
        $course->load('section');
        return new CourseResource($course);
    }

    public function store(CourseRequest $request)
    {
        $validate = $request->validated();
        $course = Course::create($validate);
        return new CourseResource($course->load("section"));
    }

    public function update(CourseUpdateRequest $request, Course $course)
    {
        $validate = $request->validated();
        $course->update($validate);
        return new CourseResource($course->load("section"));
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json([
            'status' => true,
            'message' => 'Course Deleted Successfully'
        ], 200);
    }
}
