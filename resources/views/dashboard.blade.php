@extends('layouts.app')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-3">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">إجمالي البائعين</h6>
                        <h2 class="mb-0">{{ $totalVendors }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-store fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('vendors.index') }}" class="text-white stretched-link">عرض التفاصيل</a>
                <i class="fas fa-arrow-left"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">البائعين النشطين</h6>
                        <h2 class="mb-0">{{ $activeVendors }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('vendors.index') }}?status=active" class="text-white stretched-link">عرض التفاصيل</a>
                <i class="fas fa-arrow-left"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">إجمالي الخدمات</h6>
                        <h2 class="mb-0">{{ $totalServices }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-concierge-bell fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="#" class="text-white stretched-link">عرض التفاصيل</a>
                <i class="fas fa-arrow-left"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">إجمالي الفئات</h6>
                        <h2 class="mb-0">{{ $totalCategories }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-list fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('categories.index') }}" class="text-white stretched-link">عرض التفاصيل</a>
                <i class="fas fa-arrow-left"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Vendors -->
    <div class="col-md-8">
        <div class="card card-custom mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-history me-2"></i>آخر البائعين المضافين
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الفئة</th>
                                <th>الهاتف</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentVendors as $vendor)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($vendor->logo)
                                            <img src="{{ asset($vendor->logo) }}" alt="شعار" 
                                                 class="avatar me-3">
                                        @endif
                                        <div>
                                            <strong>{{ $vendor->name }}</strong><br>
                                            <small class="text-muted">{{ Str::limit($vendor->description, 30) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $vendor->category->name ?? 'بدون' }}</span>
                                </td>
                                <td>{{ $vendor->phone1 }}</td>
                                <td>
                                    <span class="badge {{ $vendor->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $vendor->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </td>
                                <td>{{ $vendor->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('vendors.show', $vendor->id) }}" 
                                           class="btn btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('vendors.edit', $vendor->id) }}" 
                                           class="btn btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('vendors.index') }}" class="btn btn-outline-primary">عرض جميع البائعين</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-md-4">
        <div class="card card-custom mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt me-2"></i>إجراءات سريعة
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('vendors.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>إضافة بائع جديد
                    </a>
                    <a href="{{ route('categories.store') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-plus me-2"></i>إضافة فئة جديدة
                    </a>
                    <a href="{{ route('vendors.index') }}?status=active" class="btn btn-info btn-lg">
                        <i class="fas fa-check-circle me-2"></i>عرض البائعين النشطين
                    </a>
                    <button class="btn btn-warning btn-lg" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>طباعة التقارير
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Statistics Chart -->
        <div class="card card-custom">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-pie me-2"></i>إحصائيات البائعين
                </h5>
            </div>
            <div class="card-body">
                <canvas id="vendorsChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        // Initialize chart
        const ctx = document.getElementById('vendorsChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['نشطين', 'غير نشطين'],
                datasets: [{
                    data: [{{ $activeVendors }}, {{ $totalVendors - $activeVendors }}],
                    backgroundColor: [
                        '#28a745',
                        '#6c757d'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        rtl: true
                    }
                }
            }
        });
    });
</script>
@endpush