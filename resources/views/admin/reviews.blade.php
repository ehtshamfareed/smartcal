@extends('layouts.admin')

@section('title', 'Member Reviews - SmartCal Admin')

@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h1>Member Reviews</h1>
        <p>Approve or manage member testimonials to be displayed on the landing page.</p>
    </div>
</div>

<div style="display: block;">
    <div class="card">
        <div class="card-header" style="border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem;">
            <h3 style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">Submitted Reviews</h3>
        </div>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $r)
                    <tr>
                        <td style="color: #0f172a; font-weight: 700; font-family: 'Outfit';">
                            {{ $r->user->name ?? 'Unknown User' }}
                        </td>
                        <td style="color: #f59e0b;">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $r->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star" style="color: #cbd5e1;"></i>
                                @endif
                            @endfor
                        </td>
                        <td style="max-width: 300px; white-space: normal; line-height: 1.4; color: #64748b; font-size: 0.9rem;">
                            "{{ $r->review_text }}"
                        </td>
                        <td>
                            @if($r->is_approved)
                                <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); padding: 0.3rem 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700;">Approved</span>
                            @else
                                <span style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); padding: 0.3rem 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700;">Pending</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                @if(!$r->is_approved)
                                <form action="{{ route('admin.review.approve', $r->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); padding: 0.5rem 1rem;" title="Approve"><i class="fas fa-check"></i></button>
                                </form>
                                @endif
                                <form action="{{ route('admin.review.delete', $r->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    @csrf
                                    <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); padding: 0.5rem 1rem;" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($reviews->isEmpty())
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 3rem; color: #94a3b8;">
                            <i class="fas fa-star" style="font-size: 3rem; opacity: 0.2; margin-bottom: 1rem; display: block;"></i>
                            No reviews found.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
