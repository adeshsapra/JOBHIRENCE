@extends('admin.layouts.app')

@section('main')
    <div class="admin-application-manage-container">
        <div class="admin-application-manage-header">
            <h2>Applications Management</h2>
        </div>

        <!-- User Applications Section -->
        <div class="admin-application-manage-user-section">
            <h3 class="admin-application-manage-section-title">User Side Applications</h3>
            <table class="admin-application-manage-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Job Title</th>
                        <th>Total Applicants</th>
                        <th>Posted Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userJobs as $job)
                    <tr>
                        <td>{{ ($userJobs->currentPage() - 1) * $userJobs->perPage() + $loop->iteration }}</td>
                        <td>{{ $job->title }}</td>
                        <td><span class="admin-application-manage-applicant-count">{{ $job->applicants_count->count() }}</span></td>
                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                        <td>
                            <span class="admin-application-manage-status {{ $job->status ? 'admin-application-manage-status-active' : 'admin-application-manage-status-closed' }}">
                                {{ $job->status ? 'Active' : 'Closed' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.applications.view', $job->id) }}" class="admin-application-manage-view-btn">
                                View Applicants
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

             <!-- for user Pagination Links -->
            <div class="pagination-container">
                @if ($userJobs->hasPages())
                    <nav class="pagination-nav">
                        {{-- Previous Button --}}
                        @if ($userJobs->onFirstPage())
                            <span class="pagination-link disabled">Previous</span>
                        @else
                            <a href="{{ $userJobs->previousPageUrl() }}" class="pagination-link">Previous</a>
                        @endif
            
                        {{-- Page Numbers --}}
                        @foreach ($userJobs->links()->elements as $element)
                            {{-- Separator for "..." --}}
                            @if (is_string($element))
                                <span class="pagination-link dots">{{ $element }}</span>
                            @endif
            
                            {{-- Array of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $userJobs->currentPage())
                                        <span class="pagination-link active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
            
                        {{-- Next Button --}}
                        @if ($userJobs->hasMorePages())
                            <a href="{{ $userJobs->nextPageUrl() }}" class="pagination-link">Next</a>
                        @else
                            <span class="pagination-link disabled">Next</span>
                        @endif
                    </nav>
                @endif
            </div>
            
        </div>

        <!-- Company Applications Section -->
        <div class="admin-application-manage-company-section">
            <h3 class="admin-application-manage-section-title">Company Side Applications</h3>
            <table class="admin-application-manage-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Job Title</th>
                        <th>Total Applicants</th>
                        <th>Posted Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companyJobs as $job)
                    <tr>
                        <td>{{ ($companyJobs->currentPage() - 1) * $companyJobs->perPage() + $loop->iteration }}</td>
                        <td>{{ $job->title }}</td>
                        <td><span class="admin-application-manage-applicant-count">{{ $job->applicants_count->count() }}</span></td>
                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                        <td>
                            <span class="admin-application-manage-status {{ $job->status ? 'admin-application-manage-status-active' : 'admin-application-manage-status-closed' }}">
                                {{ $job->status ? 'Active' : 'Closed' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.applications.view', $job->id) }}" class="admin-application-manage-view-btn">
                                View Applicants
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- for companie Pagination Links -->
            <div class="pagination-container">
                @if ($companyJobs->hasPages())
                    <nav class="pagination-nav">
                        {{-- Previous Button --}}
                        @if ($companyJobs->onFirstPage())
                            <span class="pagination-link disabled">Previous</span>
                        @else
                            <a href="{{ $companyJobs->previousPageUrl() }}" class="pagination-link">Previous</a>
                        @endif
            
                        {{-- Page Numbers --}}
                        @foreach ($companyJobs->links()->elements as $element)
                            {{-- Separator for "..." --}}
                            @if (is_string($element))
                                <span class="pagination-link dots">{{ $element }}</span>
                            @endif
            
                            {{-- Array of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $companyJobs->currentPage())
                                        <span class="pagination-link active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
            
                        {{-- Next Button --}}
                        @if ($companyJobs->hasMorePages())
                            <a href="{{ $companyJobs->nextPageUrl() }}" class="pagination-link">Next</a>
                        @else
                            <span class="pagination-link disabled">Next</span>
                        @endif
                    </nav>
                @endif
            </div>

        </div>
    </div>
@endsection