@extends('layouts.admin')

@section('title', 'Add New Food - SmartCal Admin')

@section('admin_content')
<div class="page-header">
    <div class="page-title">
        <h1>Add New Food</h1>
        <p>Add a new nutritional record to the global database.</p>
    </div>
</div>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <div class="card-header" style="border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase;">New Record Details</h3>
        </div>
        <form action="{{ route('admin.food.add') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label style="color: var(--gray-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem; font-weight: 800;">Item Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Whey Protein" required style="width: 100%; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="color: var(--gray-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem; font-weight: 800;">Category</label>
                <select name="category" class="form-control" required style="width: 100%; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <option value="Main Course">Main Course</option>
                    <option value="Protein">Protein / Subs</option>
                    <option value="Staple">Staple / Carb</option>
                    <option value="Fruit">Fruit / Veg</option>
                    <option value="Dairy">Dairy</option>
                    <option value="Beverage">Beverage</option>
                    <option value="Fast Food">Fast Food</option>
                </select>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="color: var(--gray-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem; font-weight: 800;">Diet Suitability (Guidance System)</label>
                <select name="suitability" class="form-control" required style="width: 100%; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <option value="universal">Universal (Good for all)</option>
                    <option value="loss">Weight Loss Friendly (Low Cal/High Protein)</option>
                    <option value="gain">Weight Gain / Bulking (High Cal/Dense)</option>
                </select>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="color: var(--gray-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem; font-weight: 800;">Standard Serving Size</label>
                <input type="text" name="serving_size" class="form-control" placeholder="e.g. 1 scoop (30g)" required style="width: 100%; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="color: var(--gray-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem; font-weight: 800;">Calories (KCAL)</label>
                <input type="number" step="0.1" name="calories" class="form-control" placeholder="e.g. 120" required style="width: 100%; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">
            </div>
            <button type="submit" class="btn" style="width: 100%; background: var(--primary); color: white; border: none; padding: 1.2rem; font-size: 1.1rem; border-radius: 12px;">+ SAVE TO DATABASE</button>
        </form>
    </div>
</div>
@endsection
