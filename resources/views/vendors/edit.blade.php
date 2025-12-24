<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(isset($vendor)) تعديل بائع @else إضافة بائع جديد @endif</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Quill Text Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
            --warning-color: #f8961e;
        }
        
        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark-color);
        }
        
        .form-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .header-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .section-title {
            border-right: 5px solid var(--primary-color);
            padding-right: 15px;
            margin-bottom: 25px;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .dynamic-section {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            transition: all 0.3s;
            position: relative;
        }
        
        .dynamic-section:hover {
            border-color: var(--primary-color);
            background-color: rgba(67, 97, 238, 0.02);
        }
        
        .btn-remove {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(247, 37, 133, 0.3);
        }
        
        .btn-remove:hover {
            background-color: var(--danger-color);
            color: white;
        }
        
        .required::after {
            content: " *";
            color: var(--danger-color);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .submit-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 15px 40px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
            transition: all 0.3s;
        }
        
        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(67, 97, 238, 0.3);
        }
        
        .counter-badge {
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
        }
        
        /* Map Styles */
        #locationMap {
            height: 300px;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            margin-top: 10px;
            z-index: 1;
        }
        
        .map-controls {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 1000;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .location-coordinates {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px 15px;
            margin-top: 15px;
            font-family: monospace;
        }
        
        /* File Preview */
        .file-preview {
            margin-top: 10px;
            border: 1px dashed #dee2e6;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        
        .file-preview img {
            max-width: 100%;
            max-height: 70px;
            object-fit: contain;
        }
        
        /* Multi-file Upload */
        .multi-file-upload {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .multi-file-upload:hover {
            border-color: var(--primary-color);
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .multi-file-upload.dragover {
            border-color: var(--success-color);
            background-color: rgba(76, 201, 240, 0.1);
        }
        
        .file-list {
            margin-top: 20px;
        }
        
        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        .file-info {
            display: flex;
            align-items: center;
        }
        
        .file-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
            font-size: 1.2rem;
        }
        
        .file-details {
            flex-grow: 1;
        }
        
        .file-name {
            font-weight: 500;
            margin-bottom: 3px;
        }
        
        .file-size {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .file-actions {
            display: flex;
            gap: 10px;
        }
        
        /* Text Editor Styling */
        .ql-container {
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .ql-toolbar {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        
        .editor-container {
            margin-bottom: 20px;
        }
        
        .about-us-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }
        
        /* Loading Spinner */
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
            margin: 0 auto;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Slide Hero Section */
        .slide-hero-section {
            background: linear-gradient(135deg, #f5f7fb 0%, #e4edf5 100%);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border: 2px solid #dee2e6;
        }
        
        .hero-slide-preview {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background-color: white;
            margin-top: 15px;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        
        .hero-slide-preview img {
            max-width: 100%;
            max-height: 150px;
            border-radius: 8px;
        }
        
        /* Nested sections styling */
        .nested-section {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: white;
            position: relative;
        }
        
        .nested-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .section-nested-indicator {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
        }
        
        /* Toggle for nested sections */
        .sections-toggle {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px 15px;
            margin-top: 10px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .sections-toggle:hover {
            background-color: #e9ecef;
        }
        
        .sections-content {
            display: none;
            margin-top: 15px;
        }
        
        .sections-content.show {
            display: block;
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }
            
            .header-section {
                padding: 20px 15px;
            }
            
            .map-controls {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 10px;
            }
            
            .file-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .file-actions {
                margin-top: 10px;
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Header -->
        <div class="header-section">
            <h1>
                <i class="fas fa-store me-3"></i>
                @if(isset($vendor)) تعديل بائع @else إضافة بائع جديد @endif
            </h1>
            <p class="mb-0 mt-3">املأ النموذج التالي @if(isset($vendor)) لتعديل بيانات البائع @else لإضافة بائع جديد إلى النظام @endif</p>
        </div>
        
        <!-- Main Form -->
        <form id="vendorForm" action="{{ isset($vendor) ? route('vendors.update', $vendor->id) : route('vendors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
          
            
            <div class="form-container">
                <!-- Vendor Basic Information -->
                <h3 class="section-title">المعلومات الأساسية للبائع</h3>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="vendorName" class="form-label required">اسم البائع</label>
                        <input type="text" class="form-control" id="vendorName" name="name" 
                               value="{{ old('name', $vendor->name ?? '') }}" 
                               placeholder="أدخل اسم البائع" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorCategory" class="form-label required">الفئة</label>
                        <select class="form-select" id="vendorCategory" name="category_id" required>
                            <option selected disabled value="">اختر فئة البائع</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        @if(old('category_id', $vendor->category_id ?? '') == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-12">
                        <label for="vendorDescription" class="form-label">الوصف</label>
                        <div class="editor-container">
                            <div id="vendorDescriptionEditor"></div>
                            <textarea class="d-none" id="vendorDescription" name="description">{{ old('description', $vendor->description ?? '') }}</textarea>
                        </div>
                    </div>
                    
                    <!-- About Us Section -->
                    <div class="col-md-12 about-us-section">
                        <label class="form-label">معلومات عن البائع (About Us)</label>
                        <div class="editor-container">
                            <div id="vendorAboutUsEditor"></div>
                            <textarea class="d-none" id="vendorAboutUs" name="aboute">{{ old('aboute', $vendor->aboute ?? '') }}</textarea>
                        </div>
                        
                        <!-- About Image Field -->
                        <div class="about-image-field mt-3">
                            <label for="vendorAboutImage" class="form-label">صورة about</label>
                            <input type="file" class="form-control" id="vendorAboutImage" name="about_image" accept="image/*">
                            @if(isset($vendor) && $vendor->aboute_image)
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="delete_about_image" id="deleteAboutImage">
                                    <label class="form-check-label text-danger" for="deleteAboutImage">
                                        حذف الصورة الحالية
                                    </label>
                                </div>
                            @endif
                            <div class="file-preview mt-2" id="aboutImagePreview">
                                @if(isset($vendor) && $vendor->aboute_image)
                                    <img src="{{ asset('storage/' . $vendor->aboute_image) }}" alt="صورة about" class="img-thumbnail">
                                    <small class="text-muted mt-2 d-block">{{ basename($vendor->aboute_image) }}</small>
                                @else
                                    <i class="fas fa-image fa-2x text-muted"></i>
                                    <small class="text-muted mt-2">معاينة الصورة ستظهر هنا</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorEmail" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="vendorEmail" name="email"
                               value="{{ old('email', $vendor->email ?? '') }}" 
                               placeholder="example@domain.com">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorPhone1" class="form-label required">رقم الهاتف الرئيسي</label>
                        <input type="text" class="form-control" id="vendorPhone1" name="phone1"
                               value="{{ old('phone1', $vendor->phone1 ?? '') }}" 
                               placeholder="05xxxxxxxx" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorPhone2" class="form-label">رقم الهاتف الثانوي</label>
                        <input type="text" class="form-control" id="vendorPhone2" name="phone2"
                               value="{{ old('phone2', $vendor->phone2 ?? '') }}" 
                               placeholder="05xxxxxxxx">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorAddress" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="vendorAddress" name="address"
                               value="{{ old('address', $vendor->address ?? '') }}" 
                               placeholder="أدخل عنوان البائع">
                    </div>
                    
                    <!-- Location with Map -->
                    <div class="col-md-12 position-relative">
                        <label for="vendorLocation" class="form-label">حدد موقع البائع</label>
                        <div id="locationMap"></div>
                        <div class="map-controls">
                            <button type="button" class="btn btn-sm btn-outline-primary" id="locateMeBtn">
                                <i class="fas fa-location-arrow me-1"></i>تحديد موقعي الحالي
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" id="resetMapBtn">
                                <i class="fas fa-redo me-1"></i>إعادة تعيين
                            </button>
                        </div>
                        <div class="location-coordinates">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label small">خط العرض (Latitude)</label>
                                    <input type="text" class="form-control form-control-sm" id="latitude" 
                                           name="latitude" 
                                           value="{{ old('latitude', $vendor->Latitude ?? '24.7136') }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">خط الطول (Longitude)</label>
                                    <input type="text" class="form-control form-control-sm" id="longitude" 
                                           name="longitude" 
                                           value="{{ old('longitude', $vendor->Longitude ?? '46.6753') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- File Uploads with Preview -->
                    <div class="col-md-6">
                        <label for="vendorLogo" class="form-label">شعار البائع</label>
                        <input type="file" class="form-control" id="vendorLogo" name="logo" accept="image/*">
                        @if(isset($vendor) && $vendor->logo)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="delete_logo" id="deleteLogo">
                                <label class="form-check-label text-danger" for="deleteLogo">
                                    حذف الشعار الحالي
                                </label>
                            </div>
                        @endif
                        <div class="file-preview mt-2" id="logoPreview">
                            @if(isset($vendor) && $vendor->logo)
                                <img src="{{ asset('storage/' . $vendor->logo) }}" alt="شعار البائع" class="img-thumbnail">
                                <small class="text-muted mt-2 d-block">{{ basename($vendor->logo) }}</small>
                            @else
                                <i class="fas fa-image fa-2x text-muted"></i>
                                <small class="text-muted mt-2">معاينة الشعار ستظهر هنا</small>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorImage" class="form-label">صورة البائع</label>
                        <input type="file" class="form-control" id="vendorImage" name="image" accept="image/*">
                        @if(isset($vendor) && $vendor->image)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="delete_image" id="deleteImage">
                                <label class="form-check-label text-danger" for="deleteImage">
                                    حذف الصورة الحالية
                                </label>
                            </div>
                        @endif
                        <div class="file-preview mt-2" id="imagePreview">
                            @if(isset($vendor) && $vendor->image)
                                <img src="{{ asset('storage/' . $vendor->image) }}" alt="صورة البائع" class="img-thumbnail">
                                <small class="text-muted mt-2 d-block">{{ basename($vendor->image) }}</small>
                            @else
                                <i class="fas fa-image fa-2x text-muted"></i>
                                <small class="text-muted mt-2">معاينة الصورة ستظهر هنا</small>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Color Scheme -->
                <h3 class="section-title mt-5">الألوان الخاصة بالبائع</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label for="color1" class="form-label">اللون الأول</label>
                        <div class="d-flex align-items-center">
                            <input type="color" class="form-control form-control-color" id="color1" 
                                   name="color1" value="{{ old('color1', $vendor->color1 ?? '#4361ee') }}" title="اختر اللون الأول">
                            <div class="color-preview" id="color1Preview" 
                                 style="background-color: {{ old('color1', $vendor->color1 ?? '#4361ee') }};"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="color2" class="form-label">اللون الثاني</label>
                        <div class="d-flex align-items-center">
                            <input type="color" class="form-control form-control-color" id="color2" 
                                   name="color2" value="{{ old('color2', $vendor->color2 ?? '#3f37c9') }}" title="اختر اللون الثاني">
                            <div class="color-preview" id="color2Preview" 
                                 style="background-color: {{ old('color2', $vendor->color2 ?? '#3f37c9') }};"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="color3" class="form-label">اللون الثالث</label>
                        <div class="d-flex align-items-center">
                            <input type="color" class="form-control form-control-color" id="color3" 
                                   name="color3" value="{{ old('color3', $vendor->color3 ?? '#4cc9f0') }}" title="اختر اللون الثالث">
                            <div class="color-preview" id="color3Preview" 
                                 style="background-color: {{ old('color3', $vendor->color3 ?? '#4cc9f0') }};"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Vendor Slides (Hero Slides) -->
                <div class="slide-hero-section mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h3 class="section-title mb-0">شرائح الهيدر (Hero Slides) <span class="counter-badge" id="slidesCount">{{ isset($vendor) ? $vendor->slides->count() : 0 }}</span></h3>
                            <small class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>شرائح العرض الرئيسية التي تظهر في الهيدر</small>
                        </div>
                        <button type="button" class="btn btn-primary" id="addSlideBtn">
                            <i class="fas fa-plus me-2"></i>إضافة شريحة
                        </button>
                    </div>
                    
                    <div id="slidesContainer">
                        <!-- Dynamic slides will be added here -->
                        @if(isset($vendor) && $vendor->slides->count() > 0)
                            @foreach($vendor->slides as $index => $slide)
                                <div class="dynamic-section slide-item" data-slide-id="{{ $slide->id }}">
                                    <input type="hidden" name="slides[{{ $index }}][id]" value="{{ $slide->id }}">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="text-primary mb-0"><i class="fas fa-sliders-h me-2"></i>شريحة الهيدر</h5>
                                        <button type="button" class="btn btn-sm btn-remove remove-slide">
                                            <i class="fas fa-trash me-1"></i>حذف
                                        </button>
                                    </div>
                                    
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label">اسم الشريحة</label>
                                            <input type="text" class="form-control slide-name" 
                                                   name="slides[{{ $index }}][name]" 
                                                   value="{{ $slide->name }}" 
                                                   placeholder="أدخل اسم الشريحة" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label">صورة الشريحة</label>
                                            <input type="file" class="form-control slide-image" 
                                                   name="slides[{{ $index }}][image]" 
                                                   accept="image/*">
                                            @if($slide->image)
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="checkbox" 
                                                           name="slides[{{ $index }}][delete_image]" 
                                                           id="deleteSlideImage{{ $index }}">
                                                    <label class="form-check-label text-danger" for="deleteSlideImage{{ $index }}">
                                                        حذف الصورة الحالية
                                                    </label>
                                                </div>
                                            @endif
                                            <div class="hero-slide-preview mt-2 slide-image-preview">
                                                @if($slide->image)
                                                    <img src="{{ asset('storage/' . $slide->image) }}" alt="شريحة الهيدر">
                                                    <small class="text-muted mt-2 d-block">{{ basename($slide->image) }}</small>
                                                @else
                                                    <i class="fas fa-image fa-3x text-muted"></i>
                                                    <small class="text-muted mt-2">معاينة صورة شريحة الهيدر ستظهر هنا</small>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label class="form-label">وصف الشريحة</label>
                                            <div class="editor-container">
                                                <div class="slide-description-editor"></div>
                                                <textarea class="d-none slide-description" 
                                                       name="slides[{{ $index }}][description]">{{ $slide->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                
                <!-- Vendor Services with Nested Sections -->
                <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                    <h3 class="section-title mb-0">خدمات البائع <span class="counter-badge" id="servicesCount">{{ isset($vendor) ? $vendor->services->count() : 0 }}</span></h3>
                    <button type="button" class="btn btn-primary" id="addServiceBtn">
                        <i class="fas fa-plus me-2"></i>إضافة خدمة
                    </button>
                </div>
                
                <div id="servicesContainer">
                    <!-- Dynamic services with nested sections will be added here -->
                    @if(isset($vendor) && $vendor->services->count() > 0)
                        @php
                            $serviceIndex = 0;
                        @endphp
                        @foreach($vendor->services as $service)
                            <div class="dynamic-section service-item" data-service-id="{{ $service->id }}">
                                <input type="hidden" name="services[{{ $serviceIndex }}][id]" value="{{ $service->id }}">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-primary mb-0">
                                        <i class="fas fa-concierge-bell me-2"></i>خدمة
                                        <span class="service-indicator">
                                            <i class="fas fa-hashtag"></i>
                                            <span class="service-id-display">{{ $serviceIndex + 1 }}</span>
                                        </span>
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-remove remove-service">
                                        <i class="fas fa-trash me-1"></i>حذف
                                    </button>
                                </div>
                                
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">اسم الخدمة</label>
                                        <input type="text" class="form-control service-name" 
                                               name="services[{{ $serviceIndex }}][name]" 
                                               value="{{ $service->name }}" 
                                               placeholder="أدخل اسم الخدمة" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">صورة الخدمة</label>
                                        <input type="file" class="form-control service-image" 
                                               name="services[{{ $serviceIndex }}][image]" 
                                               accept="image/*">
                                        @if($service->image)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="services[{{ $serviceIndex }}][delete_image]" 
                                                       id="deleteServiceImage{{ $serviceIndex }}">
                                                <label class="form-check-label text-danger" for="deleteServiceImage{{ $serviceIndex }}">
                                                    حذف الصورة الحالية
                                                </label>
                                            </div>
                                        @endif
                                        <div class="file-preview mt-2 service-image-preview">
                                            @if($service->image)
                                                <img src="{{ asset('storage/' . $service->image) }}" alt="صورة الخدمة">
                                                <small class="text-muted mt-2 d-block">{{ basename($service->image) }}</small>
                                            @else
                                                <i class="fas fa-image fa-2x text-muted"></i>
                                                <small class="text-muted mt-2">معاينة الصورة ستظهر هنا</small>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label class="form-label">وصف الخدمة</label>
                                        <div class="editor-container">
                                            <div class="service-description-editor"></div>
                                            <textarea class="d-none service-description" 
                                                   name="services[{{ $serviceIndex }}][description]">{{ $service->description }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">شعار الخدمة</label>
                                        <input type="file" class="form-control service-logo" 
                                               name="services[{{ $serviceIndex }}][logo]" 
                                               accept="image/*">
                                        @if($service->logo)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="services[{{ $serviceIndex }}][delete_logo]" 
                                                       id="deleteServiceLogo{{ $serviceIndex }}">
                                                <label class="form-check-label text-danger" for="deleteServiceLogo{{ $serviceIndex }}">
                                                    حذف الشعار الحالي
                                                </label>
                                            </div>
                                        @endif
                                        <div class="file-preview mt-2 service-logo-preview">
                                            @if($service->logo)
                                                <img src="{{ asset('storage/' . $service->logo) }}" alt="شعار الخدمة">
                                                <small class="text-muted mt-2 d-block">{{ basename($service->logo) }}</small>
                                            @else
                                                <i class="fas fa-image fa-2x text-muted"></i>
                                                <small class="text-muted mt-2">معاينة الشعار ستظهر هنا</small>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Nested Sections for this Service -->
                                    <div class="col-md-12">
                                        <div class="sections-toggle" onclick="toggleSections(this)">
                                            <span>
                                                <i class="fas fa-th-large me-2"></i>أقسام هذه الخدمة
                                                <span class="section-nested-indicator ms-2">
                                                    عدد الأقسام: <span class="service-sections-count">{{ $service->sections->count() }}</span>
                                                </span>
                                            </span>
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                        
                                        <div class="sections-content {{ $service->sections->count() > 0 ? 'show' : '' }}">
                                            <div class="service-sections-container">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h6 class="text-secondary mb-0"><i class="fas fa-th-large me-2"></i>أقسام الخدمة</h6>
                                                    <button type="button" class="btn btn-sm btn-outline-primary add-section-btn" 
                                                            data-service-index="{{ $serviceIndex }}">
                                                        <i class="fas fa-plus me-1"></i>إضافة قسم
                                                    </button>
                                                </div>
                                                
                                                <div class="service-sections-list">
                                                    @foreach($service->sections as $sectionIndex => $section)
                                                        <div class="nested-section section-item" data-section-id="{{ $section->id }}">
                                                            <input type="hidden" name="services[{{ $serviceIndex }}][sections][{{ $sectionIndex }}][id]" 
                                                                   value="{{ $section->id }}">
                                                            <div class="nested-section-header">
                                                                <h6 class="mb-0">
                                                                    <i class="fas fa-th me-2"></i>قسم
                                                                    <span class="section-nested-indicator">#{{ $sectionIndex + 1 }}</span>
                                                                </h6>
                                                                <button type="button" class="btn btn-sm btn-danger remove-section">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                            
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label small">اسم القسم</label>
                                                                    <input type="text" class="form-control form-control-sm section-name" 
                                                                           name="services[{{ $serviceIndex }}][sections][{{ $sectionIndex }}][name]" 
                                                                           value="{{ $section->name }}" 
                                                                           placeholder="أدخل اسم القسم" required>
                                                                </div>
                                                                
                                                                <div class="col-md-6">
                                                                    <label class="form-label small">صورة القسم</label>
                                                                    <input type="file" class="form-control form-control-sm section-image" 
                                                                           name="services[{{ $serviceIndex }}][sections][{{ $sectionIndex }}][image]" 
                                                                           accept="image/*">
                                                                    @if($section->image)
                                                                        <div class="form-check mt-2">
                                                                            <input class="form-check-input" type="checkbox" 
                                                                                   name="services[{{ $serviceIndex }}][sections][{{ $sectionIndex }}][delete_image]" 
                                                                                   id="deleteSectionImage{{ $serviceIndex }}{{ $sectionIndex }}">
                                                                            <label class="form-check-label text-danger" for="deleteSectionImage{{ $serviceIndex }}{{ $sectionIndex }}">
                                                                                حذف الصورة الحالية
                                                                            </label>
                                                                        </div>
                                                                    @endif
                                                                    <div class="file-preview mt-2 section-image-preview">
                                                                        @if($section->image)
                                                                            <img src="{{ asset('storage/' . $section->image) }}" alt="صورة القسم">
                                                                            <small class="text-muted mt-2 d-block">{{ basename($section->image) }}</small>
                                                                        @else
                                                                            <i class="fas fa-image fa-lg text-muted"></i>
                                                                            <small class="text-muted mt-2">معاينة الصورة</small>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="form-label small">وصف القسم</label>
                                                                    <div class="editor-container">
                                                                        <div class="section-description-editor"></div>
                                                                        <textarea class="d-none section-description" 
                                                                               name="services[{{ $serviceIndex }}][sections][{{ $sectionIndex }}][description]">{{ $section->description }}</textarea>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Section Media (Multi-file Upload) -->
                                                                <div class="col-md-12">
                                                                    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                                                                        <h6 class="text-secondary mb-0 small"><i class="fas fa-photo-video me-2"></i>وسائط القسم</h6>
                                                                        <small class="text-muted">(يمكنك رفع أكثر من ملف في نفس الوقت)</small>
                                                                    </div>
                                                                    
                                                                    <!-- Multi-file Upload Area -->
                                                                    <div class="multi-file-upload" 
                                                                         data-service-index="{{ $serviceIndex }}" 
                                                                         data-section-index="{{ $sectionIndex }}">
                                                                        <div class="upload-icon mb-3">
                                                                            <i class="fas fa-cloud-upload-alt fa-2x text-primary"></i>
                                                                        </div>
                                                                        <h6>اسحب وأفلت الملفات هنا</h6>
                                                                        <p class="text-muted small">أو انقر لاختيار الملفات</p>
                                                                        <input type="file" class="d-none section-media-files" 
                                                                               name="services[{{ $serviceIndex }}][sections][{{ $sectionIndex }}][media][]" 
                                                                               multiple accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.xlsx,.pptx">
                                                                        <button type="button" class="btn btn-sm btn-outline-primary mt-2 browse-files-btn">
                                                                            <i class="fas fa-folder-open me-2"></i>تصفح الملفات
                                                                        </button>
                                                                    </div>
                                                                    
                                                                    <!-- Existing Media Files -->
                                                                    <div class="file-list">
                                                                        @foreach($section->media as $media)
                                                                            <div class="file-item existing-media" data-media-id="{{ $media->id }}">
                                                                                <div class="file-info">
                                                                                    <div class="file-icon" style="background-color: rgba(67, 97, 238, 0.2)">
                                                                                        <i class="fas fa-file"></i>
                                                                                    </div>
                                                                                    <div class="file-details">
                                                                                        <div class="file-name">{{ basename($media->file) }}</div>
                                                                                        <div class="file-size">وسائط مرفوعة</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="file-actions">
                                                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-existing-media" 
                                                                                            data-media-id="{{ $media->id }}">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </button>
                                                                                    <input type="hidden" name="services[{{ $serviceIndex }}][sections][{{ $sectionIndex }}][existing_media][]" 
                                                                                           value="{{ $media->id }}">
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $serviceIndex++; @endphp
                        @endforeach
                    @endif
                </div>
                
                <!-- Hidden inputs for deleted items -->
                <input type="hidden" name="deleted_services" id="deletedServices" value="">
                <input type="hidden" name="deleted_sections" id="deletedSections" value="">
                <input type="hidden" name="deleted_media" id="deletedMedia" value="">
                <input type="hidden" name="deleted_slides" id="deletedSlides" value="">
                
                <!-- Submit Button -->
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save me-2"></i>
                        @if(isset($vendor)) تحديث البائع @else حفظ البائع @endif
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Templates for dynamic sections -->
    <template id="serviceTemplate">
        <div class="dynamic-section service-item" data-service-id="">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-primary mb-0"><i class="fas fa-concierge-bell me-2"></i>خدمة جديدة <span class="service-indicator"><i class="fas fa-hashtag"></i><span class="service-id-display"></span></span></h5>
                <button type="button" class="btn btn-sm btn-remove remove-service">
                    <i class="fas fa-trash me-1"></i>حذف
                </button>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">اسم الخدمة</label>
                    <input type="text" class="form-control service-name" placeholder="أدخل اسم الخدمة" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">صورة الخدمة</label>
                    <input type="file" class="form-control service-image" accept="image/*">
                    <div class="file-preview mt-2 service-image-preview">
                        <i class="fas fa-image fa-2x text-muted"></i>
                        <small class="text-muted mt-2">معاينة الصورة ستظهر هنا</small>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label">وصف الخدمة</label>
                    <div class="editor-container">
                        <div class="service-description-editor"></div>
                        <textarea class="d-none service-description"></textarea>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">شعار الخدمة</label>
                    <input type="file" class="form-control service-logo" accept="image/*">
                    <div class="file-preview mt-2 service-logo-preview">
                        <i class="fas fa-image fa-2x text-muted"></i>
                        <small class="text-muted mt-2">معاينة الشعار ستظهر هنا</small>
                    </div>
                </div>
                
                <!-- Nested Sections for this Service -->
                <div class="col-md-12">
                    <div class="sections-toggle" onclick="toggleSections(this)">
                        <span>
                            <i class="fas fa-th-large me-2"></i>أقسام هذه الخدمة
                            <span class="section-nested-indicator ms-2">عدد الأقسام: <span class="service-sections-count">0</span></span>
                        </span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    
                    <div class="sections-content">
                        <div class="service-sections-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-secondary mb-0"><i class="fas fa-th-large me-2"></i>أقسام الخدمة</h6>
                                <button type="button" class="btn btn-sm btn-outline-primary add-section-btn">
                                    <i class="fas fa-plus me-1"></i>إضافة قسم
                                </button>
                            </div>
                            
                            <div class="service-sections-list">
                                <!-- Nested sections will be added here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    
    <template id="slideTemplate">
        <div class="dynamic-section slide-item">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-primary mb-0"><i class="fas fa-sliders-h me-2"></i>شريحة الهيدر</h5>
                <button type="button" class="btn btn-sm btn-remove remove-slide">
                    <i class="fas fa-trash me-1"></i>حذف
                </button>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">اسم الشريحة</label>
                    <input type="text" class="form-control slide-name" placeholder="أدخل اسم الشريحة" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">صورة الشريحة</label>
                    <input type="file" class="form-control slide-image" accept="image/*">
                    <div class="hero-slide-preview mt-2 slide-image-preview">
                        <i class="fas fa-image fa-3x text-muted"></i>
                        <small class="text-muted mt-2">معاينة صورة شريحة الهيدر ستظهر هنا</small>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label">وصف الشريحة</label>
                    <div class="editor-container">
                        <div class="slide-description-editor"></div>
                        <textarea class="d-none slide-description"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </template>
    
    <template id="sectionTemplate">
        <div class="nested-section section-item" data-section-id="">
            <div class="nested-section-header">
                <h6 class="mb-0"><i class="fas fa-th me-2"></i>قسم جديد <span class="section-nested-indicator">#<span class="section-id-display"></span></span></h6>
                <button type="button" class="btn btn-sm btn-danger remove-section">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small">اسم القسم</label>
                    <input type="text" class="form-control form-control-sm section-name" placeholder="أدخل اسم القسم" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label small">صورة القسم</label>
                    <input type="file" class="form-control form-control-sm section-image" accept="image/*">
                    <div class="file-preview mt-2 section-image-preview">
                        <i class="fas fa-image fa-lg text-muted"></i>
                        <small class="text-muted mt-2">معاينة الصورة</small>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label small">وصف القسم</label>
                    <div class="editor-container">
                        <div class="section-description-editor"></div>
                        <textarea class="d-none section-description"></textarea>
                    </div>
                </div>
                
                <!-- Section Media (Multi-file Upload) -->
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                        <h6 class="text-secondary mb-0 small"><i class="fas fa-photo-video me-2"></i>وسائط القسم</h6>
                        <small class="text-muted">(يمكنك رفع أكثر من ملف في نفس الوقت)</small>
                    </div>
                    
                    <!-- Multi-file Upload Area -->
                    <div class="multi-file-upload">
                        <div class="upload-icon mb-3">
                            <i class="fas fa-cloud-upload-alt fa-2x text-primary"></i>
                        </div>
                        <h6>اسحب وأفلت الملفات هنا</h6>
                        <p class="text-muted small">أو انقر لاختيار الملفات</p>
                        <input type="file" class="d-none section-media-files" multiple accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.xlsx,.pptx">
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2 browse-files-btn">
                            <i class="fas fa-folder-open me-2"></i>تصفح الملفات
                        </button>
                    </div>
                    
                    <!-- Files List -->
                    <div class="file-list">
                        <!-- Files will be dynamically added here -->
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Bootstrap JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Quill Text Editor JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    
    <script>
        // تهيئة المتغيرات
        let serviceCount = {{ isset($vendor) ? $vendor->services->count() : 0 }};
        let slideCount = {{ isset($vendor) ? $vendor->slides->count() : 0 }};
        let sectionCounter = 0;
        
        // مصفوفات لتخزين العناصر المحذوفة
        let deletedServices = [];
        let deletedSections = [];
        let deletedMedia = [];
        let deletedSlides = [];
        
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // خريطة ومتغيراتها
        let map;
        let marker;
        let defaultLat = {{ isset($vendor) && $vendor->Latitude ? $vendor->Latitude : '24.7136' }};
        let defaultLng = {{ isset($vendor) && $vendor->Longitude ? $vendor->Longitude : '46.6753' }};
        
        // تخزين جميع محررات Quill
        let quillEditors = [];
        
        // تهيئة الخريطة
        function initMap() {
            // إنشاء الخريطة
            map = L.map('locationMap').setView([defaultLat, defaultLng], 13);
            
            // إضافة طبقة الخريطة
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            // إضافة علامة
            marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);
            
            // تحديث الإحداثيات عند تحريك العلامة
            marker.on('dragend', function(e) {
                const position = marker.getLatLng();
                updateCoordinates(position.lat, position.lng);
            });
            
            // تحديث الإحداثيات عند النقر على الخريطة
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateCoordinates(e.latlng.lat, e.latlng.lng);
            });
            
            // تهيئة حقول الإحداثيات
            updateCoordinates(defaultLat, defaultLng);
        }
        
        // تحديث حقول الإحداثيات
        function updateCoordinates(lat, lng) {
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
        }
        
        // زر تحديد الموقع الحالي
        document.getElementById('locateMeBtn').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    map.setView([lat, lng], 15);
                    marker.setLatLng([lat, lng]);
                    updateCoordinates(lat, lng);
                }, function(error) {
                    alert('تعذر الحصول على موقعك: ' + error.message);
                });
            } else {
                alert('متصفحك لا يدعم خاصية تحديد الموقع');
            }
        });
        
        // زر إعادة تعيين الخريطة
        document.getElementById('resetMapBtn').addEventListener('click', function() {
            map.setView([defaultLat, defaultLng], 13);
            marker.setLatLng([defaultLat, defaultLng]);
            updateCoordinates(defaultLat, defaultLng);
        });
        
        // تحديث معاينة الألوان
        document.getElementById('color1').addEventListener('input', function() {
            document.getElementById('color1Preview').style.backgroundColor = this.value;
        });
        
        document.getElementById('color2').addEventListener('input', function() {
            document.getElementById('color2Preview').style.backgroundColor = this.value;
        });
        
        document.getElementById('color3').addEventListener('input', function() {
            document.getElementById('color3Preview').style.backgroundColor = this.value;
        });
        
        // تبديل عرض الأقسام المتداخلة
        function toggleSections(element) {
            const content = element.nextElementSibling;
            const icon = element.querySelector('.fa-chevron-down');
            
            content.classList.toggle('show');
            if (icon.classList.contains('fa-chevron-down')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }
        
        // تهيئة محرر Quill
        function initQuillEditor(editorElement, hiddenTextarea) {
            const quill = new Quill(editorElement, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'image'],
                        ['clean']
                    ]
                },
                placeholder: 'اكتب محتوى هنا...',
            });
            
            // تحديث الحقل المخفي عند تغيير محتوى المحرر
            quill.on('text-change', function() {
                hiddenTextarea.value = quill.root.innerHTML;
            });
            
            // تعيين المحتوى الأولي
            quill.root.innerHTML = hiddenTextarea.value || '';
            
            quillEditors.push(quill);
            return quill;
        }
        
        // معاينة ملف واحد
        function previewSingleFile(input, previewContainer) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    if (file.type.startsWith('image/')) {
                        previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-thumbnail">`;
                    } else {
                        const icon = getFileIcon(file.type);
                        previewContainer.innerHTML = `
                            ${icon}
                            <small class="mt-2 d-block">${file.name}</small>
                            <small class="text-muted d-block">${formatFileSize(file.size)}</small>
                        `;
                    }
                };
                
                reader.readAsDataURL(file);
            }
        }
        
        // الحصول على الأيقونة المناسبة لنوع الملف
        function getFileIcon(fileType) {
            if (fileType.startsWith('image/')) {
                return '<i class="fas fa-image fa-2x"></i>';
            } else if (fileType.startsWith('video/')) {
                return '<i class="fas fa-video fa-2x"></i>';
            } else if (fileType.startsWith('audio/')) {
                return '<i class="fas fa-music fa-2x"></i>';
            } else if (fileType.includes('pdf')) {
                return '<i class="fas fa-file-pdf fa-2x"></i>';
            } else if (fileType.includes('word') || fileType.includes('document')) {
                return '<i class="fas fa-file-word fa-2x"></i>';
            } else if (fileType.includes('excel') || fileType.includes('spreadsheet')) {
                return '<i class="fas fa-file-excel fa-2x"></i>';
            } else if (fileType.includes('powerpoint') || fileType.includes('presentation')) {
                return '<i class="fas fa-file-powerpoint fa-2x"></i>';
            } else {
                return '<i class="fas fa-file fa-2x"></i>';
            }
        }
        
        // تنسيق حجم الملف
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 بايت';
            const k = 1024;
            const sizes = ['بايت', 'كيلوبايت', 'ميجابايت', 'جيجابايت'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // تحديث العداد
        function updateCounter(elementId, count) {
            document.getElementById(elementId).textContent = count;
        }
        
        // إضافة خدمة
        document.getElementById('addServiceBtn').addEventListener('click', function() {
            addService();
        });
        
        function addService() {
            const serviceClone = document.getElementById('serviceTemplate').content.cloneNode(true);
            serviceCount++;
            const serviceId = 'new-' + Date.now();
            
            const serviceElement = serviceClone.querySelector('.service-item');
            serviceElement.dataset.serviceId = serviceId;
            
            // تحديث عرض معرف الخدمة
            serviceElement.querySelector('.service-id-display').textContent = serviceCount;
            
            updateCounter('servicesCount', serviceCount);
            
            // إضافة أسماء الحقول الصحيحة
            const serviceIndex = serviceCount - 1;
            const nameInput = serviceElement.querySelector('.service-name');
            const imageInput = serviceElement.querySelector('.service-image');
            const descriptionTextarea = serviceElement.querySelector('.service-description');
            const logoInput = serviceElement.querySelector('.service-logo');
            
            nameInput.name = `services[${serviceIndex}][name]`;
            imageInput.name = `services[${serviceIndex}][image]`;
            descriptionTextarea.name = `services[${serviceIndex}][description]`;
            logoInput.name = `services[${serviceIndex}][logo]`;
            
            // تهيئة محرر Quill لوصف الخدمة
            const editorElement = serviceElement.querySelector('.service-description-editor');
            const quill = initQuillEditor(editorElement, descriptionTextarea);
            
            // إضافة مستمع حدث لحذف الخدمة
            const removeBtn = serviceElement.querySelector('.remove-service');
            removeBtn.addEventListener('click', function() {
                const serviceId = this.closest('.service-item').dataset.serviceId;
                if (serviceId && serviceId.startsWith('new-')) {
                    // خدمة جديدة - فقط احذفها
                    this.closest('.service-item').remove();
                } else {
                    // خدمة موجودة - أضفها إلى المحذوفات
                    deletedServices.push(serviceId);
                    document.getElementById('deletedServices').value = JSON.stringify(deletedServices);
                    this.closest('.service-item').remove();
                }
                serviceCount--;
                updateCounter('servicesCount', serviceCount);
            });
            
            // إضافة مستمع حدث لإضافة قسم
            const addSectionBtn = serviceElement.querySelector('.add-section-btn');
            const sectionsList = serviceElement.querySelector('.service-sections-list');
            let serviceSectionCount = 0;
            
            addSectionBtn.addEventListener('click', function() {
                addNestedSection(sectionsList, serviceIndex, serviceSectionCount);
                serviceSectionCount++;
                updateServiceSectionsCount(serviceElement, serviceSectionCount);
            });
            
            document.getElementById('servicesContainer').appendChild(serviceElement);
        }
        
        // إضافة قسم متداخل
        function addNestedSection(container, serviceIndex, sectionIndex) {
            const sectionClone = document.getElementById('sectionTemplate').content.cloneNode(true);
            sectionCounter++;
            const sectionId = 'new-' + sectionCounter;
            
            const sectionElement = sectionClone.querySelector('.section-item');
            sectionElement.dataset.sectionId = sectionId;
            
            // تحديث عرض معرف القسم
            sectionElement.querySelector('.section-id-display').textContent = sectionIndex + 1;
            
            // إضافة أسماء الحقول الصحيحة
            const nameInput = sectionElement.querySelector('.section-name');
            const imageInput = sectionElement.querySelector('.section-image');
            const descriptionTextarea = sectionElement.querySelector('.section-description');
            const mediaInput = sectionElement.querySelector('.section-media-files');
            
            nameInput.name = `services[${serviceIndex}][sections][${sectionIndex}][name]`;
            imageInput.name = `services[${serviceIndex}][sections][${sectionIndex}][image]`;
            descriptionTextarea.name = `services[${serviceIndex}][sections][${sectionIndex}][description]`;
            mediaInput.name = `services[${serviceIndex}][sections][${sectionIndex}][media][]`;
            
            // تهيئة محرر Quill لوصف القسم
            const editorElement = sectionElement.querySelector('.section-description-editor');
            const quill = initQuillEditor(editorElement, descriptionTextarea);
            
            // تهيئة رفع الملفات المتعددة
            initMultiFileUpload(sectionElement, serviceIndex, sectionIndex);
            
            // إضافة مستمع حدث لحذف القسم
            const removeBtn = sectionElement.querySelector('.remove-section');
            removeBtn.addEventListener('click', function() {
                const sectionId = this.closest('.section-item').dataset.sectionId;
                if (sectionId && sectionId.startsWith('new-')) {
                    // قسم جديد - فقط احذفه
                    this.closest('.section-item').remove();
                } else {
                    // قسم موجود - أضفه إلى المحذوفات
                    deletedSections.push(sectionId);
                    document.getElementById('deletedSections').value = JSON.stringify(deletedSections);
                    this.closest('.section-item').remove();
                }
                
                // تحديث عدد الأقسام في الخدمة الأم
                const serviceElement = this.closest('.service-item');
                if (serviceElement) {
                    const sectionsCount = serviceElement.querySelectorAll('.section-item').length;
                    updateServiceSectionsCount(serviceElement, sectionsCount);
                }
            });
            
            container.appendChild(sectionElement);
        }
        
        // تهيئة رفع الملفات المتعددة
        function initMultiFileUpload(sectionElement, serviceIndex, sectionIndex) {
            const uploadArea = sectionElement.querySelector('.multi-file-upload');
            const fileInput = sectionElement.querySelector('.section-media-files');
            const browseBtn = sectionElement.querySelector('.browse-files-btn');
            const fileList = sectionElement.querySelector('.file-list');
            
            // النقر على منطقة الرفع
            uploadArea.addEventListener('click', function(e) {
                if (!e.target.closest('.browse-files-btn')) {
                    fileInput.click();
                }
            });
            
            // زر تصفح الملفات
            browseBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });
            
            // تغيير الملفات
            fileInput.addEventListener('change', function() {
                handleFiles(this.files, fileList);
            });
            
            // السحب والإفلات
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });
            
            uploadArea.addEventListener('dragleave', function() {
                uploadArea.classList.remove('dragover');
            });
            
            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                
                if (e.dataTransfer.files.length) {
                    handleFiles(e.dataTransfer.files, fileList);
                }
            });
        }
        
        // التعامل مع الملفات المختارة
        function handleFiles(files, fileList) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                addFileToList(file, fileList);
            }
        }
        
        // إضافة ملف إلى القائمة
        function addFileToList(file, fileList) {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            
            const fileIcon = getFileIcon(file.type);
            const fileIconColor = getFileIconColor(file.type);
            
            fileItem.innerHTML = `
                <div class="file-info">
                    <div class="file-icon" style="background-color: ${fileIconColor}">
                        ${fileIcon}
                    </div>
                    <div class="file-details">
                        <div class="file-name">${file.name}</div>
                        <div class="file-size">${formatFileSize(file.size)}</div>
                    </div>
                </div>
                <div class="file-actions">
                    <button type="button" class="btn btn-sm btn-outline-danger remove-file">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            
            // إضافة مستمع حدث للحذف
            fileItem.querySelector('.remove-file').addEventListener('click', function() {
                fileItem.remove();
            });
            
            fileList.appendChild(fileItem);
        }
        
        // الحصول على لون لأيقونة الملف
        function getFileIconColor(fileType) {
            if (fileType.startsWith('image/')) {
                return 'rgba(76, 201, 240, 0.2)';
            } else if (fileType.startsWith('video/')) {
                return 'rgba(247, 37, 133, 0.2)';
            } else if (fileType.startsWith('audio/')) {
                return 'rgba(67, 97, 238, 0.2)';
            } else if (fileType.includes('pdf')) {
                return 'rgba(220, 53, 69, 0.2)';
            } else if (fileType.includes('word') || fileType.includes('document')) {
                return 'rgba(13, 110, 253, 0.2)';
            } else if (fileType.includes('excel') || fileType.includes('spreadsheet')) {
                return 'rgba(25, 135, 84, 0.2)';
            } else if (fileType.includes('powerpoint') || fileType.includes('presentation')) {
                return 'rgba(255, 193, 7, 0.2)';
            } else {
                return 'rgba(108, 117, 125, 0.2)';
            }
        }
        
        // تحديث عدد أقسام الخدمة
        function updateServiceSectionsCount(serviceElement, count) {
            const countElement = serviceElement.querySelector('.service-sections-count');
            if (countElement) {
                countElement.textContent = count;
            }
        }
        
        // إضافة شريحة
        document.getElementById('addSlideBtn').addEventListener('click', function() {
            addSlide();
        });
        
        function addSlide() {
            const slideClone = document.getElementById('slideTemplate').content.cloneNode(true);
            slideCount++;
            updateCounter('slidesCount', slideCount);
            
            const slideElement = slideClone.querySelector('.slide-item');
            const slideIndex = slideCount - 1;
            
            // إضافة أسماء الحقول الصحيحة
            const nameInput = slideElement.querySelector('.slide-name');
            const imageInput = slideElement.querySelector('.slide-image');
            const descriptionTextarea = slideElement.querySelector('.slide-description');
            
            nameInput.name = `slides[${slideIndex}][name]`;
            imageInput.name = `slides[${slideIndex}][image]`;
            descriptionTextarea.name = `slides[${slideIndex}][description]`;
            
            // تهيئة محرر Quill لوصف الشريحة
            const editorElement = slideElement.querySelector('.slide-description-editor');
            const quill = initQuillEditor(editorElement, descriptionTextarea);
            
            // إضافة مستمع حدث لحذف الشريحة
            const removeBtn = slideElement.querySelector('.remove-slide');
            removeBtn.addEventListener('click', function() {
                const slideId = this.closest('.slide-item').dataset.slideId;
                if (slideId && slideId.startsWith('new-')) {
                    // شريحة جديدة - فقط احذفها
                    this.closest('.slide-item').remove();
                } else {
                    // شريحة موجودة - أضفها إلى المحذوفات
                    deletedSlides.push(slideId);
                    document.getElementById('deletedSlides').value = JSON.stringify(deletedSlides);
                    this.closest('.slide-item').remove();
                }
                
                if (slideCount <= 1) {
                    alert('يجب أن يكون هناك شريحة هيدر واحدة على الأقل');
                    return;
                }
                
                slideCount--;
                updateCounter('slidesCount', slideCount);
            });
            
            document.getElementById('slidesContainer').appendChild(slideElement);
        }
        
        // حذف وسائط موجودة
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-existing-media')) {
                const button = e.target.closest('.remove-existing-media');
                const mediaId = button.getAttribute('data-media-id');
                
                if (confirm('هل أنت متأكد من حذف هذه الوسائط؟')) {
                    deletedMedia.push(mediaId);
                    document.getElementById('deletedMedia').value = JSON.stringify(deletedMedia);
                    button.closest('.file-item').remove();
                }
            }
        });
        
        // تهيئة المحررات النصية الموجودة
        function initExistingEditors() {
            // محرر وصف البائع
            const vendorDescEditor = document.getElementById('vendorDescriptionEditor');
            const vendorDescInput = document.getElementById('vendorDescription');
            if (vendorDescEditor && vendorDescInput) {
                initQuillEditor(vendorDescEditor, vendorDescInput);
            }
            
            // محرر about البائع
            const vendorAboutEditor = document.getElementById('vendorAboutUsEditor');
            const vendorAboutInput = document.getElementById('vendorAboutUs');
            if (vendorAboutEditor && vendorAboutInput) {
                initQuillEditor(vendorAboutEditor, vendorAboutInput);
            }
            
            // محررات الخدمات الموجودة
            document.querySelectorAll('.service-description-editor').forEach((editor, index) => {
                const hiddenTextarea = editor.nextElementSibling;
                if (hiddenTextarea && hiddenTextarea.tagName === 'TEXTAREA') {
                    initQuillEditor(editor, hiddenTextarea);
                }
            });
            
            // محررات الأقسام الموجودة
            document.querySelectorAll('.section-description-editor').forEach((editor, index) => {
                const hiddenTextarea = editor.nextElementSibling;
                if (hiddenTextarea && hiddenTextarea.tagName === 'TEXTAREA') {
                    initQuillEditor(editor, hiddenTextarea);
                }
            });
            
            // محررات الشرائح الموجودة
            document.querySelectorAll('.slide-description-editor').forEach((editor, index) => {
                const hiddenTextarea = editor.nextElementSibling;
                if (hiddenTextarea && hiddenTextarea.tagName === 'TEXTAREA') {
                    initQuillEditor(editor, hiddenTextarea);
                }
            });
        }
        
        // معاينة الصور عند التحميل
        function initImagePreviews() {
            // شعار البائع
            const logoInput = document.getElementById('vendorLogo');
            if (logoInput) {
                logoInput.addEventListener('change', function() {
                    previewSingleFile(this, document.getElementById('logoPreview'));
                });
            }
            
            // صورة البائع
            const imageInput = document.getElementById('vendorImage');
            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    previewSingleFile(this, document.getElementById('imagePreview'));
                });
            }
            
            // صورة about
            const aboutImageInput = document.getElementById('vendorAboutImage');
            if (aboutImageInput) {
                aboutImageInput.addEventListener('change', function() {
                    previewSingleFile(this, document.getElementById('aboutImagePreview'));
                });
            }
        }
        
        // تهيئة الخرائط والمحررات عند تحميل الصفحة
        window.addEventListener('DOMContentLoaded', function() {
            // تهيئة الخرائط
            initMap();
            
            // تهيئة المحررات النصية الموجودة
            initExistingEditors();
            
            // تهيئة معاينة الصور
            initImagePreviews();
            
            // إذا لم تكن هناك خدمات، أضف واحدة افتراضية
            if (serviceCount === 0) {
                addService();
            }
            
            // إذا لم تكن هناك شرائح، أضف واحدة افتراضية
            if (slideCount === 0) {
                addSlide();
            }
        });
    </script>
</body>
</html>