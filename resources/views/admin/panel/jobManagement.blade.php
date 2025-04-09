@extends('admin.layouts.app')

@section('main')
<section class="admin-latest-jobs-section">
    <div class="admin-latest-jobs-container">
        <div class="admin-latest-jobs-header">
            <h2 class="admin-latest-jobs-title">Latest Job Openings</h2>
        </div>

        @include('front.alertMessage')
        <div class="admin-latest-jobs-filters">
            <form method="GET" action="{{ route('admin.jobManagement') }}" class="filter-form">
                <!-- Search Box -->
                <div class="admin-latest-jobs-search">
                    <i class="fas fa-search"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search jobs..." 
                           class="admin-latest-jobs-search-input">
                </div>
                
                <!-- Category Dropdown -->
                <select name="category" class="admin-latest-jobs-filter">
                    <option value="">Job Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>

                <select name="posted_by" class="admin-latest-jobs-filter">
                    <option value="">Posted By</option>
                    <option value="user" {{ request('posted_by') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="company" {{ request('posted_by') == 'company' ? 'selected' : '' }}>Company</option>
                </select>
                
                <!-- Status Dropdown -->
                <select name="status" class="admin-latest-jobs-filter">
                    <option value="">Select Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            
                <!-- Filter Button -->
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <div class="admin-job-listings-table-wrapper">
            @if($jobs->isEmpty())
                <div class="no-jobs-found">
                    <p>No jobs found matching your criteria.</p>
                </div>
            @else
                <table class="admin-job-listings-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Category</th>
                            <th>Posted By</th>
                            <th>Status</th>
                            <th>Posted Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ ($jobs->currentPage() - 1) * $jobs->perPage() + $loop->iteration }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->company_name }}</td>
                            <td>{{ $job->Category->category_name }}</td>
                            <td>
                                <span class="posted-by-badge posted-by-{{ $job->user_id ? 'user' : 'company' }}">
                                    {{ $job->user_id ? 'User' : 'Company' }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $job->status ? 'active' : 'inactive' }}">
                                    {{ $job->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $job->created_at->format('d M, Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.jobs.details', $job->id) }}" class="btn-view" title="View Job Details">
                                        <i class="fas fa-eye"></i>
                                        <span class="btn-text">View</span>
                                    </a>
                            
                                    <!-- Status Toggle Form -->
                                    <form action="{{ route('admin.jobs.toggleStatus', $job->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="status-toggle-btn {{ $job->status ? 'inactive' : 'active' }}" title="Toggle Status">
                                            <i class="fas fa-{{ $job->status ? 'times' : 'check' }}-circle status-icon"></i>
                                            <span class="status-text">{{ $job->status ? 'Inactive' : 'Active' }}</span>
                                        </button>
                                    </form>
                            
                                   <!-- Delete Button -->
                                   <button class="btn-delete" onclick="openDeleteModal({{ $job->id }})">
                                        <i class="fas fa-trash"></i>
                                        <span class="btn-text">Delete</span>
                                    </button>

                                    
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <div class="pagination-container">
                @if ($jobs->hasPages())
                    <nav class="pagination-nav">
                        {{-- Previous Page Link --}}
                        @if ($jobs->onFirstPage())
                            <span class="pagination-link disabled" aria-disabled="true">
                                <span>Previous</span>
                            </span>
                        @else
                            <a class="pagination-link" href="{{ $jobs->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}" rel="prev">
                                <span>Previous</span>
                            </a>
                        @endif
            
                        {{-- Pagination Elements --}}
                        @foreach ($jobs->links()->elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span class="pagination-link dots" aria-disabled="true">
                                    <span>{{ $element }}</span>
                                </span>
                            @endif
            
                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $jobs->currentPage())
                                        <span class="pagination-link active" aria-current="page">
                                            <span>{{ $page }}</span>
                                        </span>
                                    @else
                                        <a class="pagination-link" href="{{ $url }}&{{ http_build_query(request()->except('page')) }}">
                                            <span>{{ $page }}</span>
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
            
                        {{-- Next Page Link --}}
                        @if ($jobs->hasMorePages())
                            <a class="pagination-link" href="{{ $jobs->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}" rel="next">
                                <span>Next</span>
                            </a>
                        @else
                            <span class="pagination-link disabled" aria-disabled="true">
                                <span>Next</span>
                            </span>
                        @endif
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <!-- Icon at the Top -->
        <div class="modal-icon">
            <i class="fas fa-exclamation-triangle"></i> <!-- Font Awesome Icon -->
        </div>

        <h3>Are you sure delete this job?</h3>
        <p>This action cannot be undone.</p>

        <form id="deleteForm" method="POST">
            @csrf
            <input type="hidden" name="job_id" id="jobId">
            <button type="submit" class="popup-btn-confirm">Yes, Delete</button>
            <button type="button" class="popup-btn-cancel" onclick="closeDeleteModal()">No, Cancel</button>
        </form>
    </div>
</div>

</section>
@endsection

@section('customCss')
<style>
    .status-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-active {
    background-color: #d1fae5;
    color: #065f46;
}

.status-inactive {
    background-color: #fee2e2;
    color: #991b1b;
}

.status-toggle-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.status-toggle-btn.active {
    background-color: #d1fae5;
    color: #065f46;
}

.status-toggle-btn.inactive {
    background-color: #fee2e2;
    color: #991b1b;
}

.status-toggle-btn:hover {
    opacity: 0.8;
}
.posted-by-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.posted-by-user {
    background-color: #e0f2fe;
    color: #0369a1;
}

.posted-by-company {
    background-color: #fef3c7;
    color: #92400e;
}


</style>
    
@endsection

@section('customJs')
<script>
    function openDeleteModal(jobId) {
        document.getElementById("deleteModal").style.display = "flex";
        document.getElementById("deleteForm").action = "/admin/jobs/delete/" + jobId;
    }

    function closeDeleteModal() {
        document.getElementById("deleteModal").style.display = "none";
    }
</script>


@endsection