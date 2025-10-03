<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicReport;
class PublicReportController extends Controller
{
    public function index()
    {
        $reports = PublicReport::all();
        return view('public_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('public_reports.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'nullable|string|max:2048',
        ]);

        $report = new PublicReport();
        $report->title = $request->title;
        $report->content = $request->content;
        $report->created_by = auth()->id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public_reports', 'public');
            $report->image_path = $path;
        }

        $report->save();

        return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');
    }
}
