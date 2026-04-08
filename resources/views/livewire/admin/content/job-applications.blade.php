<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Job Applications</h1>
            <p class="text-gray-500 text-sm mt-0.5">Review and manage employment applications.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-6">
            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Detail drawer --}}
    @if ($viewing)
        <div class="fixed inset-0 z-40 flex" x-data>
            <div class="absolute inset-0 bg-black/50" wire:click="closeView"></div>
            <div class="relative ml-auto w-full max-w-xl bg-white shadow-2xl flex flex-col h-full overflow-y-auto">
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-900">Application — {{ $viewing->full_name }}</h2>
                    <button wire:click="closeView" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 p-6 space-y-5">
                    {{-- Contact info --}}
                    <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-xl">
                        <div>
                            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Email</p>
                            <a href="mailto:{{ $viewing->email }}" class="text-sm text-accent-600 hover:underline break-all">{{ $viewing->email }}</a>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Phone</p>
                            <a href="tel:{{ $viewing->phone }}" class="text-sm text-gray-900">{{ $viewing->phone }}</a>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Position</p>
                            <p class="text-sm text-gray-900 font-medium">{{ $viewing->position_applied }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Experience</p>
                            <p class="text-sm text-gray-900">{{ $viewing->experience_years }} years</p>
                        </div>
                        @if ($viewing->linkedin_url)
                            <div class="col-span-2">
                                <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">LinkedIn</p>
                                <a href="{{ $viewing->linkedin_url }}" target="_blank" rel="noopener" class="text-sm text-accent-600 hover:underline break-all">{{ $viewing->linkedin_url }}</a>
                            </div>
                        @endif
                        <div class="col-span-2">
                            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Submitted</p>
                            <p class="text-sm text-gray-900">{{ $viewing->created_at->format('D, d M Y \a\t g:i A') }}</p>
                        </div>
                    </div>

                    {{-- CV download --}}
                    @if ($viewing->cv_path)
                        <div>
                            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-2">CV / Resume</p>
                            <a href="{{ Storage::url($viewing->cv_path) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
                                Download CV
                            </a>
                        </div>
                    @endif

                    {{-- Cover letter --}}
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-2">Cover Letter</p>
                        <div class="p-4 bg-gray-50 rounded-xl text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $viewing->cover_letter }}</div>
                    </div>

                    {{-- Status change --}}
                    <div>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-2">Update Status</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['new' => 'New', 'reviewed' => 'Reviewed', 'shortlisted' => 'Shortlisted', 'rejected' => 'Rejected'] as $value => $label)
                                <button
                                    wire:click="updateStatus({{ $viewing->id }}, '{{ $value }}')"
                                    class="px-4 py-1.5 rounded-lg text-sm font-semibold border-2 transition-all
                                        {{ $viewing->status === $value
                                            ? 'border-primary-600 bg-primary-600 text-white'
                                            : 'border-gray-200 text-gray-600 hover:border-primary-400' }}"
                                >
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Admin notes --}}
                    <div>
                        <label class="form-label">Internal Notes</label>
                        <textarea wire:model="adminNotes" rows="4" class="form-input text-sm" placeholder="Notes visible only to admins..."></textarea>
                        <button wire:click="saveNotes" class="btn btn-secondary btn-sm mt-2">Save Notes</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Filters --}}
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search by name, email, position..." class="form-input pl-9">
        </div>
        <select wire:model.live="filterStatus" class="form-select sm:w-48">
            <option value="">All Statuses</option>
            <option value="new">New</option>
            <option value="reviewed">Reviewed</option>
            <option value="shortlisted">Shortlisted</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="card overflow-hidden">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Applicant</th>
                    <th>Position</th>
                    <th>Experience</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($applications as $app)
                    <tr>
                        <td>
                            <p class="font-semibold text-gray-900">{{ $app->full_name }}</p>
                            <p class="text-xs text-gray-400">{{ $app->email }}</p>
                        </td>
                        <td class="text-gray-700">{{ $app->position_applied }}</td>
                        <td class="text-gray-500 text-sm">{{ $app->experience_years }} yrs</td>
                        <td>
                            <span class="{{ $app->status_badge_class }}">{{ ucfirst($app->status) }}</span>
                        </td>
                        <td class="text-gray-400 text-sm">{{ $app->created_at->format('d M Y') }}</td>
                        <td>
                            <button wire:click="view({{ $app->id }})" class="btn btn-ghost btn-sm">
                                View
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-12 text-gray-400">No applications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($applications->hasPages())
        <div class="mt-6">
            {{ $applications->links() }}
        </div>
    @endif
</div>
