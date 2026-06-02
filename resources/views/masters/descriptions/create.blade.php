@extends('layouts.app')

@section('title', 'Create Description Master')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="mb-8">
        <a href="/masters/descriptions" class="text-blue-600 hover:text-blue-700 text-sm font-600 mb-4 inline-block">
            ← Back to Descriptions
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Create Description Master</h2>
        <p class="text-gray-600 mt-2">Add a new description template</p>
    </div>

    <!-- Form -->
    <form action="/masters/descriptions" method="POST" class="bg-white rounded-xl border border-gray-100 p-8 space-y-6">
        @csrf

        <!-- Type -->
        <div>
            <label class="block text-sm font-600 text-gray-900 mb-2">Type</label>
            <input
                type="text"
                name="type"
                placeholder="e.g., Job Application, Follow-up, Internship"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                value="{{ old('type') }}"
                required
            >
            @error('type')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-600 text-gray-900 mb-2">Title</label>
            <input
                type="text"
                name="title"
                placeholder="e.g., Senior Software Engineer Application"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                value="{{ old('title') }}"
                required
            >
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div>
            <label class="block text-sm font-600 text-gray-900 mb-2">Content</label>
            <textarea
                name="content"
                rows="6"
                placeholder="Enter the description template here..."
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                required
            >{{ old('content') }}</textarea>
            <p class="text-sm text-gray-500 mt-2">You can use placeholders like {name}, {position}, {company}</p>
            @error('content')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <a href="/masters/description" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-900 font-600 hover:bg-gray-50 transition">
                Cancel
            </a>
            <button
                type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-600 rounded-lg transition"
            >
                Create Description
            </button>
        </div>

    </form>

</div>

@endsection
