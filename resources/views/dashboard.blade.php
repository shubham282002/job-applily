@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Welcome Section -->
        <div class="mb-10">
            <h2 class="text-4xl font-bold text-gray-900 mb-2">
                Welcome back, {{ auth()->user()->name }}! 👋
            </h2>
            <p class="text-gray-600">Track your email campaigns and manage templates from here.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <!-- Templates Stat -->
            <div class="stat-card bg-white rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-xl">
                        📧
                    </div>
                    <span class="text-xs font-600 text-green-600 bg-green-50 px-3 py-1 rounded-full">
                        +0%
                    </span>
                </div>
                <p class="text-gray-600 text-sm font-500 mb-1">Email Templates</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalTemplates }}</p>
                <p class="text-xs text-gray-500 mt-3">Active templates</p>
            </div>

            <!-- Emails Sent Stat -->
            <div class="stat-card bg-white rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 text-xl">
                        ✉️
                    </div>
                    <span class="text-xs font-600 text-green-600 bg-green-50 px-3 py-1 rounded-full">
                        Today
                    </span>
                </div>
                <p class="text-gray-600 text-sm font-500 mb-1">Emails Sent</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalEmailsSent }}</p>
                <p class="text-xs text-gray-500 mt-3">This month</p>
            </div>

            <!-- Resumes Stat -->
            <div class="stat-card bg-white rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 text-xl">
                        📄
                    </div>
                    <span class="text-xs font-600 text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                        Ready
                    </span>
                </div>
                <p class="text-gray-600 text-sm font-500 mb-1">Resumes Uploaded</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalResumes }}</p>
                <p class="text-xs text-gray-500 mt-3">Available</p>
            </div>

            <!-- Success Rate Stat -->
            <div class="stat-card bg-white rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600 text-xl">
                        📊
                    </div>
                    <span class="text-xs font-600 text-orange-600 bg-orange-50 px-3 py-1 rounded-full">
                        High
                    </span>
                </div>
                <p class="text-gray-600 text-sm font-500 mb-1">Success Rate</p>
                <p class="text-3xl font-bold text-gray-900">
                    @if($totalEmailsSent > 0)
                        {{ round(($totalEmailsSent - $recentEmails->where('status', 'failed')->count()) / $totalEmailsSent * 100) }}%
                    @else
                        0%
                    @endif
                </p>
                <p class="text-xs text-gray-500 mt-3">All time</p>
            </div>

        </div>

        <!-- Main Actions Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

            <!-- Create Template Card -->
            <div class="lg:col-span-1 bg-white rounded-xl border border-gray-100 p-8 hover:border-blue-300 transition">
                <div class="w-16 h-16 rounded-lg bg-blue-100 flex items-center justify-center text-2xl mb-4">
                    ✨
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Create Template</h3>
                <p class="text-gray-600 text-sm mb-6">Design professional email templates tailored for HR recruitment</p>
                <a href="/templates/create" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-600 px-6 py-2 rounded-lg transition">
                    Create New
                </a>
            </div>

            <!-- Send Email Card -->
            <div class="lg:col-span-1 bg-white rounded-xl border border-gray-100 p-8 hover:border-green-300 transition">
                <div class="w-16 h-16 rounded-lg bg-green-100 flex items-center justify-center text-2xl mb-4">
                    🚀
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Send Email</h3>
                <p class="text-gray-600 text-sm mb-6">Select a template and send it directly to HR recruiters</p>
                <a href="/templates" class="inline-block bg-green-600 hover:bg-green-700 text-white font-600 px-6 py-2 rounded-lg transition">
                    Send Now
                </a>
            </div>

            <!-- Manage Resumes Card -->
            <div class="lg:col-span-1 bg-white rounded-xl border border-gray-100 p-8 hover:border-purple-300 transition">
                <div class="w-16 h-16 rounded-lg bg-purple-100 flex items-center justify-center text-2xl mb-4">
                    📁
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Manage Resumes</h3>
                <p class="text-gray-600 text-sm mb-6">Upload and organize your resumes for email attachments</p>
                <button class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-600 px-6 py-2 rounded-lg transition">
                    Manage Files
                </button>
            </div>

        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Recent Activity</h3>
                        <p class="text-sm text-gray-600 mt-1">Latest emails sent and their delivery status</p>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-600">
                        View All →
                    </a>
                </div>
            </div>

            @if($recentEmails->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-8 py-4 text-left text-xs font-600 text-gray-700 uppercase tracking-wider">To</th>
                                <th class="px-8 py-4 text-left text-xs font-600 text-gray-700 uppercase tracking-wider">Subject</th>
                                <th class="px-8 py-4 text-left text-xs font-600 text-gray-700 uppercase tracking-wider">Sent At</th>
                                <th class="px-8 py-4 text-left text-xs font-600 text-gray-700 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentEmails as $email)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    <td class="px-8 py-4">
                                        <p class="font-500 text-gray-900 text-sm">{{ $email->hr_email }}</p>
                                    </td>
                                    <td class="px-8 py-4">
                                        <p class="text-gray-600 text-sm">{{ $email->subject }}</p>
                                    </td>
                                    <td class="px-8 py-4">
                                        <p class="text-gray-600 text-sm">
                                            {{ $email->sent_at->format('M d, Y h:i A') }}
                                        </p>
                                    </td>
                                    <td class="px-8 py-4">
                                        @if($email->status === 'sent')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-600 bg-green-50 text-green-700">
                                                ✓ Sent
                                            </span>
                                        @elseif($email->status === 'failed')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-600 bg-red-50 text-red-700">
                                                ✗ Failed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-600 bg-yellow-50 text-yellow-700">
                                                ⏳ Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-8 py-16 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        📭
                    </div>
                    <p class="text-gray-600 font-500">No activity yet</p>
                    <p class="text-gray-500 text-sm mt-1">Create a template and send your first email!</p>
                </div>
            @endif
        </div>

        <!-- Footer Stats -->
        <div class="mt-10 pt-6 border-t border-gray-200">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalTemplates }}</p>
                    <p class="text-sm text-gray-600">Templates Created</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalEmailsSent }}</p>
                    <p class="text-sm text-gray-600">Emails Sent</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalResumes }}</p>
                    <p class="text-sm text-gray-600">Resumes Uploaded</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">∞</p>
                    <p class="text-sm text-gray-600">Send Unlimited</p>
                </div>
            </div>
        </div>

    </div>
@endsection
