@extends('company.layouts.app')

@section('main')
    
<div class="company-jobs-panel-content">
    <div class="company-jobs-panel-header">
        <h1 class="panel-heading">- Manage Job Postings -</h1>
        <p class="panel-description">Effortlessly view, edit, and manage all your job listings from one streamlined platform.</p>
    </div>

    <div class="company-job-list-container">
        <div class="company-job-list-header">
            <h1>Active Job Postings</h1>

            <!-- Add "Post a Job" button with the new class -->
            <a href="{{ route('company.postJob') }}"><button class="company-add-post-job-button" aria-label="Post a Job" id="post-job-button">Post a Job</button></a>
        </div>

        @include('front.alertMessage')
        
        <table class="company-job-list-table">
            <thead>
                <tr>
                    <th class="company-job-list-header-cell">No.</th>
                    <th class="company-job-list-header-cell">Title</th>
                    <th class="company-job-list-header-cell">Category</th>
                    <th class="company-job-list-header-cell">Posted Date</th>
                    <th class="company-job-list-header-cell">Applicants</th>
                    <th class="company-job-list-header-cell">Status</th>
                    <th class="company-job-list-header-cell">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobs as $key => $job)
                    <tr class="company-job-list-row">
                        <td class="company-job-list-cell">{{ $jobs->firstItem() + $key }}</td>
                        <td class="company-job-list-cell">
                            {{ $job->title }}<br>
                            <strong>{{ $job->jobType->type_name }}</strong>
                        </td>
                        <td  class="company-job-list-cell">{{ $job->category ? $job->category->category_name : 'N/A' }}</td>
                        <td>{{ $job->created_at->format('D-m-y') }}</td>
                        <td class="company-job-list-cell">{{ $job->applicants_count->count() }} Applications</td>
                        <td class="company-job-list-cell">
                            <span class="company-job-list-status">
                                @if ($job->status==1)
                                <span style="color: #28a745; font-weight: bold;">Active</span>
                                @else
                                <span style="color: rgb(197, 17, 17); font-weight: bold;">Closed</span>
                                @endif
                            </span>
                        </td>
                        <td class="company-job-list-cell">
                            <div class="company-job-list-actions">
                                <button class="company-job-list-action-button" aria-label="More options">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </button>
                                <div class="company-job-list-dropdown">
                                    <a href="{{ route('company.postJob', $job->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                        @if ($job->status == 1)
                                            <form action="{{ route('company.jobs.close', $job->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="company-jobs-reopen">
                                                    <i class="fas fa-times-circle"></i> Closed
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('company.jobs.reopen', $job->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="company-jobs-reopen">
                                                    <i class="fas fa-check-circle"></i> Reopen
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <a href="{{ route('company.viewJobDetail', $job->id) }}" class="btn btn-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>

                                        <form action="{{ route('company.deletePostJob', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="company-jobs-delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">No jobs found.</td>
                    </tr>
                @endforelse
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
</div>

@endsection