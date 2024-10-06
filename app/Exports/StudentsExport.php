<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection , WithHeadings
{
    protected $classId;

    public function __construct($classId)
    {
        $this->classId = $classId;
    }

    public function collection()
    {
        // Fetch students for the given class ID
        return Student::where('class_id', $this->classId)->get(['class_id', 'name', 'email','created_at']);
    }

    public function headings(): array
    {
        return ['Class Room', 'Name', 'Email','Registerd On'];
    }
}
