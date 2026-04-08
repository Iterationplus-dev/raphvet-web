<div>
    {{-- Welcome header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-500 mt-1">Here's what's happening with your account.</p>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <span class="text-sm font-medium text-gray-500">My Pets</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $petsCount }}</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-sm font-medium text-gray-500">Upcoming Appts</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $upcomingAppointments }}</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <span class="text-sm font-medium text-gray-500">Orders Placed</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $ordersCount }}</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="text-sm font-medium text-gray-500">Next Appointment</span>
            </div>
            <p class="text-sm font-semibold text-gray-900">
                {{ $nextAppointment ? $nextAppointment->appointment_date->format('M d, Y') : '—' }}
            </p>
        </div>
    </div>

    {{-- Quick actions --}}
    <div class="mb-8">
        <h2 class="text-base font-semibold text-gray-900 mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('my.pets.create') }}" class="btn btn-secondary btn-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Pet
            </a>
            <a href="{{ route('appointments.book') }}" class="btn btn-secondary btn-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Book Appointment
            </a>
            <a href="{{ route('shop') }}" class="btn btn-secondary btn-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                Browse Shop
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Next appointment card --}}
        <div>
            <h2 class="text-base font-semibold text-gray-900 mb-4">Next Appointment</h2>
            @if($nextAppointment)
                <div class="bg-white rounded-xl border-2 border-green-200 p-5">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $nextAppointment->service?->name ?? 'Appointment' }}</p>
                            @if($nextAppointment->pet)
                                <p class="text-sm text-gray-500 mt-0.5">For {{ $nextAppointment->pet->name }}</p>
                            @endif
                        </div>
                        <span class="badge {{ $nextAppointment->status === 'confirmed' ? 'badge-green' : 'badge-yellow' }} capitalize">
                            {{ $nextAppointment->status }}
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $nextAppointment->appointment_date->format('l, F j, Y') }}
                        </div>
                        @if($nextAppointment->start_time)
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ \Carbon\Carbon::parse($nextAppointment->start_time)->format('g:i A') }}
                            </div>
                        @endif
                        @if($nextAppointment->vet)
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Dr. {{ $nextAppointment->vet->name }}
                            </div>
                        @endif
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('my.appointments.show', $nextAppointment->reference_number) }}" class="btn btn-secondary btn-sm">View Details</a>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-xl border border-gray-200 p-5 text-center">
                    <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-sm text-gray-500 mb-3">No upcoming appointments</p>
                    <a href="{{ route('appointments.book') }}" class="btn btn-primary btn-sm">Book Now</a>
                </div>
            @endif
        </div>

        {{-- Recent pets --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-semibold text-gray-900">My Pets</h2>
                <a href="{{ route('my.pets') }}" class="text-sm text-green-700 hover:text-green-900 font-medium">View all</a>
            </div>
            @if($recentPets->isEmpty())
                <div class="bg-white rounded-xl border border-gray-200 p-5 text-center">
                    <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    <p class="text-sm text-gray-500 mb-3">No pets added yet</p>
                    <a href="{{ route('my.pets.create') }}" class="btn btn-primary btn-sm">Add a Pet</a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($recentPets as $pet)
                        <a href="{{ route('my.pets.show', $pet) }}" class="bg-white rounded-xl border border-gray-200 p-4 flex items-center gap-4 hover:border-green-300 transition-colors">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $pet->name }}</p>
                                <p class="text-sm text-gray-500 capitalize">{{ $pet->species }}{{ $pet->breed ? ' · '.$pet->breed : '' }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Recent orders --}}
    @if($recentOrders->isNotEmpty())
        <div class="mt-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-semibold text-gray-900">Recent Orders</h2>
                <a href="{{ route('my.orders') }}" class="text-sm text-green-700 hover:text-green-900 font-medium">View all</a>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Reference</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3 hidden sm:table-cell">Date</th>
                            <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Total</th>
                            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide px-5 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($recentOrders as $order)
                            <tr>
                                <td class="px-5 py-3">
                                    <span class="font-mono text-sm font-medium text-gray-900">{{ $order->reference_number }}</span>
                                </td>
                                <td class="px-5 py-3 text-sm text-gray-500 hidden sm:table-cell">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-5 py-3 text-right text-sm font-semibold text-gray-900">
                                    ₦{{ number_format((float) $order->total_amount, 2) }}
                                </td>
                                <td class="px-5 py-3 text-center">
                                    <span class="badge {{ match($order->status) { 'pending' => 'badge-yellow', 'processing' => 'badge-blue', 'shipped' => 'badge-purple', 'delivered' => 'badge-green', 'cancelled' => 'badge-red', default => 'badge-gray' } }} capitalize">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
