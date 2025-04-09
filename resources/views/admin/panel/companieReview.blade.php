@extends('admin.layouts.app')

@section('main')
<section class="admin-reviews-reports">
    <div class="admin-reviews-reports-container">
        <div class="admin-reviews-reports-header">
            <h2>Company Reviews and Ratings</h2>
        </div>

        <div class="admin-reviews-container">
            <!-- Company Reviews Table -->
            <div class="admin-reviews-box">
                
                <p>Note: These reviews are sent by users to the companies.</p>
                <table class="admin-reviews-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Company Name</th>
                            <th>By User</th>
                            <th>Review</th>
                            <th>Date</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companyRatings as $rating)
                            <tr>
                                <td>{{ ($companyRatings->currentPage() - 1) * $companyRatings->perPage() + $loop->iteration }}</td>
                                <td>{{ $rating->company->c_name }}</td>
                                <td>{{ $rating->user->fullName }}</td>
                                <td>{{ $rating->feedback }}</td>
                                <td>{{ $rating->created_at->format('d-M-Y') }}</td>
                                <td class="rating-cell">
                                    <span class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $rating->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="pagination-container">
            @if ($companyRatings->hasPages())
                <nav class="pagination-nav">
                    {{-- Previous Button --}}
                    @if ($companyRatings->onFirstPage())
                        <span class="pagination-link disabled">Previous</span>
                    @else
                        <a href="{{ $companyRatings->previousPageUrl() }}" class="pagination-link">Previous</a>
                    @endif
        
                    {{-- Page Numbers --}}
                    @foreach ($companyRatings->links()->elements as $element)
                        {{-- Separator for "..." --}}
                        @if (is_string($element))
                            <span class="pagination-link dots">{{ $element }}</span>
                        @endif
        
                        {{-- Array of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $companyRatings->currentPage())
                                    <span class="pagination-link active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
        
                    {{-- Next Button --}}
                    @if ($companyRatings->hasMorePages())
                        <a href="{{ $companyRatings->nextPageUrl() }}" class="pagination-link">Next</a>
                    @else
                        <span class="pagination-link disabled">Next</span>
                    @endif
                </nav>
            @endif
        </div>
    </div>
</section>
@endsection