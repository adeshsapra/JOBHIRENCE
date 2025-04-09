{{-- resources/views/admin/panel/jobApplicants.blade.php --}}
@extends('admin.layouts.app')

@section('main')
<div class="admin-application-manage-container">
    <div class="admin-application-manage-header">
        <h2>Applications For {{ $job->title }}</h2>
    </div>

    <!-- Applicants Table -->
    <div class="admin-application-manage-user-section">
        <table class="admin-application-manage-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Candidate</th>
                    <th>Date</th>
                    <th>Job</th>
                    <th>City</th>
                    <th>Designation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applicants as $applicant)
                <tr>
                    <td>{{ ($applicants->currentPage() - 1) * $applicants->perPage() + $loop->iteration }}</td>
                    <td>{{ $applicant->user->fullName }}</td>
                    <td>{{ $applicant->created_at->format('M d, Y') }}</td>
                    <td>{{ $job->title }}</td>
                    <td>{{ $applicant->user->details->city ?? 'N/A' }}</td>
                    <td>{{ $applicant->user->designation ?? 'N/A' }}</td>
                </tr>
                @endforeach

                @if($applicants->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">No applicants found for this job.</td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- Pagination Links -->
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
</div>
@endsection