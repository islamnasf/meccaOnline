@extends('layouts.app')

@section('title', 'تفاصيل البائع: ' . $vendor->name)
@section('page-title', 'تفاصيل البائع: ' . $vendor->name)

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="{{ route('vendors.index') }}">البائعين</a></li>
            <li class="breadcrumb-item active" aria-current="page">تفاصيل: {{ $vendor->name }}</li>
        </ol>
    </nav>
@endsection

@section('actions')
    <div class="btn-group" role="group">
        <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-2"></i>تعديل
        </a>
        <button type="button" onclick="confirmDelete('{{ route('vendors.destroy', $vendor->id) }}')" 
                class="btn btn-danger me-2">
            <i class="fas fa-trash me-2"></i>حذف
        </button>
        <a href="{{ route('vendors.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-right me-2"></i>عودة للقائمة
        </a>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .vendor-header {
            background: linear-gradient(135deg, #4361ee, #3f37c9);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .vendor-logo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .info-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }
        
        .color-badge {
            width: 30px;
            height: 30px;
            border-radius: 5px;
            display: inline-block;
            margin-left: 5px;
            border: 1px solid #dee2e6;
        }
        
        .service-card {
            border-left: 4px solid #4361ee;
            margin-bottom: 15px;
        }
        
        .section-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
        }
        
        .slide-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .slide-item {
            width: 200px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .slide-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .media-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        
        .media-item {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }
        
        .media-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .media-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px;
            font-size: 10px;
            text-align: center;
        }
        
        #vendorMap {
            height: 300px;
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Vendor Header -->
        <div class="vendor-header">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    @if($vendor->logo)
                        <img src="{{ asset($vendor->logo) }}" alt="شعار البائع" class="vendor-logo">
                    @else
                        <div class="vendor-logo bg-white d-flex align-items-center justify-content-center">
                            <i class="fas fa-store fa-4x text-primary"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <h1 class="mb-3">{{ $vendor->name }}</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-1"><i class="fas fa-phone me-2"></i>{{ $vendor->phone1 }}</p>
                            @if($vendor->phone2)
                                <p class="mb-1"><i class="fas fa-phone-alt me-2"></i>{{ $vendor->phone2 }}</p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><i class="fas fa-envelope me-2"></i>{{ $vendor->email }}</p>
                            <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>{{ $vendor->address }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><i class="fas fa-tag me-2"></i>{{ $vendor->category->name ?? 'بدون فئة' }}</p>
                            <p class="mb-1">
                                <i class="fas fa-palette me-2"></i>الألوان:
                                <span class="color-badge" style="background-color: {{ $vendor->color1 }}"></span>
                                <span class="color-badge" style="background-color: {{ $vendor->color2 }}"></span>
                                <span class="color-badge" style="background-color: {{ $vendor->color3 }}"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Vendor Details -->
        <div class="row">
            <!-- Description -->
            <div class="col-md-12">
                <div class="info-card">
                    <h5 class="card-title mb-3"><i class="fas fa-info-circle me-2"></i>الوصف</h5>
                    <div class="card-text">
                        {!! $vendor->description ?? 'لا يوجد وصف' !!}
                    </div>
                </div>
            </div>
            
            <!-- About Us -->
            @if($vendor->aboute)
                <div class="col-md-12">
                    <div class="info-card">
                        <h5 class="card-title mb-3"><i class="fas fa-user-circle me-2"></i>معلومات عنا</h5>
                        <div class="card-text">
                            {!! $vendor->aboute !!}
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Location -->
            <div class="col-md-12">
                <div class="info-card">
                    <h5 class="card-title mb-3"><i class="fas fa-map-marker-alt me-2"></i>الموقع</h5>
                    <div id="vendorMap"></div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <p><strong>خط العرض:</strong> {{ $vendor->Latitude }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>خط الطول:</strong> {{ $vendor->Longitude }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Hero Slides -->
            @if($vendor->slides->count() > 0)
                <div class="col-md-12">
                    <div class="info-card">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-sliders-h me-2"></i>شرائح الهيدر
                            <span class="badge bg-primary ms-2">{{ $vendor->slides->count() }}</span>
                        </h5>
                        <div class="slide-gallery">
                            @foreach($vendor->slides as $slide)
                                <div class="slide-item">
                                    @if($slide->image)
                                        <img src="{{ asset($slide->image) }}" alt="{{ $slide->name }}">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="p-3">
                                        <h6 class="mb-1">{{ $slide->name }}</h6>
                                        @if($slide->description)
                                            <p class="text-muted small mb-0">{{ Str::limit($slide->description, 50) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Services -->
            <div class="col-md-12">
                <div class="info-card">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-concierge-bell me-2"></i>الخدمات
                        <span class="badge bg-primary ms-2">{{ $vendor->services->count() }}</span>
                    </h5>
                    
                    @if($vendor->services->count() > 0)
                        <div class="accordion" id="servicesAccordion">
                            @foreach($vendor->services as $serviceIndex => $service)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $serviceIndex }}">
                                        <button class="accordion-button {{ $serviceIndex == 0 ? '' : 'collapsed' }}" 
                                                type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#collapse{{ $serviceIndex }}" 
                                                aria-expanded="{{ $serviceIndex == 0 ? 'true' : 'false' }}" 
                                                aria-controls="collapse{{ $serviceIndex }}">
                                            <div class="d-flex align-items-center w-100">
                                                @if($service->logo)
                                                    <img src="{{ asset($service->logo) }}" alt="شعار الخدمة" 
                                                         class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $service->name }}</h6>
                                                    @if($service->description)
                                                        <small class="text-muted">{{ Str::limit($service->description, 50) }}</small>
                                                    @endif
                                                </div>
                                                <span class="badge bg-info ms-auto">
                                                    {{ $service->sections->count() }} قسم
                                                </span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $serviceIndex }}" 
                                         class="accordion-collapse collapse {{ $serviceIndex == 0 ? 'show' : '' }}" 
                                         aria-labelledby="heading{{ $serviceIndex }}" 
                                         data-bs-parent="#servicesAccordion">
                                        <div class="accordion-body">
                                            @if($service->image)
                                                <div class="text-center mb-3">
                                                    <img src="{{ asset($service->image) }}" alt="صورة الخدمة" 
                                                         class="img-fluid rounded" style="max-height: 200px;">
                                                </div>
                                            @endif
                                            
                                            @if($service->description)
                                                <div class="mb-3">
                                                    <h6>وصف الخدمة:</h6>
                                                    <p>{{ $service->description }}</p>
                                                </div>
                                            @endif
                                            
                                            @if($service->sections->count() > 0)
                                                <h6 class="mb-3">أقسام الخدمة:</h6>
                                                <div class="row">
                                                    @foreach($service->sections as $section)
                                                        <div class="col-md-6">
                                                            <div class="section-card">
                                                                <div class="d-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h6 class="mb-1">{{ $section->name }}</h6>
                                                                        @if($section->description)
                                                                            <p class="text-muted small mb-2">{{ Str::limit($section->description, 100) }}</p>
                                                                        @endif
                                                                    </div>
                                                                    @if($section->image)
                                                                        <img src="{{ asset($section->image) }}" alt="صورة القسم" 
                                                                             class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                                    @endif
                                                                </div>
                                                                
                                                                @if($section->media->count() > 0)
                                                                    <div class="mt-2">
                                                                        <small class="text-muted">وسائط القسم:</small>
                                                                        <div class="media-gallery">
                                                                            @foreach($section->media as $media)
                                                                                <div class="media-item">
                                                                                    @if(Str::startsWith($media->file, ['image/', 'vendors/']) && in_array(pathinfo($media->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                                                        <img src="{{ asset($media->file) }}" alt="وسائط">
                                                                                    @else
                                                                                        <div class="bg-secondary d-flex align-items-center justify-content-center h-100">
                                                                                            <i class="fas fa-file text-white"></i>
                                                                                        </div>
                                                                                    @endif
                                                                                    <div class="media-overlay">
                                                                                        {{ pathinfo($media->file, PATHINFO_EXTENSION) }}
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-muted text-center">لا توجد أقسام لهذه الخدمة</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center">لا توجد خدمات لهذا البائع</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Initialize map
    $(document).ready(function() {
        const lat = parseFloat('{{ $vendor->Latitude ?? 24.7136 }}');
        const lng = parseFloat('{{ $vendor->Longitude ?? 46.6753 }}');
        
        const map = L.map('vendorMap').setView([lat, lng], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        
        L.marker([lat, lng]).addTo(map)
            .bindPopup('<b>{{ $vendor->name }}</b><br>{{ $vendor->address }}')
            .openPopup();
    });
</script>
@endpush