@extends('front.layouts.app')

@section('main')
<div class="myjobs-container">
    <div class="myjobs-header">
        <h1>My Job Listings</h1>
        <a href="{{ route('account.showPostJob') }}" class="post-job">Post a Job</a>
    </div>
    @include('front.alertMessage')
    <table class="myjobs-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Job Created</th>
                <th>Applicants</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($jobs->isNotEmpty())
                @foreach ($jobs as $job)
                <tr>
                    <td>
                       <div class="job-title-name">{{ $job->title }}</div>
                       <div class="job-info-type">{{ $job->jobType->type_name }}</span>, {{ $job->location }}</span></div>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</td>
                    <td>{{ $job->applicants_count->count() }} Applicants</td>
                    <td>
                        @if ($job->status==1)
                            <span style="color: #28a745; font-weight: bold;">Active</span>
                        @else
                            <span style="color: rgb(197, 17, 17); font-weight: bold;">Block</span>
                        @endif
                    </td>
                    <td>
                        <div class="myjobs-actions">
                            <button onclick="toggleDropdown(event)"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                            <div class="myjobs-dropdown">
                                <a href="{{ route('account.viewPostJob', $job->id) }}"><i class="fas fa-eye"></i> View</a>
                                <a href="{{ route('account.showEditJob', $job->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                <a href="{{ route('account.showEditJob', $job->id) }}" class="delete-job" data-id="{{ $job->id }}" data-action="{{ route('account.deleteJob', $job->id) }}">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
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
<!-- Confirmation Pop-Up -->
<div id="confirm-popup" class="confirm-popup">
    <div class="popup-content">
        <div class="icon-container">
            <i class="fas fa-exclamation-circle confirm-icon"></i>
        </div>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this job?</p>
        <div class="popup-actions">
            <button id="confirm-no" class="btn-no">No</button>
            <button id="confirm-yes" class="btn-yes">Yes, Delete</button>
        </div>
    </div>
</div>
@endsection

@section('customCss')
<style>
    /* Pop-Up Styles */
    .confirm-popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.3s ease-in-out;
    }

    .popup-content {
        background: #fff;
        padding: 30px;
        width: 400px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        animation: slideDown 0.4s ease-in-out;
        position: relative;
    }

    .icon-container {
        margin-bottom: 20px;
        animation: bounce 1s infinite;
    }

    .confirm-icon {
        font-size: 50px;
        color: #e53935;
    }

    .popup-content h2 {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .popup-content p {
        font-size: 16px;
        margin-bottom: 20px;
        font-weight: 600;

    }

    .popup-actions {
        display: flex;
        justify-content: space-between;
    }

    .btn-yes,
    .btn-no {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-yes {
        background: #e53935;
        color: #fff;
    }

    .btn-yes:hover {
        background: #c62828;
    }

    .btn-no {
        background: #ccc;
        color: #333;
    }

    .btn-no:hover {
        background: #b0b0b0;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideDown {
        from {
            transform: translateY(-20px);
        }
        to {
            transform: translateY(0);
        }
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
</style>
@endsection


@section('customJs')
     
<script>
    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.myjobs-dropdown');
        dropdowns.forEach(function(dropdown) {
            const button = dropdown.previousElementSibling;
            const isClickInside = dropdown.contains(event.target) || button.contains(event.target);
            if (!isClickInside) {
                dropdown.style.display = 'none';
            }
        });
    });

    // Toggle dropdown visibility on button click
    function toggleDropdown(event) {
        const dropdown = event.target.closest('.myjobs-actions').querySelector('.myjobs-dropdown');
        const isVisible = dropdown.style.display === 'block';

        // Hide all dropdowns first
        document.querySelectorAll('.myjobs-dropdown').forEach(function(dropdown) {
            dropdown.style.display = 'none';
        });

        // Toggle the clicked dropdown visibility
        dropdown.style.display = isVisible ? 'none' : 'block';
    }

    // Confirmation Pop-Up Logic
    document.querySelectorAll('.delete-job').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            // Get job ID and form action
            const jobId = button.dataset.id;
            const action = button.dataset.action;

            // Show the pop-up
            const popup = document.getElementById('confirm-popup');
            popup.style.display = 'flex';

            // Handle confirm and cancel actions
            const confirmYes = document.getElementById('confirm-yes');
            const confirmNo = document.getElementById('confirm-no');

            confirmYes.onclick = function () {
                // Create and submit the form dynamically
                const form = document.createElement('form');
                form.action = action;
                form.method = 'POST';

                // Add CSRF token and DELETE method
                const csrfField = document.createElement('input');
                csrfField.type = 'hidden';
                csrfField.name = '_token';
                csrfField.value = '{{ csrf_token() }}';

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfField);
                form.appendChild(methodField);
                document.body.appendChild(form);

                form.submit();
            };

            confirmNo.onclick = function () {
                // Hide the pop-up
                popup.style.display = 'none';
            };
        });
    });

    // Hide the pop-up when clicking outside
    document.getElementById('confirm-popup').addEventListener('click', function (event) {
        if (event.target === this) {
            this.style.display = 'none';
        }
    });
</script>
  
@endsection
