@extends('admin.layouts.app')

@section('main')
<section class="admin-reviews-reports">
    <div class="admin-reviews-reports-container">
        <div class="admin-reviews-reports-header">
            <h2>Feedbacks And Ratings</h2>
        </div>

        <div class="admin-reviews-container">
            <!-- User Reviews Table -->
            <div class="admin-reviews-box">
                <div class="button-container">
                    <a href="{{ route('admin.showCompanieReview') }}" class="admin-view-company-review">View Registered Companies Review</a>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>User Reviews</h3>
                </div>
                <table class="admin-reviews-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>User</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Date</th>
                            <th>Set In About</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($userFeedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->row_num }}</td>
                            <td>{{ $feedback->fullName }}</td>
                            <td>{{ $feedback->feedback }}</td>
                            <td class="rating-cell">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $feedback->rating)
                                        <span class="stars">★</span>
                                    @else
                                        <span class="stars">☆</span>
                                    @endif
                                @endfor
                            </td>
                            <td>{{ date('d-M-Y', strtotime($feedback->created_at)) }}</td>
                            <td class="admin-set-text">
                                {{ $feedback->is_feedback ? 'Set' : 'Not Set' }}
                            </td>
                            <td>
                                <div class="admin-feedback-buttons">
                                    <form action="{{ route('admin.feedback.set', $feedback->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="admin-set-btn-action">
                                            {{ $feedback->is_feedback ? 'Unset' : 'Set' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.feedback.delete', $feedback->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn-action" onclick="return confirm('Are you sure you want to delete this feedback?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No feedbacks found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $userFeedbacks->links() }}
            </div>
        </div>
    </div>
</section>
@endsection