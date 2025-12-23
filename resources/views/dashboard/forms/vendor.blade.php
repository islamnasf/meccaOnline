<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج إضافة بائع جديد مع محرر نصوص متقدم</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS for maps -->
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
        
        .btn-add {
            background-color: #e9ecef;
            border: 2px dashed #adb5bd;
            color: #495057;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-add:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .color-preview {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: inline-block;
            margin-left: 10px;
            border: 1px solid #dee2e6;
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
        
        /* Service-Section Connection */
        .section-service-select {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .service-indicator {
            display: inline-flex;
            align-items: center;
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success-color);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-left: 10px;
        }
        
        .service-indicator i {
            margin-left: 5px;
        }
        
        /* File Upload Preview */
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
            transition: all 0.3s;
        }
        
        .file-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
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
        
        .progress {
            height: 8px;
            margin-top: 5px;
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
        
        .uploading {
            opacity: 0.7;
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
            <h1><i class="fas fa-store me-3"></i> إضافة بائع جديد</h1>
            <p class="mb-0 mt-3">املأ النموذج التالي لإضافة بائع جديد إلى النظام مع جميع تفاصيله</p>
        </div>
        
        <!-- Main Form -->
        <form id="vendorForm">
            <div class="form-container">
                <!-- Vendor Basic Information -->
                <h3 class="section-title">المعلومات الأساسية للبائع</h3>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="vendorName" class="form-label required">اسم البائع</label>
                        <input type="text" class="form-control" id="vendorName" placeholder="أدخل اسم البائع" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorCategory" class="form-label required">الفئة</label>
                        <select class="form-select" id="vendorCategory" required>
                            <option selected disabled value="">اختر فئة البائع</option>
                            <option value="1">مطاعم</option>
                            <option value="2">مقاهي</option>
                            <option value="3">تسوق</option>
                            <option value="4">ترفيه</option>
                            <option value="5">خدمات</option>
                        </select>
                    </div>
                    
                    <div class="col-md-12">
                        <label for="vendorDescription" class="form-label">الوصف</label>
                        <div class="editor-container">
                            <div id="vendorDescriptionEditor"></div>
                            <input type="hidden" id="vendorDescription" name="vendorDescription">
                        </div>
                    </div>
                    
                    <!-- About Us Section -->
                    <div class="col-md-12 about-us-section">
                        <label class="form-label">معلومات عن البائع (About Us)</label>
                        <div class="editor-container">
                            <div id="vendorAboutUsEditor"></div>
                            <input type="hidden" id="vendorAboutUs" name="vendorAboutUs">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorEmail" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="vendorEmail" placeholder="example@domain.com">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorPhone1" class="form-label required">رقم الهاتف الرئيسي</label>
                        <input type="text" class="form-control" id="vendorPhone1" placeholder="05xxxxxxxx" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorPhone2" class="form-label">رقم الهاتف الثانوي</label>
                        <input type="text" class="form-control" id="vendorPhone2" placeholder="05xxxxxxxx">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorAddress" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="vendorAddress" placeholder="أدخل عنوان البائع">
                    </div>
                    
                    <!-- Location with Map -->
                    <div class="col-md-12">
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
                                    <input type="text" class="form-control form-control-sm" id="latitude" value="24.7136" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small">خط الطول (Longitude)</label>
                                    <input type="text" class="form-control form-control-sm" id="longitude" value="46.6753" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- File Uploads with Preview -->
                    <div class="col-md-6">
                        <label for="vendorLogo" class="form-label">شعار البائع</label>
                        <input type="file" class="form-control" id="vendorLogo" accept="image/*" onchange="previewSingleFile(this, 'logoPreview')">
                        <div class="file-preview mt-2" id="logoPreview">
                            <i class="fas fa-image fa-2x text-muted"></i>
                            <small class="text-muted mt-2">معاينة الشعار ستظهر هنا</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="vendorImage" class="form-label">صورة البائع</label>
                        <input type="file" class="form-control" id="vendorImage" accept="image/*" onchange="previewSingleFile(this, 'imagePreview')">
                        <div class="file-preview mt-2" id="imagePreview">
                            <i class="fas fa-image fa-2x text-muted"></i>
                            <small class="text-muted mt-2">معاينة الصورة ستظهر هنا</small>
                        </div>
                    </div>
                </div>
                
                <!-- Color Scheme -->
                <h3 class="section-title mt-5">الألوان الخاصة بالبائع</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label for="color1" class="form-label">اللون الأول</label>
                        <div class="d-flex align-items-center">
                            <input type="color" class="form-control form-control-color" id="color1" value="#4361ee" title="اختر اللون الأول">
                            <div class="color-preview" id="color1Preview" style="background-color: #4361ee;"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="color2" class="form-label">اللون الثاني</label>
                        <div class="d-flex align-items-center">
                            <input type="color" class="form-control form-control-color" id="color2" value="#3f37c9" title="اختر اللون الثاني">
                            <div class="color-preview" id="color2Preview" style="background-color: #3f37c9;"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="color3" class="form-label">اللون الثالث</label>
                        <div class="d-flex align-items-center">
                            <input type="color" class="form-control form-control-color" id="color3" value="#4cc9f0" title="اختر اللون الثالث">
                            <div class="color-preview" id="color3Preview" style="background-color: #4cc9f0;"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Vendor Services (Dynamic) -->
                <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                    <h3 class="section-title mb-0">خدمات البائع <span class="counter-badge" id="servicesCount">0</span></h3>
                    <button type="button" class="btn btn-primary" id="addServiceBtn">
                        <i class="fas fa-plus me-2"></i>إضافة خدمة
                    </button>
                </div>
                
                <div id="servicesContainer">
                    <!-- Dynamic services will be added here -->
                </div>
                
                <!-- Vendor Slides (Dynamic) - Required Section -->
                <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                    <div>
                        <h3 class="section-title mb-0">شرائح العرض <span class="counter-badge" id="slidesCount">0</span></h3>
                        <small class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>يجب إضافة شريحة عرض واحدة على الأقل</small>
                    </div>
                    <button type="button" class="btn btn-primary" id="addSlideBtn">
                        <i class="fas fa-plus me-2"></i>إضافة شريحة
                    </button>
                </div>
                
                <div id="slidesContainer">
                    <!-- Dynamic slides will be added here -->
                </div>
                
                <!-- Vendor Sections (Dynamic with Service Selection) -->
                <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                    <h3 class="section-title mb-0">الأقسام <span class="counter-badge" id="sectionsCount">0</span></h3>
                    <button type="button" class="btn btn-primary" id="addSectionBtn">
                        <i class="fas fa-plus me-2"></i>إضافة قسم
                    </button>
                </div>
                
                <div id="sectionsContainer">
                    <!-- Dynamic sections will be added here -->
                </div>
                
                <!-- Submit Button -->
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save me-2"></i>حفظ البائع
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
                    <input type="file" class="form-control service-image" accept="image/*" onchange="previewSingleFile(this, this.closest('.service-item').querySelector('.service-image-preview'))">
                    <div class="file-preview mt-2 service-image-preview">
                        <i class="fas fa-image fa-2x text-muted"></i>
                        <small class="text-muted mt-2">معاينة الصورة ستظهر هنا</small>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label">وصف الخدمة</label>
                    <div class="editor-container">
                        <div class="service-description-editor"></div>
                        <input type="hidden" class="service-description">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">شعار الخدمة</label>
                    <input type="file" class="form-control service-logo" accept="image/*" onchange="previewSingleFile(this, this.closest('.service-item').querySelector('.service-logo-preview'))">
                    <div class="file-preview mt-2 service-logo-preview">
                        <i class="fas fa-image fa-2x text-muted"></i>
                        <small class="text-muted mt-2">معاينة الشعار ستظهر هنا</small>
                    </div>
                </div>
            </div>
        </div>
    </template>
    
    <template id="slideTemplate">
        <div class="dynamic-section slide-item">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-primary mb-0"><i class="fas fa-sliders-h me-2"></i>شريحة العرض</h5>
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
                    <input type="file" class="form-control slide-image" accept="image/*" onchange="previewSingleFile(this, this.closest('.slide-item').querySelector('.slide-image-preview'))">
                    <div class="file-preview mt-2 slide-image-preview">
                        <i class="fas fa-image fa-2x text-muted"></i>
                        <small class="text-muted mt-2">معاينة الصورة ستظهر هنا</small>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label">وصف الشريحة</label>
                    <div class="editor-container">
                        <div class="slide-description-editor"></div>
                        <input type="hidden" class="slide-description">
                    </div>
                </div>
            </div>
        </div>
    </template>
    
    <template id="sectionTemplate">
        <div class="dynamic-section section-item">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-primary mb-0"><i class="fas fa-th-large me-2"></i>قسم جديد</h5>
                <button type="button" class="btn btn-sm btn-remove remove-section">
                    <i class="fas fa-trash me-1"></i>حذف
                </button>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">اسم القسم</label>
                    <input type="text" class="form-control section-name" placeholder="أدخل اسم القسم" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">صورة القسم</label>
                    <input type="file" class="form-control section-image" accept="image/*" onchange="previewSingleFile(this, this.closest('.section-item').querySelector('.section-image-preview'))">
                    <div class="file-preview mt-2 section-image-preview">
                        <i class="fas fa-image fa-2x text-muted"></i>
                        <small class="text-muted mt-2">معاينة الصورة ستظهر هنا</small>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label">وصف القسم</label>
                    <div class="editor-container">
                        <div class="section-description-editor"></div>
                        <input type="hidden" class="section-description">
                    </div>
                </div>
                
                <!-- Service Selection for Section -->
                <div class="col-md-12 section-service-select">
                    <label class="form-label">ارتباط القسم بالخدمة</label>
                    <select class="form-select section-service-id" required>
                        <option selected disabled value="">اختر الخدمة المرتبطة بهذا القسم</option>
                        <!-- Options will be populated dynamically -->
                    </select>
                    <small class="text-muted">يجب اختيار خدمة لربط القسم بها (مطلوب)</small>
                </div>
                
                <!-- Section Media (Multi-file Upload) -->
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                        <h6 class="text-secondary mb-0"><i class="fas fa-photo-video me-2"></i>وسائط القسم</h6>
                        <small class="text-muted">(يمكنك رفع أكثر من ملف في نفس الوقت)</small>
                    </div>
                    
                    <!-- Multi-file Upload Area -->
                    <div class="multi-file-upload" id="multiUpload-{id}">
                        <div class="upload-icon mb-3">
                            <i class="fas fa-cloud-upload-alt fa-3x text-primary"></i>
                        </div>
                        <h5>اسحب وأفلت الملفات هنا</h5>
                        <p class="text-muted">أو انقر لاختيار الملفات</p>
                        <input type="file" class="d-none section-media-files" multiple accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.xlsx,.pptx">
                        <button type="button" class="btn btn-outline-primary mt-3 browse-files-btn">
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
    <!-- Leaflet JS for maps -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Quill Text Editor JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    
    <script>
        // Initialize variables
        let serviceCount = 0;
        let slideCount = 0;
        let sectionCount = 0;
        let servicesList = []; // Store services for dropdown
        
        // Store all Quill editor instances
        let quillEditors = [];
        
        // DOM elements
        const servicesContainer = document.getElementById('servicesContainer');
        const slidesContainer = document.getElementById('slidesContainer');
        const sectionsContainer = document.getElementById('sectionsContainer');
        
        // Template elements
        const serviceTemplate = document.getElementById('serviceTemplate');
        const slideTemplate = document.getElementById('slideTemplate');
        const sectionTemplate = document.getElementById('sectionTemplate');
        
        // Map variables
        let map;
        let marker;
        let defaultLat = 24.7136; // Riyadh coordinates
        let defaultLng = 46.6753;
        
        // Initialize the map
        function initMap() {
            // Create map
            map = L.map('locationMap').setView([defaultLat, defaultLng], 13);
            
            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            // Add marker
            marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);
            
            // Update coordinates when marker is moved
            marker.on('dragend', function(e) {
                const position = marker.getLatLng();
                updateCoordinates(position.lat, position.lng);
            });
            
            // Update coordinates when map is clicked
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateCoordinates(e.latlng.lat, e.latlng.lng);
            });
            
            // Initialize coordinate fields
            updateCoordinates(defaultLat, defaultLng);
        }
        
        // Update coordinate fields
        function updateCoordinates(lat, lng) {
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
        }
        
        // Locate user button
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
        
        // Reset map button
        document.getElementById('resetMapBtn').addEventListener('click', function() {
            map.setView([defaultLat, defaultLng], 13);
            marker.setLatLng([defaultLat, defaultLng]);
            updateCoordinates(defaultLat, defaultLng);
        });
        
        // Color preview update
        document.getElementById('color1').addEventListener('input', function() {
            document.getElementById('color1Preview').style.backgroundColor = this.value;
        });
        
        document.getElementById('color2').addEventListener('input', function() {
            document.getElementById('color2Preview').style.backgroundColor = this.value;
        });
        
        document.getElementById('color3').addEventListener('input', function() {
            document.getElementById('color3Preview').style.backgroundColor = this.value;
        });
        
        // Initialize Quill editor
        function initQuillEditor(editorElement, hiddenInput) {
            const quill = new Quill(editorElement, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                },
                placeholder: 'اكتب محتوى هنا...',
            });
            
            // Update hidden input when editor content changes
            quill.on('text-change', function() {
                hiddenInput.value = quill.root.innerHTML;
            });
            
            // Set initial content
            quill.root.innerHTML = hiddenInput.value || '';
            
            return quill;
        }
        
        // File preview for single file uploads
        function previewSingleFile(input, previewContainer) {
            if (typeof previewContainer === 'string') {
                previewContainer = document.getElementById(previewContainer);
            }
            
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    if (file.type.startsWith('image/')) {
                        previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    } else {
                        const icon = getFileIcon(file.type);
                        previewContainer.innerHTML = `
                            ${icon}
                            <small class="mt-2">${file.name}</small>
                            <small class="text-muted d-block">${formatFileSize(file.size)}</small>
                        `;
                    }
                };
                
                reader.readAsDataURL(file);
            }
        }
        
        // Multi-file upload handling
        function initMultiFileUpload(uploadArea, fileListContainer) {
            const fileInput = uploadArea.querySelector('.section-media-files');
            const browseBtn = uploadArea.querySelector('.browse-files-btn');
            let files = [];
            
            // Click on upload area to trigger file input
            uploadArea.addEventListener('click', function(e) {
                if (!e.target.closest('.browse-files-btn')) {
                    fileInput.click();
                }
            });
            
            // Browse button click
            browseBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });
            
            // File input change
            fileInput.addEventListener('change', function() {
                handleFiles(this.files);
            });
            
            // Drag and drop functionality
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
                    handleFiles(e.dataTransfer.files);
                }
            });
            
            // Handle selected files
            function handleFiles(selectedFiles) {
                for (let i = 0; i < selectedFiles.length; i++) {
                    const file = selectedFiles[i];
                    files.push(file);
                    addFileToList(file);
                }
                
                // Reset file input to allow selecting the same file again
                fileInput.value = '';
            }
            
            // Add file to the list with progress indicator
            function addFileToList(file) {
                const fileId = 'file-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.id = fileId;
                
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
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="file-actions">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-file" data-file-id="${fileId}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                
                fileListContainer.appendChild(fileItem);
                
                // Simulate upload progress
                simulateUploadProgress(fileId, file);
                
                // Add remove file event listener
                fileItem.querySelector('.remove-file').addEventListener('click', function() {
                    const id = this.getAttribute('data-file-id');
                    const item = document.getElementById(id);
                    if (item) {
                        item.remove();
                        // Remove file from array
                        files = files.filter(f => f.name !== file.name && f.size !== file.size);
                    }
                });
            }
            
            // Simulate file upload with progress
            function simulateUploadProgress(fileId, file) {
                const fileItem = document.getElementById(fileId);
                const progressBar = fileItem.querySelector('.progress-bar');
                
                // Add uploading class
                fileItem.classList.add('uploading');
                
                let progress = 0;
                const interval = setInterval(() => {
                    progress += Math.random() * 20;
                    if (progress >= 100) {
                        progress = 100;
                        clearInterval(interval);
                        
                        // Remove uploading class and show success
                        fileItem.classList.remove('uploading');
                        progressBar.classList.add('bg-success');
                        
                        // Add preview for images
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const fileInfo = fileItem.querySelector('.file-info');
                                const imgPreview = document.createElement('div');
                                imgPreview.className = 'ms-3';
                                imgPreview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">`;
                                fileInfo.appendChild(imgPreview);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                    
                    progressBar.style.width = progress + '%';
                    progressBar.setAttribute('aria-valuenow', progress);
                }, 200);
            }
            
            // Return files array for this section
            return {
                getFiles: function() {
                    return files;
                },
                clearFiles: function() {
                    files = [];
                    fileListContainer.innerHTML = '';
                }
            };
        }
        
        // Get appropriate icon for file type
        function getFileIcon(fileType) {
            if (fileType.startsWith('image/')) {
                return '<i class="fas fa-image"></i>';
            } else if (fileType.startsWith('video/')) {
                return '<i class="fas fa-video"></i>';
            } else if (fileType.startsWith('audio/')) {
                return '<i class="fas fa-music"></i>';
            } else if (fileType.includes('pdf')) {
                return '<i class="fas fa-file-pdf"></i>';
            } else if (fileType.includes('word') || fileType.includes('document')) {
                return '<i class="fas fa-file-word"></i>';
            } else if (fileType.includes('excel') || fileType.includes('spreadsheet')) {
                return '<i class="fas fa-file-excel"></i>';
            } else if (fileType.includes('powerpoint') || fileType.includes('presentation')) {
                return '<i class="fas fa-file-powerpoint"></i>';
            } else {
                return '<i class="fas fa-file"></i>';
            }
        }
        
        // Get color for file icon based on type
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
        
        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 بايت';
            const k = 1024;
            const sizes = ['بايت', 'كيلوبايت', 'ميجابايت', 'جيجابايت'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Add Service
        document.getElementById('addServiceBtn').addEventListener('click', function() {
            addService();
        });
        
        function addService() {
            const serviceClone = serviceTemplate.content.cloneNode(true);
            serviceCount++;
            const serviceId = serviceCount;
            
            const serviceElement = serviceClone.querySelector('.service-item');
            serviceElement.dataset.serviceId = serviceId;
            
            // Update service ID display
            serviceElement.querySelector('.service-id-display').textContent = serviceId;
            
            // Store service info for dropdowns
            servicesList.push({
                id: serviceId,
                name: ''
            });
            
            updateCounter('servicesCount', serviceCount);
            
            // Initialize Quill editor for service description
            const editorElement = serviceElement.querySelector('.service-description-editor');
            const hiddenInput = serviceElement.querySelector('.service-description');
            const quill = initQuillEditor(editorElement, hiddenInput);
            quillEditors.push(quill);
            
            // Add remove event listener
            const removeBtn = serviceElement.querySelector('.remove-service');
            removeBtn.addEventListener('click', function() {
                // Remove service from list
                const idToRemove = parseInt(this.closest('.service-item').dataset.serviceId);
                servicesList = servicesList.filter(s => s.id !== idToRemove);
                
                // Remove service from all dropdowns
                document.querySelectorAll('.section-service-id').forEach(select => {
                    for (let i = select.options.length - 1; i >= 0; i--) {
                        if (select.options[i].value == idToRemove) {
                            select.remove(i);
                            break;
                        }
                    }
                });
                
                this.closest('.service-item').remove();
                serviceCount--;
                updateCounter('servicesCount', serviceCount);
            });
            
            // Update service name in list when changed
            const nameInput = serviceElement.querySelector('.service-name');
            nameInput.addEventListener('input', function() {
                const serviceId = parseInt(this.closest('.service-item').dataset.serviceId);
                const service = servicesList.find(s => s.id === serviceId);
                if (service) {
                    service.name = this.value;
                    
                    // Update all dropdowns with this service
                    document.querySelectorAll('.section-service-id').forEach(select => {
                        for (let i = 0; i < select.options.length; i++) {
                            if (select.options[i].value == serviceId) {
                                select.options[i].text = `خدمة #${serviceId}: ${this.value || 'بدون اسم'}`;
                                break;
                            }
                        }
                    });
                }
            });
            
            servicesContainer.appendChild(serviceElement);
            
            // Update all existing section dropdowns
            updateAllSectionDropdowns();
        }
        
        // Add Slide (Required - at least one)
        document.getElementById('addSlideBtn').addEventListener('click', function() {
            addSlide();
        });
        
        function addSlide() {
            const slideClone = slideTemplate.content.cloneNode(true);
            slideCount++;
            updateCounter('slidesCount', slideCount);
            
            const slideElement = slideClone.querySelector('.slide-item');
            
            // Initialize Quill editor for slide description
            const editorElement = slideElement.querySelector('.slide-description-editor');
            const hiddenInput = slideElement.querySelector('.slide-description');
            const quill = initQuillEditor(editorElement, hiddenInput);
            quillEditors.push(quill);
            
            // Add remove event listener
            const removeBtn = slideElement.querySelector('.remove-slide');
            removeBtn.addEventListener('click', function() {
                if (slideCount <= 1) {
                    alert('يجب أن يكون هناك شريحة واحدة على الأقل');
                    return;
                }
                
                this.closest('.slide-item').remove();
                slideCount--;
                updateCounter('slidesCount', slideCount);
            });
            
            slidesContainer.appendChild(slideElement);
        }
        
        // Add Section with Service Selection
        document.getElementById('addSectionBtn').addEventListener('click', function() {
            if (serviceCount === 0) {
                alert('يجب إضافة خدمة واحدة على الأقل قبل إضافة قسم');
                return;
            }
            addSection();
        });
        
        function addSection() {
            const sectionClone = sectionTemplate.content.cloneNode(true);
            sectionCount++;
            updateCounter('sectionsCount', sectionCount);
            
            const sectionElement = sectionClone.querySelector('.section-item');
            
            // Initialize Quill editor for section description
            const editorElement = sectionElement.querySelector('.section-description-editor');
            const hiddenInput = sectionElement.querySelector('.section-description');
            const quill = initQuillEditor(editorElement, hiddenInput);
            quillEditors.push(quill);
            
            // Initialize multi-file upload for this section
            const uploadArea = sectionElement.querySelector('.multi-file-upload');
            const fileListContainer = sectionElement.querySelector('.file-list');
            const uploadId = 'upload-' + Date.now();
            uploadArea.id = uploadId;
            
            const fileUploadManager = initMultiFileUpload(uploadArea, fileListContainer);
            
            // Add remove event listener for section
            const removeBtn = sectionElement.querySelector('.remove-section');
            removeBtn.addEventListener('click', function() {
                this.closest('.section-item').remove();
                sectionCount--;
                updateCounter('sectionsCount', sectionCount);
            });
            
            // Populate service dropdown
            const serviceSelect = sectionElement.querySelector('.section-service-id');
            updateServiceDropdown(serviceSelect);
            
            sectionsContainer.appendChild(sectionElement);
            
            // Store file upload manager reference
            sectionElement.fileUploadManager = fileUploadManager;
        }
        
        // Update a single service dropdown
        function updateServiceDropdown(selectElement) {
            // Clear existing options except first
            while (selectElement.options.length > 1) {
                selectElement.remove(1);
            }
            
            // Add services to dropdown
            servicesList.forEach(service => {
                const option = document.createElement('option');
                option.value = service.id;
                option.textContent = `خدمة #${service.id}: ${service.name || 'بدون اسم'}`;
                selectElement.appendChild(option);
            });
        }
        
        // Update all section dropdowns
        function updateAllSectionDropdowns() {
            document.querySelectorAll('.section-service-id').forEach(select => {
                updateServiceDropdown(select);
            });
        }
        
        // Update counter display
        function updateCounter(elementId, count) {
            document.getElementById(elementId).textContent = count;
        }
        
        // Form submission
        document.getElementById('vendorForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            const vendorName = document.getElementById('vendorName').value;
            const vendorCategory = document.getElementById('vendorCategory').value;
            const vendorPhone1 = document.getElementById('vendorPhone1').value;
            
            if (!vendorName || !vendorCategory || !vendorPhone1) {
                alert('يرجى ملء الحقول المطلوبة (المحددة بعلامة النجمة)');
                return;
            }
            
            // Validate at least one slide
            if (slideCount === 0) {
                alert('يجب إضافة شريحة عرض واحدة على الأقل');
                return;
            }
            
            // Validate all slides have names
            let slideValid = true;
            document.querySelectorAll('.slide-item').forEach(item => {
                if (!item.querySelector('.slide-name').value) {
                    slideValid = false;
                }
            });
            
            if (!slideValid) {
                alert('يجب إدخال اسم لكل شريحة عرض');
                return;
            }
            
            // Validate all sections have service selected
            let sectionValid = true;
            document.querySelectorAll('.section-item').forEach(item => {
                const serviceSelect = item.querySelector('.section-service-id');
                if (!serviceSelect.value) {
                    sectionValid = false;
                }
            });
            
            if (sectionCount > 0 && !sectionValid) {
                alert('يجب اختيار خدمة لكل قسم من الأقسام');
                return;
            }
            
            // Collect vendor data
            const vendorData = {
                name: vendorName,
                category_id: vendorCategory,
                description: document.getElementById('vendorDescription').value,
                about_us: document.getElementById('vendorAboutUs').value,
                email: document.getElementById('vendorEmail').value,
                phone1: vendorPhone1,
                phone2: document.getElementById('vendorPhone2').value,
                address: document.getElementById('vendorAddress').value,
                location: `${document.getElementById('latitude').value}, ${document.getElementById('longitude').value}`,
                color1: document.getElementById('color1').value,
                color2: document.getElementById('color2').value,
                color3: document.getElementById('color3').value
            };
            
            // Collect services data
            const services = [];
            document.querySelectorAll('.service-item').forEach(item => {
                services.push({
                    id: parseInt(item.dataset.serviceId),
                    name: item.querySelector('.service-name').value,
                    description: item.querySelector('.service-description').value
                });
            });
            
            // Collect slides data
            const slides = [];
            document.querySelectorAll('.slide-item').forEach((item, index) => {
                slides.push({
                    name: item.querySelector('.slide-name').value,
                    description: item.querySelector('.slide-description').value
                });
            });
            
            // Collect sections data
            const sections = [];
            document.querySelectorAll('.section-item').forEach(sectionItem => {
                const section = {
                    name: sectionItem.querySelector('.section-name').value,
                    description: sectionItem.querySelector('.section-description').value,
                    service_id: sectionItem.querySelector('.section-service-id').value,
                    media: []
                };
                
                // Collect media files for this section
                if (sectionItem.fileUploadManager) {
                    const files = sectionItem.fileUploadManager.getFiles();
                    files.forEach(file => {
                        section.media.push({
                            name: file.name,
                            type: file.type,
                            size: file.size
                        });
                    });
                }
                
                sections.push(section);
            });
            
            // Prepare final data object
            const formData = {
                vendor: vendorData,
                services: services,
                slides: slides,
                sections: sections
            };
            
            // Show loading animation
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<div class="spinner"></div> جاري الحفظ...';
            submitBtn.disabled = true;
            
            // Simulate API call delay
            setTimeout(() => {
                // In a real application, you would send this data to the backend
                console.log('Form Data:', formData);
                
                // Show success message
                alert('تم حفظ بيانات البائع بنجاح! سيتم إرسال البيانات إلى الخادم في التطبيق الفعلي.');
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Reset form
                document.getElementById('vendorForm').reset();
                
                // Reset map to default
                map.setView([defaultLat, defaultLng], 13);
                marker.setLatLng([defaultLat, defaultLng]);
                updateCoordinates(defaultLat, defaultLng);
                
                // Reset counters and containers
                serviceCount = 0;
                slideCount = 0;
                sectionCount = 0;
                servicesList = [];
                quillEditors = [];
                
                updateCounter('servicesCount', serviceCount);
                updateCounter('slidesCount', slideCount);
                updateCounter('sectionsCount', sectionCount);
                
                servicesContainer.innerHTML = '';
                slidesContainer.innerHTML = '';
                sectionsContainer.innerHTML = '';
                
                // Reset color previews
                document.getElementById('color1Preview').style.backgroundColor = '#4361ee';
                document.getElementById('color2Preview').style.backgroundColor = '#3f37c9';
                document.getElementById('color3Preview').style.backgroundColor = '#4cc9f0';
                
                // Reset file previews
                document.getElementById('logoPreview').innerHTML = '<i class="fas fa-image fa-2x text-muted"></i><small class="text-muted mt-2">معاينة الشعار ستظهر هنا</small>';
                document.getElementById('imagePreview').innerHTML = '<i class="fas fa-image fa-2x text-muted"></i><small class="text-muted mt-2">معاينة الصورة ستظهر هنا</small>';
                
                // Reset text editors
                document.getElementById('vendorDescription').value = '';
                document.getElementById('vendorAboutUs').value = '';
                
            }, 2000); // 2 second delay to simulate API call
        });
        
        // Initialize with one of each dynamic section
        window.addEventListener('DOMContentLoaded', function() {
            // Initialize map
            initMap();
            
            // Initialize main text editors
            const vendorDescEditor = initQuillEditor(
                document.getElementById('vendorDescriptionEditor'), 
                document.getElementById('vendorDescription')
            );
            quillEditors.push(vendorDescEditor);
            
            const vendorAboutEditor = initQuillEditor(
                document.getElementById('vendorAboutUsEditor'), 
                document.getElementById('vendorAboutUs')
            );
            quillEditors.push(vendorAboutEditor);
            
            // Add one of each required section
            addService();
            addSlide();
        });
    </script>
</body>
</html>