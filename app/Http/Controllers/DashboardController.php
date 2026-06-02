<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\SentEmail;
use App\Models\Resume;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get stats
        $totalTemplates = EmailTemplate::where('user_id', $user->id)->count();
        $totalEmailsSent = SentEmail::where('user_id', $user->id)->count();
        $totalResumes = Resume::where('user_id', $user->id)->count();

        // Get recent emails sent
        $recentEmails = SentEmail::where('user_id', $user->id)
            ->orderBy('sent_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'user',
            'totalTemplates',
            'totalEmailsSent',
            'totalResumes',
            'recentEmails'
        ));
    }
}
