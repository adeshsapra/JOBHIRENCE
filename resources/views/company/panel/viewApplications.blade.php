@extends('company.layouts.app')

@section('main')
<div class="company-panel-menu-header">
    <h1 class="company-panel-menu-heading">- Applicants for {{ $job->title }} -</h1>
</div>

<div class="company-applications-container">
    @include('front.alertMessage')

    <table class="company-applications-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Candidate</th>
                <th>Email</th>
                <th>Date</th>
                <th>Job</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applicants as $key => $applicant)
                <tr>
                    <td class="company-job-list-cell">{{ $loop->iteration }}</td>
                    <td>{{ $applicant->user->fullName }}</td>
                    <td>{{ $applicant->user->email }}</td>
                    <td>{{ $applicant->created_at->format('Y-m-d') }}</td>
                    <td>{{ $job->title }}</td>
                    <td><span class="status-pill status-{{ strtolower($applicant->status) }}">{{ ucfirst($applicant->status) }}</span></td>
                    <td>
                        <div class="company-applications-action-menu">
                            <a href="{{ route('company.viewUserProfile', $applicant->user->id) }}" class="company-applications-action-button">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="pending">
                                <button type="submit" class="company-applications-action-button"><i class="fas fa-clock"></i> Pending</button>
                            </form>
                            <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="company-applications-action-button"><i class="fas fa-check"></i> Accept</button>
                            </form>
                            <form action="{{ route('company.applications.updateStatus', $applicant->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="company-applications-action-button"><i class="fas fa-times"></i> Reject</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No applicants found for this job.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-container">
        @if ($applicants->hasPages())
            <nav class="pagination-nav">
                {{-- Previous Button --}}
                @if ($applicants->onFirstPage())
                    <span class="pagination-link disabled">Previous</span>
                @else
                    <a href="{{ $applicants->previousPageUrl() }}" class="pagination-link">Previous</a>
                @endif
    
                {{-- Page Numbers --}}
                @foreach ($applicants->links()->elements as $element)
                    {{-- Separator for "..." --}}
                    @if (is_string($element))
                        <span class="pagination-link dots">{{ $element }}</span>
                    @endif
    
                    {{-- Array of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $applicants->currentPage())
                                <span class="pagination-link active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
    
                {{-- Next Button --}}
                @if ($applicants->hasMorePages())
                    <a href="{{ $applicants->nextPageUrl() }}" class="pagination-link">Next</a>
                @else
                    <span class="pagination-link disabled">Next</span>
                @endif
            </nav>
        @endif
    </div>
</div>
@endsection