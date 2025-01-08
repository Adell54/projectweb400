@extends('layouts.master')

@section('content')
<x-app-layout>
    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Purchase History</h2>
                @php
                    // Dummy purchase data
                    $purchases = [
                        ['id' => 101, 'date' => '2025-01-01', 'total' => 29.99],
                        ['id' => 102, 'date' => '2025-01-05', 'total' => 49.99],
                        ['id' => 103, 'date' => '2025-01-08', 'total' => 15.50],
                    ];
                @endphp

                @if(empty($purchases))
                    <p>You have not made any purchases yet.</p>
                @else
                    <ul class="space-y-4">
                        @foreach($purchases as $purchase)
                            <li class="p-4 bg-gray-100 rounded-lg">
                                <strong>Order #{{ $purchase['id'] }}</strong> - {{ \Carbon\Carbon::parse($purchase['date'])->format('M d, Y') }}<br>
                                <span>Total: ${{ number_format($purchase['total'], 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
