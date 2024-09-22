<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportPost(Request $request)
    {

        $reports = Report::create([
            'title' => $request->title,
            'date' => $request->date,
            'time_from' => $request->timeFrom,
            'time_to' => $request->timeTo,
            'description' => $request->description,
            'challenges' => $request->challenges,
            'todo' => $request->todo,
        ]);

        if(!$reports)
        {
            return view('dailyreport',['message'=>"Data not submitted"]);
        }

        return redirect('/list');

    }
}
