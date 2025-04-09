@extends('admin.layouts.app')

@section('main')
<section class="admin-three-part-categories-section">
    <div class="admin-three-part-categories-container">
        @include('front.alertMessage')
        <div class="admin-three-part-categories-header">
            <h2 class="admin-three-part-categories-title">Job Categories</h2>
            <label for="category-modal-toggle" class="admin-three-part-categories-btn">
                <i class="fas fa-plus"></i> Add Category
            </label>
        </div>
        
        <div class="admin-three-part-categories-table-wrapper">
            <table class="admin-three-part-categories-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Job Listings</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="admin-three-part-categories-list">
                    @foreach($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>Explore {{ rand(100, 500) }}+ jobs</td>
                            <td>{{ $category->created_at ? $category->created_at->format('m/d/Y') : 'N/A' }}</td>
                            <td>
                                <span class="admin-three-part-categories-status-badge {{ $category->status ? 'status-active' : 'status-inactive' }}">
                                    {{ $category->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="admin-three-part-categories-action-buttons">
                                    <form action="{{ route('admin.toggleCategoryStatus', $category->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="status-toggle-btn {{ $category->status ? 'inactive' : 'active' }}">
                                            <i class="fas {{ $category->status ? 'fa-times-circle' : 'fa-check-circle' }} status-icon"></i>
                                            <span class="status-text">{{ $category->status ? 'Inactive' : 'Active' }}</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Category Modal -->
    <input type="checkbox" id="category-modal-toggle" class="modal-toggle" hidden>
    <div class="modal">
        <div class="modal-content">
            <label for="category-modal-toggle" class="close">&times;</label>
            <h2>Add New Category</h2>
            <form action="{{ route('admin.addCategory') }}" method="POST" class="admin-three-part-category-form">
                @csrf <!-- CSRF token for security -->
                <div class="form-group">
                    <label for="category-name">Category Name</label>
                    <input type="text" id="category-name" name="category_name" required>
                </div>
                <button type="submit" class="admin-three-part-categories-btn">Save Category</button>
            </form>
        </div>
    </div>
</section>

<!-- Job Types Section -->
<section class="admin-three-part-categories-section">
    <div class="admin-three-part-categories-container">
    <div class="admin-three-part-job-types-header">
    <h2 class="admin-three-part-job-types-title">Job Types</h2>
    <label for="job-type-modal-toggle" class="admin-three-part-categories-btn">
        <i class="fas fa-plus"></i> Add Job Type
    </label>
    </div>

    <div class="admin-three-part-job-types-table-wrapper">
    <table class="admin-three-part-job-types-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Job Type Name</th>
                <th>Job Listings</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="admin-three-part-job-types-list">
            @foreach($jobTypes as $index => $jobType)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jobType->type_name }}</td>
                    <td>Explore {{ rand(10, 100) }}+ jobs</td> <!-- Example dynamic job count -->
                    <td>{{ $jobType->created_at ? $jobType->created_at->format('m/d/Y') : 'N/A' }}</td>
                    <td>
                        <span class="admin-three-part-categories-status-badge {{ $jobType->status ? 'status-active' : 'status-inactive' }}">
                            {{ $jobType->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="admin-three-part-categories-action-buttons">
                            <form action="{{ route('admin.toggleJobTypeStatus', $jobType->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="status-toggle-btn {{ $jobType->status ? 'inactive' : 'active' }}">
                                    <i class="fas {{ $jobType->status ? 'fa-times-circle' : 'fa-check-circle' }} status-icon"></i>
                                    <span class="status-text">{{ $jobType->status ? 'Inactive' : 'Active' }}</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>

   <!-- Add Job Type Modal -->
    <input type="checkbox" id="job-type-modal-toggle" class="modal-toggle" hidden>
    <div class="modal">
        <div class="modal-content">
            <label for="job-type-modal-toggle" class="close">×</label>
            <h2>Add New Job Type</h2>
            <form action="{{ route('admin.addJobType') }}" method="POST" class="admin-three-part-category-form">
                @csrf <!-- CSRF token for security -->
                <div class="form-group">
                    <label for="job-type-name">Job Type Name</label>
                    <input type="text" id="job-type-name" name="type_name" required>
                </div>
                <button type="submit" class="admin-three-part-categories-btn">Save Job Type</button>
            </form>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section class="admin-three-part-categories-section">
<div class="admin-three-part-categories-container">
<div class="admin-three-part-experience-header">
<h2 class="admin-three-part-experience-title">Experience Levels</h2>
<label for="experience-modal-toggle" class="admin-three-part-categories-btn">
    <i class="fas fa-plus"></i> Add Experience Level
</label>
</div>

<div class="admin-three-part-experience-table-wrapper">
<table class="admin-three-part-experience-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Experience Level Name</th>
            <th>Job Listings</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="admin-three-part-experience-list">
        @foreach($experiences as $index => $experience)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $experience->experience }} Years</td>
                <td>Explore {{ rand(10, 100) }}+ jobs</td> <!-- Example dynamic job count -->
                <td>{{ $experience->created_at ? \Carbon\Carbon::parse($experience->created_at)->format('m/d/Y') : 'N/A' }}</td>
                <td>
                    <span class="admin-three-part-categories-status-badge {{ $experience->status ? 'status-active' : 'status-inactive' }}">
                        {{ $experience->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="admin-three-part-categories-action-buttons">
                        <form action="{{ route('admin.toggleExperienceStatus', $experience->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="status-toggle-btn {{ $experience->status ? 'inactive' : 'active' }}">
                                <i class="fas {{ $experience->status ? 'fa-times-circle' : 'fa-check-circle' }} status-icon"></i>
                                <span class="status-text">{{ $experience->status ? 'Inactive' : 'Active' }}</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

<!-- Add Experience Modal -->
<input type="checkbox" id="experience-modal-toggle" class="modal-toggle" hidden>
<div class="modal">
    <div class="modal-content">
        <label for="experience-modal-toggle" class="close">×</label>
        <h2>Add New Experience Level</h2>
        <form action="{{ route('admin.addExperience') }}" method="POST" class="admin-three-part-category-form">
            @csrf <!-- CSRF token for security -->
            <div class="form-group">
                <label for="experience-name">Experience Level</label>
                <input type="text" id="experience-name" name="experience_name" required placeholder="0-2 Years">
            </div>
            <button type="submit" class="admin-three-part-categories-btn">Save Experience Level</button>
        </form>
    </div>
</div>
@endsection