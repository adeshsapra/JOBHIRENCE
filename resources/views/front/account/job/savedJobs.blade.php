@extends('front.layouts.app')

@section('main')
<div class="savejob-container">
    <div class="savejob-header">
        <h1>Saved Jobs</h1>
    </div>

    @include('front.alertMessage')

    <table class="savejob-table">
        <thead>
            <tr>
                <th class="savejob-table-header">Title</th>
                <th class="savejob-table-header">Category</th>
                <th class="savejob-table-header">Applicants</th>
                <th class="savejob-table-header">Status</th>
                <th class="savejob-table-header">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($savedJobs as $savedJob)
                <tr class="savejob-table-row">
                    <td class="savejob-table-cell">
                        {{ $savedJob->job->title }}<br>
                        <strong>{{ $savedJob->job->jobType->type_name }}, {{ $savedJob->job->location ?? 'N/A' }}</strong>
                    </td>
                    <td class="savejob-table-cell">{{ $savedJob->job->category->category_name }}</td>
                    <td class="savejob-table-cell">{{ $savedJob->job->applicants_count->count() }} Applicants</td>
                    <td class="savejob-table-cell">
                        <span style="color: #28a745; font-weight: bold;">Active</span>
                    </td>
                    <td class="savejob-table-cell">
                        <div class="savejob-actions">
                            <button aria-label="More options" class="saveJob-button">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </button>
                            <div class="savejob-dropdown">
                                <a href="{{ route('jobDetail', $savedJob->job->id) }}" class="saveJob-view-button"><i class="fas fa-eye"></i> View</a>
                                <button type="button" onclick="openConfirmationModal('{{ route('account.removeSavedJob', $savedJob->job->id) }}')" class="saveJob-remove-button">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container">
        @if ($savedJobs->hasPages())
            <nav class="pagination-nav">
                {{-- Previous Button --}}
                @if ($savedJobs->onFirstPage())
                    <span class="pagination-link disabled">Previous</span>
                @else
                    <a href="{{ $savedJobs->previousPageUrl() }}" class="pagination-link">Previous</a>
                @endif
    
                {{-- Page Numbers --}}
                @foreach ($savedJobs->links()->elements as $element)
                    {{-- Separator for "..." --}}
                    @if (is_string($element))
                        <span class="pagination-link dots">{{ $element }}</span>
                    @endif
    
                    {{-- Array of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $savedJobs->currentPage())
                                <span class="pagination-link active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
    
                {{-- Next Button --}}
                @if ($savedJobs->hasMorePages())
                    <a href="{{ $savedJobs->nextPageUrl() }}" class="pagination-link">Next</a>
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
        <p>Do you really want to Remove this job?</p>
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
    document.addEventListener("DOMContentLoaded", function () {
       const actionButtons = document.querySelectorAll('.savejob-actions button');
       
       actionButtons.forEach(button => {
           button.addEventListener('click', function(event) {
               const dropdown = button.nextElementSibling;
               dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
               event.stopPropagation();
           });
       });
   
       document.addEventListener('click', function(event) {
           const dropdowns = document.querySelectorAll('.savejob-dropdown');
           dropdowns.forEach(dropdown => {
               if (!dropdown.contains(event.target) && !event.target.closest('.savejob-actions')) {
                   dropdown.style.display = 'none';
               }
           });
       });
   });

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
