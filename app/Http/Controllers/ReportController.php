<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportPost(Request $request)
    {
        $validate_date = $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'time_from' => 'required',
            'time_to' => 'required',
            'description' => 'required',
            'challenges' => 'required',
            'todo' => 'required',
        ]);

        $reports = Report::create($validate_date);

        if (!$reports) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Data not submitted'
                ]);
            } else {
                return view('dailyreport', ['message' => "Data not submitted"]);
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data submitted',
                'report' => $reports
            ]);
        } else {
            return redirect('/list');
        }
    }

    public function reportGet(Request $request)
    {
        $reports = Report::get();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'reports' => $reports
            ]);
        } else {
            return view('profile', ['reports' => $reports]);
        }
    }
}
