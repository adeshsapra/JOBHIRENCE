@extends('admin.layouts.app')

@section('main')
<section class="admin-employer-management-section">
    <div class="admin-employer-management-container">
        <div class="admin-employer-management-header">
            <h2 class="admin-employer-management-title">Employer Management</h2>
            
            <div class="admin-employer-management-filters">
                <form action="{{ route('admin.CompanyManage') }}" method="GET" class="filter-form">
                    <div class="admin-employer-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search companies..." name="search" class="admin-employer-search-input" value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

        @include('front.alertMessage')
        <div class="admin-employer-listings-table-wrapper">
            @if($companies->isEmpty())
                <div class="no-jobs-found">
                    <p>No Companies found..!!</p>
                </div>
            @else
                <table class="admin-employer-listings-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Industry</th>
                            <th>City</th>
                            <th>Registered Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <td>{{ ($companies->currentPage() - 1) * $companies->perPage() + $loop->iteration }}</td>
                            <td>{{ $company->c_name }}</td>
                            <td>{{ $company->c_email }}</td>
                            <td>{{ $company->c_industry }}</td>
                            <td>{{ $company->c_city }}</td>
                            <td>{{ $company->created_at->format('d-M-Y') }}</td>
                            <td>
                                <div class="admin-employer-manage-action-buttons">
                                    <a href="{{ route('admin.details', ['id' => $company->id]) }}" class="admin-employer-manage-btn-view" title="View User Details">
                                        <i class="fas fa-eye"></i>
                                        <span class="admin-user-manage-btn-text">View</span>
                                    </a>
                                    <button class="admin-employer-manage-btn-delete" onclick="openDeleteCompanyModal({{ $company->id }})" title="Delete Company">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Pagination Links -->
        <div class="pagination-container">
            @if ($companies->hasPages())
                <nav class="pagination-nav">
                    {{-- Previous Button --}}
                    @if ($companies->onFirstPage())
                        <span class="pagination-link disabled">Previous</span>
                    @else
                        <a href="{{ $companies->previousPageUrl() }}" class="pagination-link">Previous</a>
                    @endif
        
                    {{-- Page Numbers --}}
                    @foreach ($companies->links()->elements as $element)
                        {{-- Separator for "..." --}}
                        @if (is_string($element))
                            <span class="pagination-link dots">{{ $element }}</span>
                        @endif
        
                        {{-- Array of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $companies->currentPage())
                                    <span class="pagination-link active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
        
                    {{-- Next Button --}}
                    @if ($companies->hasMorePages())
                        <a href="{{ $companies->nextPageUrl() }}" class="pagination-link">Next</a>
                    @else
                        <span class="pagination-link disabled">Next</span>
                    @endif
                </nav>
            @endif
        </div>

    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteCompanyModal" class="modal-overlay">
        <div class="modal-content">
            <!-- Icon at the Top -->
            <div class="modal-icon">
                <i class="fas fa-exclamation-triangle"></i> <!-- Font Awesome Icon -->
            </div>

            <h3>Are you sure you want to delete this company?</h3>
            <p>This action cannot be undone.</p>

            <form id="deleteCompanyForm" method="POST">
                @csrf
                <input type="hidden" name="company_id" id="companyId">
                <button type="submit" class="popup-btn-confirm">Yes, Delete</button>
                <button type="button" class="popup-btn-cancel" onclick="closeDeleteCompanyModal()">No, Cancel</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('customCss')
<style>
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        max-width: 500px;
        width: 90%;
        position: relative;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .modal-icon {
        font-size: 40px;
        color: #f87171;
        margin-bottom: 20px;
    }

    .popup-btn-confirm {
        background-color: #f87171;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        margin-right: 10px;
        transition: background-color 0.3s;
    }

    .popup-btn-confirm:hover {
        background-color: #ef4444;
    }

    .popup-btn-cancel {
        background-color: #e5e7eb;
        color: #374151;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .popup-btn-cancel:hover {
        background-color: #d1d5db;
    }
</style>
@endsection

@section('customJs')
<script>
    function openDeleteCompanyModal(companyId) {
        document.getElementById("deleteCompanyModal").style.display = "flex";
        document.getElementById("deleteCompanyForm").action = "/admin/companies/delete/" + companyId;
        document.getElementById("companyId").value = companyId;
    }

    function closeDeleteCompanyModal() {
        document.getElementById("deleteCompanyModal").style.display = "none";
    }
</script>
@endsection