<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // View Report
    public function reportView()
    {
        return view('backend.report.view_report');
    }
}
