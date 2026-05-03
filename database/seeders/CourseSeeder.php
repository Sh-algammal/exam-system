<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Laiha;
use App\Models\Level;
use App\Models\Section;
use App\Models\Course;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $path = storage_path('app/full_schedule1.xlsx');

        $spreadsheet = IOFactory::load($path);
        $rows = $spreadsheet->getActiveSheet()->toArray();

        unset($rows[0]);

        foreach ($rows as $row) {

            $laiha = Laiha::firstOrCreate(['name' => $row[0]]);

            $level = Level::firstOrCreate([
                'name' => $row[2],
                'laiha_id' => $laiha->id
            ], [
                'time' => $row[4]
            ]);

            $section = Section::firstOrCreate([
                'name' => $row[3],
                'level_id' => $level->id
            ]);

            Course::create([
                'section_id' => $section->id,
                'course_name' => $row[7],
                'course_code' => $row[8],
                'day' => $row[5],
                'date' => Carbon::parse($row[6]),
                'doctor' => $row[9] ?? null,
                'location' => $row[10] ?? null,
            ]);
        }
    }
}