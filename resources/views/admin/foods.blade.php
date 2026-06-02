@extends('layouts.admin')
@section('title', 'Food Database - SmartCal Admin')
@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h1>Food Database Control</h1>
        <p>Add, edit, and globally manage nutritional records across the system.</p>
    </div>
</div>
<div style="display: block;">
    <div class="card">
        <div class="card-header" style="border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem;">
            <h3 style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">Current Database</h3>
        </div>
        <div class="table-wrapper" style="max-height: 600px; overflow-y: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Fuel Item</th>
                        <th>Category</th>
                        <th>Serving</th>
                        <th>KCAL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foods as $f)
                    <tr>
                        <td style="color: #0f172a; font-weight: 700; font-family: 'Outfit';">{{ $f->name }}</td>
                        <td style="white-space: nowrap;">
                            <span style="background: rgba(16, 185, 129, 0.1); color: var(--primary); border: 1px solid rgba(16, 185, 129, 0.3); padding: 0.3rem 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; white-space: nowrap;">{{ $f->category }}</span>
                            @if($f->suitability == 'loss')
                                <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); padding: 0.3rem 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; white-space: nowrap; margin-left: 0.5rem;"><i class="fas fa-arrow-down"></i> Loss</span>
                            @elseif($f->suitability == 'gain')
                                <span style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.3rem 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; white-space: nowrap; margin-left: 0.5rem;"><i class="fas fa-arrow-up"></i> Gain</span>
                            @endif
                        </td>
                        <td style="color: var(--gray-light); font-family: 'Outfit'; white-space: nowrap;">{{ $f->serving_size }}</td>
                        <td style="font-weight: 700; font-size: 1.1rem; color: #10b981;">{{ $f->calories }}</td>
                        <td>
                            <form action="{{ route('admin.food.delete', $f->id) }}" method="POST" onsubmit="return confirm('Remove this food item?');" style="margin: 0;">
                                @csrf
                                <button type="submit" style="width: 35px; height: 35px; display: flex; justify-content: center; align-items: center; border-radius: 8px; border: 1px solid #fecaca; background: rgba(239, 68, 68, 0.1); color: #dc2626; cursor: pointer; transition: 0.2s;" title="Delete" onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
