@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Total Users Card -->
            <div class="bg-blue-500 rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-white text-lg font-semibold">Total Users</h2>
                        <p class="text-white text-3xl font-bold">{{ $totalUsers }}</p>
                    </div>
                    <div class="text-white">
                        <i class="fas fa-users text-4xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- MIKAT Test Card -->
            <div class="bg-green-500 rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-white text-lg font-semibold">Completed MIKAT Test</h2>
                        <p class="text-white text-3xl font-bold">{{ $completedMikatTest }}</p>
                    </div>
                    <div class="text-white">
                        <i class="fas fa-tasks text-4xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- SoSec Test Card -->
            <div class="bg-yellow-500 rounded-lg shadow-md overflow-hidden">
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-white text-lg font-semibold">Completed SoSec Test</h2>
                        <p class="text-white text-3xl font-bold">{{ $completedTestSosec }}</p>
                    </div>
                    <div class="text-white">
                        <i class="fas fa-code text-4xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold">Quick Links</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.users.index') }}" class="flex items-center justify-center bg-white text-blue-500 border border-blue-500 hover:bg-blue-50 font-medium py-3 px-4 rounded-md transition duration-200">
                        <i class="fas fa-users mr-2"></i> Manage Users
                    </a>
                    <a href="{{ route('admin.artikel.index') }}" class="flex items-center justify-center bg-white text-green-500 border border-green-500 hover:bg-green-50 font-medium py-3 px-4 rounded-md transition duration-200">
                        <i class="fas fa-newspaper mr-2"></i> Manage Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection 