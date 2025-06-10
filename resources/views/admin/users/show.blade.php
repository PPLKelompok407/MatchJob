@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">User Details</h1>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Users
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Personal Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                    <h2 class="text-lg font-semibold">Personal Information</h2>
                </div>
                <div class="p-6">
                    <dl>
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">ID</dt>
                            <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->id }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->name }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->email }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->notelp ?? 'Not provided' }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Gender</dt>
                            <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->jenis_kelamin ?? 'Not provided' }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Birth Info</dt>
                            <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->tempat_tanggal_lahir ?? 'Not provided' }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4 py-3">
                            <dt class="text-sm font-medium text-gray-500">Address</dt>
                            <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->alamat ?? 'Not provided' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            
            <div class="space-y-6">
                <!-- Education & Work History -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                        <h2 class="text-lg font-semibold">Education & Work History</h2>
                    </div>
                    <div class="p-6">
                        <dl>
                            <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Education</dt>
                                <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->riwayat_pendidikan ?? 'Not provided' }}</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-4 py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Work History</dt>
                                <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->riwayat_kerja ?? 'Not provided' }}</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-4 py-3">
                                <dt class="text-sm font-medium text-gray-500">Job Placement</dt>
                                <dd class="text-sm font-medium text-gray-900 col-span-2">{{ $user->penempatan_kerja ?? 'Not specified' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                
                <!-- Test Status -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                        <h2 class="text-lg font-semibold">Test Status</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="{{ $user->test_mikat ? 'bg-green-500' : 'bg-red-500' }} rounded-lg shadow text-white p-4 text-center">
                                <h3 class="font-semibold text-lg mb-1">MIKAT Test</h3>
                                <p>{{ $user->test_mikat ? 'Completed' : 'Not Completed' }}</p>
                            </div>
                            <div class="{{ $user->test_sosec ? 'bg-green-500' : 'bg-red-500' }} rounded-lg shadow text-white p-4 text-center">
                                <h3 class="font-semibold text-lg mb-1">SoSec Test</h3>
                                <p>{{ $user->test_sosec ? 'Completed' : 'Not Completed' }}</p>
                            </div>
                        </div>
                        
                        @if($user->dokumen_pdf_path)
                            <div class="mt-4">
                                <a href="{{ asset('storage/' . $user->dokumen_pdf_path) }}" 
                                   class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded flex items-center justify-center" 
                                   target="_blank">
                                    <i class="fas fa-file-pdf mr-2"></i> View Document
                                </a>
                            </div>
                        @else
                            <div class="mt-4 bg-blue-50 text-blue-700 p-4 rounded">
                                No documents uploaded.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 