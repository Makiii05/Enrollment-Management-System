<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StudentPortalStatusController extends Controller
{
    /**
     * Get the current student portal status.
     */
    public function status()
    {
        return response()->json([
            'status' => Status::getStudentPortalStatus(),
            'is_on' => Status::isStudentPortalOn(),
        ]);
    }

    /**
     * Toggle the student portal status.
     */
    public function toggle()
    {
        $newStatus = Status::toggleStudentPortalStatus();

        return response()->json([
            'status' => $newStatus,
            'is_on' => $newStatus === 'on',
            'message' => 'Student portal status updated to ' . $newStatus,
        ]);
    }
}
