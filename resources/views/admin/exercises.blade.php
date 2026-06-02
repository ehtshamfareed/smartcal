@extends('layouts.admin')
@section('title', 'Exercise Database - SmartCal Admin')
@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h1>Exercise Database</h1>
        <p>Manage global exercises available for members to log.</p>
    </div>
</div>
<div style="display: block;">
    <div class="card">
        <div class="card-header" style="border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem;">
            <h3 style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">Current Database</h3>
        </div>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Exercise Name</th>
                        <th>Category</th>
                        <th>MET Value</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exercises as $e)
                    <tr>
                        <td style="color: #0f172a; font-weight: 700; font-family: 'Outfit';">{{ $e->name }}</td>
                        <td style="white-space: nowrap;">
                            <span style="background: rgba(56, 189, 248, 0.1); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.3); padding: 0.3rem 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; white-space: nowrap;">{{ $e->category }}</span>
                        </td>
                        <td style="font-weight: 700; font-size: 1.1rem; color: #ef4444;">{{ $e->met_value }}</td>
                        <td style="text-align: right;">
                            <form action="{{ route('admin.exercise.delete', $e->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this exercise?');">
                                @csrf
                                <button type="submit" class="btn" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); padding: 0.5rem 1rem;"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($exercises->isEmpty())
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 3rem; color: #94a3b8;">
                            <i class="fas fa-dumbbell" style="font-size: 3rem; opacity: 0.2; margin-bottom: 1rem; display: block;"></i>
                            No exercises found in the database.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
