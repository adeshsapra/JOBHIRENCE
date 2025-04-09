@extends('company.layouts.app')

@section('main')
<div class="company-panel-menu-header">
    <h1 class="company-panel-menu-heading">- Applications Management -</h1>
    <p class="company-panel-menu-description">Effortlessly track, review, and manage all your applications from one streamlined platform.</p>
</div>

<div class="company-applications-container">
    <form id="filter-form" action="{{ route('company.applications') }}" method="GET" class="company-applications-filter-bar">
        <label for="company-applications-filter-job">Job Title:</label>
        <select id="company-applications-filter-job" name="job_title">
            <option value="all" {{ request('job_title') == 'all' ? 'selected' : '' }}>All Jobs</option>
            @foreach($jobTitles as $title)
                <option value="{{ $title }}" {{ request('job_title') == $title ? 'selected' : '' }}>
                    {{ $title }}
                </option>
            @endforeach
        </select>
        
        <label for="company-applications-filter-status">Status:</label>
        <select id="company-applications-filter-status" name="status">
            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
            @foreach($statuses as $status)
                <option value="{{ strtolower($status) }}" {{ request('status') == strtolower($status) ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
        <button type="submit" id="apply-filters">Apply Filters</button>
    </form>

    <table class="company-applications-table">
        <!-- Table header remains the same -->
        <thead>
            <tr>
                <th>No.</th>
                <th>Job Title</th>
                <th>Category</th>
                <th>Total Applicants</th>
                <th>Posted Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($jobs->isEmpty())
                <tr id="no-data-message">
                    <td colspan="6" class="text-center py-4">No matching jobs found</td>
                </tr>
            @else
                @foreach($jobs as $key => $job)
                <tr>
                    <td class="company-job-list-cell">{{ $jobs->firstItem() + $key }}</td>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->category->category_name }}</td>
                    <td>{{ $job->applicants_count->count() }} Applicants</td>
                    <td>{{ $job->created_at->format('D-m-y') }}</td>
                    <td>
                        <span class="company-jobs-status-pill company-jobs-status-{{ strtolower($job->status ? 'active' : 'closed') }}">
                            {{ $job->status ? 'Active' : 'Closed' }}
                        </span>
                    </td>
                    <td>
                        <div class="company-jobs-action-menu">
                            <a href="{{ route('company.viewApplications', $job->id) }}" class="company-jobs-action-button">View Applicants</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="pagination-container">
        @if ($jobs->hasPages())
            <nav class="pagination-nav">
                {{-- Previous Button --}}
                @if ($jobs->onFirstPage())
                    <span class="pagination-link disabled">Previous</span>
                @else
                    <a href="{{ $jobs->previousPageUrl() }}" class="pagination-link">Previous</a>
                @endif
    
                {{-- Page Numbers --}}
                @foreach ($jobs->links()->elements as $element)
                    {{-- Separator for "..." --}}
                    @if (is_string($element))
                        <span class="pagination-link dots">{{ $element }}</span>
                    @endif
    
                    {{-- Array of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $jobs->currentPage())
                                <span class="pagination-link active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
    
                {{-- Next Button --}}
                @if ($jobs->hasMorePages())
                    <a href="{{ $jobs->nextPageUrl() }}" class="pagination-link">Next</a>
                @else
                    <span class="pagination-link disabled">Next</span>
                @endif
            </nav>
        @endif
    </div>

</div>
@endsection

@section('customJs')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Action menu functionality
    const actionButtons = document.querySelectorAll('.company-jobs-action-button');
    actionButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdown = button.nextElementSibling;
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', () => {
        document.querySelectorAll('.company-jobs-dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    });
});
</script>
@endsection