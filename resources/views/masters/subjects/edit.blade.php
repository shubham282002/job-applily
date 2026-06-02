@extends('layouts.app')

@section('title', 'Edit Subject Master')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="mb-8">
        <a href="/masters/subjects" class="text-blue-600 hover:text-blue-700 text-sm font-600 mb-4 inline-block">
            ← Back to Subjects
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Edit Subject Master</h2>
    </div>

    <!-- Form -->
    <form action="/masters/subjects/{{ $subject->id }}" method="POST" class="bg-white rounded-xl border border-gray-100 p-8 space-y-6">
        @csrf
        @method('PUT')

        <!-- Category -->
        <div>
            <label class="block text-sm font-600 text-gray-900 mb-2">Category</label>
            <input
                type="text"
                name="category"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                value="{{ $subject->category }}"
                required
            >
            @error('category')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-600 text-gray-900 mb-2">Title</label>
            <input
                type="text"
                name="title"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                value="{{ $subject->title }}"
                required
            >
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-600 text-gray-900 mb-2">Subject Line Template</label>
            <textarea
                name="description"
                rows="6"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                required
            >{{ $subject->description }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <a href="/masters/subjects" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-900 font-600 hover:bg-gray-50 transition">
                Cancel
            </a>
            <button
                type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-600 rounded-lg transition"
            >
                Update Subject
            </button>
        </div>

    </form>

</div>

@endsection
