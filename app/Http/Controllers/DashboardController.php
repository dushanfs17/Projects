<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ContactForm;

class DashboardController extends Controller
{
    public function index()
    {
        $jobStats = DB::table('jobs')
            ->select(DB::raw('MONTH(published_at) as month'), DB::raw('count(*) as job_count'))
            ->whereBetween('published_at', [now()->subYear(), now()])
            ->groupBy(DB::raw('MONTH(published_at)'))
            ->orderBy(DB::raw('MONTH(published_at)'), 'asc')
            ->get();

        $messages = ContactForm::select('email', 'subject',  'is_read')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('jobStats', 'messages'));
    }
}
