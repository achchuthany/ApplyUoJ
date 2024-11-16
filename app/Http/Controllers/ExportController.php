<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Enroll;
use App\Models\Programme;
use App\Models\Student;
use App\Models\StudentDoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    public function index()
    {
        $academic_years = AcademicYear::orderBy('name','desc')->get();
        $programmes = Programme::orderBy('name','desc')->get();
        $enroll_status = config('app.enroll_status');

       return view('student.export',['academic_years'=>$academic_years,"programmes"=>$programmes,"enroll_status"=>$enroll_status]);
    }
    public function export(Request $request): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $csvFileName = 'students_' . Carbon::now()->format('Y_m_d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];
        $query = Enroll::leftJoin('students', 'students.id', '=', 'enrolls.student_id')
            ->leftJoin('programmes', 'programmes.id', '=', 'enrolls.programme_id')
            ->select($request->input('columns', ['students.last_name', 'students.full_name']));

        $selectColumns = $request->input('columns', ['students.last_name', 'students.full_name']);

        if (!empty($selectColumns)) {
            $query->orderBy($selectColumns[0], 'asc');
        }
        if ($request->filled('academic_year_id')) {
            $query->whereIn('enrolls.academic_year_id', $request->input('academic_year_id'));
        }
        if ($request->filled('programme_id')) {
            $query->whereIn('enrolls.programme_id', $request->input('programme_id'));
        }
        if ($request->filled('status')) {
            $query->whereIn('enrolls.status', $request->input('status'));
        }
        return Response::stream(function() use ($query, $selectColumns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $selectColumns);
            $query->chunk(1000, function($students) use ($handle, $selectColumns) {
                foreach ($students as $student) {
                    $row = array_map(function ($column) use ($student) {
                        return trim(strtoupper($student->{explode('.', $column)[1]}));
                    }, $selectColumns);

                    if (array_filter($row)) {
                        fputcsv($handle, $row);
                    }
                }
            });
            fclose($handle);
        }, 200, $headers);
    }

    public function exportProfileImage(Request $request)
    {
        //validate request
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'programme_id' => 'required|exists:programmes,id',
            'type' => 'required'
        ]);
        $names = StudentDoc::select('name')->leftJoin('enrolls', 'enrolls.student_id', '=', 'student_docs.student_id')
            ->where('student_docs.type', $request->input('type'))
            ->where('enrolls.programme_id', $request->input('programme_id'))
            ->where('enrolls.academic_year_id', $request->input('academic_year_id'))
            ->where('enrolls.status', 'Registered')
            ->get()->pluck('name')->toArray();

        Storage::disk('downloads')->makeDirectory('temp');
        $zip_file=storage_path('app/downloads/temp/profile_images.zip');

        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        if ($zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            foreach ($names as $name) {
                $filePath = Storage::disk('docs')->path($name);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($filePath));
                }
            }
            $zip->close();
        }
        //check if the zip file was created
        if (!file_exists($zip_file)) {
            return back()->with(['error'=>'Error: Could not create zip file, please try again'])->withInput();
        }

        $headers = array('Content-Type'=>'application/octet-stream',);
        $zip_new_name = "docs-".date("y-m-d-h-i-s").".zip";
        return response()->download($zip_file,$zip_new_name,$headers)->deleteFileAfterSend(true);
    }
}
