@extends('layouts.admin')
@section('title', 'Add New Exercise - SmartCal Admin')
@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h1>Add New Exercise</h1>
        <p>Add a new exercise record to the global database.</p>
    </div>
</div>
<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <div class="card-header" style="border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">New Record Details</h3>
        </div>
        <form action="{{ route('admin.exercise.add') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label style="color: var(--gray-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem; font-weight: 800;">Exercise Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Running (6 mph)" required style="width: 100%; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="color: var(--gray-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem; font-weight: 800;">Category</label>
                <select name="category" class="form-control" required style="width: 100%; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <option value="Cardio">Cardio</option>
                    <option value="Strength">Strength</option>
                    <option value="Flexibility">Flexibility</option>
                    <option value="Sports">Sports</option>
                </select>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="color: var(--gray-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem; font-weight: 800;">MET Value (Metabolic Equivalent)</label>
                <input type="number" step="0.1" name="met_value" class="form-control" placeholder="e.g. 9.8" required style="width: 100%; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">
                <small style="color: #94a3b8; font-size: 0.75rem; margin-top: 0.5rem; display: block;">MET value determines how many calories are burned per hour based on body weight. (E.g. Walking = 3.5, Running = 9.8)</small>
            </div>
            <button type="submit" class="btn" style="width: 100%; background: var(--primary); color: white; border: none; padding: 1.2rem; font-size: 1.1rem; border-radius: 12px;">+ SAVE TO DATABASE</button>
        </form>
    </div>
</div>
@endsection
