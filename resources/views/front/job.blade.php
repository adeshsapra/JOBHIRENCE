@extends('front.layouts.app')

@section('main')
    
<div class="job-main-container">
    <!-- Sidebar Filters -->
    <aside class="job-main-sidebar">
        <form id="job-filter-form" method="GET" action="{{ route('job') }}">
            <h2 class="sidebar-title">Find Your Dream Job</h2>
            <div class="filter-section">
                <label for="filter-keywords" class="filter-label">
                    <i class="fas fa-keyboard"></i> Keywords
                </label>
                <input type="text" id="filter-keywords" name="keywords" class="filter-input"
                    value="{{ request('keywords') }}" placeholder="e.g. Developer, Designer">
            </div>

            <div class="filter-section">
                <label for="filter-location" class="filter-label">
                    <i class="fas fa-map-marker-alt"></i> Location
                </label>
                <input type="text" id="filter-location" name="location" class="filter-input"
                    value="{{ request('location') }}" placeholder="e.g. New York, Remote">
            </div>

            <div class="filter-section">
                <label for="filter-category" class="filter-label">
                    <i class="fas fa-briefcase"></i> Category
                </label>
                <select id="filter-category" name="category" class="filter-select">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-section">
                <label class="filter-label">
                    <i class="fas fa-clock"></i> Job Type
                </label>
                @foreach ($jobTypes as $jobType)
                    <label>
                        <input type="checkbox" name="job_types[]" value="{{ $jobType->id }}"
                            {{ in_array($jobType->id, request('job_types', [])) ? 'checked' : '' }}>
                        {{ $jobType->type_name }}
                    </label><br>
                @endforeach
            </div>

            <div class="filter-section">
                <label for="filter-experience" class="filter-label">
                    <i class="fas fa-calendar-alt"></i> Experience
                </label>
                <select id="filter-experience" name="experience" class="filter-select">
                    <option value="">Any</option>
                    <option value="0-1" {{ request('experience') == '0-1' ? 'selected' : '' }}>0-1 years</option>
                    <option value="1-3" {{ request('experience') == '1-3' ? 'selected' : '' }}>1-3 years</option>
                    <option value="3+" {{ request('experience') == '3+' ? 'selected' : '' }}>3+ years</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="sidebar-buttons">
                <button type="submit" id="btn-search" class="btn btn-search">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('job') }}" id="btn-reset" class="btn btn-reset">
                    <i class="fas fa-sync-alt"></i> Reset
                </a>
            </div>
        </form>
    </aside>


    <!-- Recommended Jobs Section -->
    <section class="recommended-jobs">
        <div class="recommended-title">
            <h2>Recommended Jobs</h2>
        </div>
        <div class="job-grid">
            @forelse ($jobs as $job)
                <div class="job-item">
                    <div class="job-header">
                        <div class="job-title">{{ $job->title }}</div>
                    </div>
                    <div class="job-info-container">
                        <div class="job-company"><i class="fas fa-building"></i> {{ $job->company_name }}</div>
                        <div class="job-location"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</div>

                        {{-- <div class="job-salary"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $job->salary ?  $job->salary . '/year' : 'Not Specified' }}</div> --}}

                        <div class="job-type"> <i class="fas fa-briefcase"></i> {{ $job->jobType->type_name }}</div>
                        <div class="job-posted">Posted {{ $job->created_at->diffForHumans() }}</div>
                    </div>
                    <a href="{{ route('jobDetail', $job->id) }}" class="job-section-apply">View Details</a>
                </div>
            @empty
                <p>No jobs found at the moment. Please check back later.</p>
            @endforelse
        </div>
        
        
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
        
    </section>
</div>
@endsection

@section('customCss')
<style>
    
</style>
@endsection
