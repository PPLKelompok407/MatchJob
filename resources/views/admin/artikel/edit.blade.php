@extends('layouts.admin')

@section('title', 'Edit Article')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Article</h1>
            <a href="{{ route('admin.artikel.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Articles
            </a>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @else border-gray-300 @enderror" 
                            id="judul" name="judul" value="{{ old('judul', $artikel->judul) }}" required>
                        @error('judul')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('category') border-red-500 @else border-gray-300 @enderror" 
                            id="category" name="category" required>
                            <option value="" disabled {{ old('category', $artikel->category) ? '' : 'selected' }}>Select a category</option>
                            <option value="tips" {{ old('category', $artikel->category) == 'tips' ? 'selected' : '' }}>Tips & Tricks</option>
                            <option value="event" {{ old('category', $artikel->category) == 'event' ? 'selected' : '' }}>Event</option>
                            <option value="berita" {{ old('category', $artikel->category) == 'berita' ? 'selected' : '' }}>Berita</option>
                            <option value="soft skill" {{ old('category', $artikel->category) == 'soft skill' ? 'selected' : '' }}>Soft Skill</option>
                            <option value="hard skill" {{ old('category', $artikel->category) == 'hard skill' ? 'selected' : '' }}>Hard Skill</option>
                            <option value="tutorial" {{ old('category', $artikel->category) == 'tutorial' ? 'selected' : '' }}>Tutorial</option>
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @else border-gray-300 @enderror" 
                            id="description" name="description" rows="5" required>{{ old('description', $artikel->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="link" class="block text-sm font-medium text-gray-700 mb-2">Link</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('link') border-red-500 @else border-gray-300 @enderror" 
                            id="link" name="link" value="{{ old('link', $artikel->link) }}" required>
                        @error('link')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        <input type="file" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @else border-gray-300 @enderror" 
                            id="image" name="image">
                        <p class="mt-1 text-sm text-gray-500">Allowed formats: JPEG, PNG, JPG, GIF (Max: 2MB). Leave empty to keep current image.</p>
                        
                        @if($artikel->image)
                            <div class="mt-4">
                                <p class="text-sm text-gray-700 mb-2">Current Image:</p>
                                <img src="{{ asset($artikel->image) }}" alt="{{ $artikel->judul }}" class="max-w-xs rounded-md shadow-sm">
                            </div>
                        @endif
                        
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i> Update Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 