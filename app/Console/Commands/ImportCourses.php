<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Laiha;
use App\Models\Level;
use App\Models\Section;
use App\Models\Course;
use Carbon\Carbon;

class ImportCourses extends Command
{
    protected $signature = 'import:courses';
    protected $description = 'Import courses from Excel';

    public function handle()
    {
        $path = storage_path('app/full_schedule1.xlsx');

        if (!file_exists($path)) {
            $this->error('File not found!');
            return;
        }

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        unset($rows[0]);

        foreach ($rows as $row) {

            $laihaName     = trim($row[0]);
            $program       = trim($row[1]);
            $levelName     = trim($row[2]);
            $sectionName   = trim($row[3]);
            $time          = trim($row[4]);
            $day           = trim($row[5]);
            $date          = trim($row[6]);
            $courseName    = trim($row[7]);
            $courseCode    = trim($row[8]);
            $doctor        = $row[9] ? trim($row[9]) : null;
            $location      = $row[10] ? trim($row[10]) : null;

            $laiha = Laiha::firstOrCreate([
                'name' => $laihaName
            ]);

            $level = Level::firstOrCreate([
                'name' => $levelName,
                'laiha_id' => $laiha->id
            ], [
                'time' => $time
            ]);

            $section = Section::firstOrCreate([
                'name' => $sectionName,
                'level_id' => $level->id
            ]);

            Course::create([
                'section_id' => $section->id,
                'course_name' => $courseName,
                'course_code' => $courseCode,
                'day' => $day,
                'date' => Carbon::parse($date),
                'doctor' => $doctor,
                'location' => $location
            ]);
        }

        $this->info('Import completed successfully ✅');
    }
}