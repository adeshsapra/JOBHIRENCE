@extends('front.layouts.app')

@section('main')
<div class="jobs-applied-container">
    <div class="jobs-applied-header">
        <h1>Applied Jobs</h1>
    </div>
    @include('front.alertMessage')
    <table class="jobs-applied-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Applied Date</th>
                <th>Applicants</th>
                <th>Job Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appliedJobs as $application)
                <tr>
                    <td>
                        {{ $application->job->title ?? 'N/A' }}<br>
                        <strong>{{ $application->job->location ?? 'N/A' }}</strong>
                    </td>
                    <td>{{ $application->job->category->category_name ?? 'N/A' }}</td>
                    <td>{{ $application->applied_date->format('d M, Y') }}</td>
                    <td>{{ $application->job->applicants_count->count() }} applicants</td>
                    <td>{{ $application->job->jobType->type_name ?? 'N/A' }}</td>
                    <td>
                        <span style="color: #28a745; font-weight: bold;">Active</span>
                    </td>
                    <td>
                        <div class="jobs-applied-actions">
                            <button onclick="toggleAppliedDropdown(event)">
                                 <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                             </button>                        
                             <div class="jobs-applied-dropdown">
                                <a href="{{ route('jobDetail',$application->job_id) }}" class="jobApplied-view-btn"><i class="fas fa-eye"></i> View</a>
                                <button type="button" onclick="openConfirmationModal('{{ route('account.cancelAppliedJob', $application->id) }}')" class="jobApplied-cancel-btn">
                                    <i class="fas fa-trash"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No jobs applied yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-container">
        @if ($appliedJobs->hasPages())
            <nav class="pagination-nav">
                {{-- Previous Button --}}
                @if ($appliedJobs->onFirstPage())
                    <span class="pagination-link disabled">Previous</span>
                @else
                    <a href="{{ $appliedJobs->previousPageUrl() }}" class="pagination-link">Previous</a>
                @endif
    
                {{-- Page Numbers --}}
                @foreach ($appliedJobs->links()->elements as $element)
                    {{-- Separator for "..." --}}
                    @if (is_string($element))
                        <span class="pagination-link dots">{{ $element }}</span>
                    @endif
    
                    {{-- Array of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $appliedJobs->currentPage())
                                <span class="pagination-link active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
    
                {{-- Next Button --}}
                @if ($appliedJobs->hasMorePages())
                    <a href="{{ $appliedJobs->nextPageUrl() }}" class="pagination-link">Next</a>
                @else
                    <span class="pagination-link disabled">Next</span>
                @endif
            </nav>
        @endif
    </div>

</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="modal hidden">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <h2>Are you sure?</h2>
        <p>Do you really want to cancel applied job.?</p>
        <div class="modal-actions">
            <button id="modalCancelBtn" class="btn-secondary">No</button>
            <form id="confirmDeleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-primary">Yes, Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('customCss')
<style>
    /* Modal styles */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .modal.show {
        visibility: visible;
        opacity: 1;
    }

    .modal-content {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
        text-align: center;
        width: 400px;
        animation: scaleUp 0.3s ease-out;
    }

    .modal-icon {
        font-size: 60px;
        color: #e53935;
        margin-bottom: 10px;
        animation: bounce 0.8s infinite alternate;
    }

    .modal h2 {
        font-size: 24px;
        margin-bottom: 10px;
        font-weight: 700;
        color: var(--primary-color);
        text-transform: capitalize

    }

    .modal p {
        margin-bottom: 20px;
        font-weight: 600;
        color: #666;
        text-transform: capitalize

    }

    .modal-actions {
        display: flex;
        justify-content: space-around;
        gap: 10px;
    }

    .btn-primary {
        background: #e53935;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background: #c62828;
    }

    .btn-secondary {
        background: #ddd;
        color: #333;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background: #bbb;
    }

    /* Animations */
    @keyframes scaleUp {
        from {
            transform: scale(0.8);
        }
        to {
            transform: scale(1);
        }
    }

    @keyframes bounce {
        from {
            transform: translateY(0);
        }
        to {
            transform: translateY(-10px);
        }
    }
</style>
@endsection

@section('customJs')
<script> 
    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.jobs-applied-dropdown');
        dropdowns.forEach(function(dropdown) {
            const button = dropdown.previousElementSibling;
            const isClickInside = dropdown.contains(event.target) || button.contains(event.target);
            if (!isClickInside) {
                dropdown.style.display = 'none';
            }
        });
    });
    
    // Toggle dropdown visibility on button click (for jobs applied actions)
    function toggleAppliedDropdown(event) {
        const dropdown = event.target.closest('.jobs-applied-actions').querySelector('.jobs-applied-dropdown');
        const isVisible = dropdown.style.display === 'block';
    
        // Hide all dropdowns first
        document.querySelectorAll('.jobs-applied-dropdown').forEach(function(dropdown) {
            dropdown.style.display = 'none';
        });
    
        // Toggle the clicked dropdown visibility
        dropdown.style.display = isVisible ? 'none' : 'block';
    }
    
    const modal = document.getElementById('confirmationModal');
    const cancelBtn = document.getElementById('modalCancelBtn');
    const confirmDeleteForm = document.getElementById('confirmDeleteForm');

    function openConfirmationModal(actionUrl) {
        confirmDeleteForm.setAttribute('action', actionUrl); // Set the form action
        modal.classList.add('show'); // Show the modal
    }

    cancelBtn.addEventListener('click', function () {
        modal.classList.remove('show'); // Hide the modal
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.remove('show');
        }
    });

</script>
@endsection