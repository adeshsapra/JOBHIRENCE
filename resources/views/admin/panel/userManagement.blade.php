@extends('admin.layouts.app')

@section('main')
<!-- User Management Section HTML -->
<section class="admin-user-management-section">
    <div class="admin-user-management-container">
        <div class="admin-user-management-header">
            <h2 class="admin-user-management-title">User Management</h2>
            
            <div class="admin-user-management-filters">
                <form action="{{ route('admin.user.manage') }}" method="GET" class="filter-form">
                    <div class="admin-user-search">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="Search users..." class="admin-user-search-input" value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

        @include('front.alertMessage')
        <div class="admin-user-listings-table-wrapper">
            @if($users->isEmpty())
                <div class="no-jobs-found">
                    <p>No Users found..!!</p>
                </div>
            @else
                <table class="admin-user-listings-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Registered Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                            <td>{{ $user->fullName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>+91 {{ $user->mobile_number ?? 'N/A' }}</td>
                            <td>{{ $user->created_at->format('d-M-Y') }}</td>
                            <td>
                                <div class="admin-user-manage-action-buttons">
                                        <a href="{{ route('admin.user.view', $user->id) }}" class="admin-user-manage-btn-view" title="View User Details">
                                            <i class="fas fa-eye"></i>
                                            <span class="admin-user-manage-btn-text">View</span>
                                        </a>
                                    <button class="admin-user-manage-btn-delete" onclick="openDeleteUserModal({{ $user->id }})" title="Delete User">
                                        <i class="fas fa-trash"></i>
                                        <span class="admin-user-manage-btn-text">Delete</span>
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
            @if ($users->hasPages())
                <nav class="pagination-nav">
                    {{-- Previous Button --}}
                    @if ($users->onFirstPage())
                        <span class="pagination-link disabled">Previous</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="pagination-link">Previous</a>
                    @endif
        
                    {{-- Page Numbers --}}
                    @foreach ($users->links()->elements as $element)
                        {{-- Separator for "..." --}}
                        @if (is_string($element))
                            <span class="pagination-link dots">{{ $element }}</span>
                        @endif
        
                        {{-- Array of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $users->currentPage())
                                    <span class="pagination-link active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
        
                    {{-- Next Button --}}
                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="pagination-link">Next</a>
                    @else
                        <span class="pagination-link disabled">Next</span>
                    @endif
                </nav>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteUserModal" class="modal-overlay">
        <div class="modal-content">
            <!-- Icon at the Top -->
            <div class="modal-icon">
                <i class="fas fa-exclamation-triangle"></i> <!-- Font Awesome Icon -->
            </div>

            <h3>Are you sure you want to delete this user?</h3>
            <p>This action cannot be undone.</p>

            <form id="deleteUserForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" id="userId">
                <button type="submit" class="popup-btn-confirm">Yes, Delete</button>
                <button type="button" class="popup-btn-cancel" onclick="closeDeleteUserModal()">No, Cancel</button>
            </form>
        </div>
    </div>
</section>
@endsection


@section('customJs')
<script>
    function openDeleteUserModal(userId) {
        document.getElementById("deleteUserModal").style.display = "flex";
        document.getElementById("deleteUserForm").action = "/admin/users/delete/" + userId;
        document.getElementById("userId").value = userId;
    }

    function closeDeleteUserModal() {
        document.getElementById("deleteUserModal").style.display = "none";
    }
</script>
@endsection