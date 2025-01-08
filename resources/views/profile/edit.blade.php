@extends('layouts.master')

@section('content')
<x-app-layout>
    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-6">
                <!-- Sidebar Navigation -->
                <div class="w-full lg:w-1/4 bg-gray-100 p-4 rounded-lg">
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('profile.edit') }}" 
                               class="block p-2 rounded-lg hover:bg-gray-200 {{ request()->routeIs('profile.edit') ? 'bg-gray-300 font-bold' : '' }}">
                                <i class="fas fa-user"></i> Profile Information
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.history') }}" 
   class="block p-2 rounded-lg hover:bg-gray-200 {{ request()->routeIs('profile.history') ? 'bg-gray-300 font-bold' : '' }}">
    <i class="fas fa-history"></i> Purchase History
</a>
                        </li>
                    </ul>
                </div>

                <!-- Main Profile Content -->
                <div class="w-full lg:w-3/4 space-y-6">
                    <div class="p-4 sm:p-8 ">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 ">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 ">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
