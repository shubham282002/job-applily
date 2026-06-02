@extends('layouts.app')

@section('title', 'Description Master')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Description Master</h2>
            <p class="text-gray-600 mt-2">Manage email description templates</p>
        </div>
        <a href="/masters/descriptions/create" class="bg-blue-600 hover:bg-blue-700 text-white font-600 px-6 py-3 rounded-lg transition">
            + Create Description
        </a>
    </div>

    <!-- Success Message -->
    @if($message = Session::get('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ $message }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-600 text-gray-700 uppercase">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-600 text-gray-700 uppercase">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-600 text-gray-700 uppercase">Description</th>
                        <th class="px-6 py-4 text-left text-xs font-600 text-gray-700 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($descriptions as $description)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-600">
                                    {{ $description->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-500 text-gray-900">{{ $description->title }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-600 text-sm truncate">{{ substr($description->content, 0, 50) }}...</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="/masters/descriptions/{{ $description->id }}/edit" class="bg-yellow-50 hover:bg-yellow-100 text-yellow-700 px-3 py-2 rounded text-sm font-600 transition">
                                        Edit
                                    </a>
                                    <form action="/masters/descriptions/{{ $description->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-700 px-3 py-2 rounded text-sm font-600 transition" onclick="return confirm('Delete this?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center">
                                <p class="text-gray-500">No descriptions found</p>
                                <a href="/masters/description/create" class="text-blue-600 hover:text-blue-700 text-sm font-600 mt-2 inline-block">
                                    Create first description →
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $descriptions->links() }}
    </div>

</div>

@endsection
