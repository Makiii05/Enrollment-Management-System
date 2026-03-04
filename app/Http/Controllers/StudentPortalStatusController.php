<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Deactivate all student accounts.
     */
    public function deactivateAllAccounts(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = auth()->user();
        
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password.',
            ], 401);
        }

        $count = StudentAccount::where('account_status', 'on')->update(['account_status' => 'off']);

        return response()->json([
            'success' => true,
            'message' => "Successfully deactivated {$count} student accounts.",
            'count' => $count,
        ]);
    }

    /**
     * Toggle a single student account status.
     */
    public function toggleAccountStatus($id)
    {
        $account = StudentAccount::findOrFail($id);
        $newStatus = $account->account_status === 'on' ? 'off' : 'on';
        $account->update(['account_status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => "Account status updated to {$newStatus}.",
        ]);
    }

    /**
     * Generate examination permit for a student account.
     */
    public function generateExaminationPermit($accountId)
    {
        $account = StudentAccount::findOrFail($accountId);
        
        // Generate a unique permit code
        $permit = 'EP-' . strtoupper(uniqid()) . '-' . date('Ymd');
        
        $account->update(['examination_permit' => $permit]);

        return response()->json([
            'success' => true,
            'permit' => $permit,
            'message' => 'Examination permit generated successfully.',
        ]);
    }

    /**
     * Clear examination permit for a student account.
     */
    public function clearExaminationPermit($accountId)
    {
        $account = StudentAccount::findOrFail($accountId);
        
        $account->update(['examination_permit' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Examination permit cleared successfully.',
        ]);
    }
}
