<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم الإدارية الفخمة</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
    
 rel="stylesheet">
            {!! ToastMagic::styles() !!}

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-dark: #4338ca;
        --secondary-color: #6366f1;
        --light-bg: #f8fafc;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        --hover-shadow: 0 10px 30px rgba(79, 70, 229, 0.15);
        --border-color: #e2e8f0;
    }

    * {
        font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #f5f7ff 0%, #f0f2ff 100%);
        min-height: 100vh;
        padding-bottom: 90px;
        margin: 0;
    }

    /* --- Navbar Styles --- */
    .navbar-custom {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        box-shadow: 0 6px 25px rgba(79, 70, 229, 0.3);
        padding: 0.8rem 0;
    }

    .navbar-custom .navbar-brand {
        font-weight: 800;
        font-size: 1.6rem;
        color: white !important;
    }

    .navbar-custom .navbar-brand i {
        margin-left: 10px;
        font-size: 1.8rem;
    }

    .navbar-custom .nav-link {
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        padding: 0.5rem 1rem;
        margin: 0 4px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .navbar-custom .nav-link:hover,
    .navbar-custom .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: white !important;
    }

    /* --- User Dropdown --- */
    .user-dropdown-toggle {
        display: flex;
        align-items: center;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        background-color: rgba(255, 255, 255, 0.15);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .user-dropdown-toggle:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        margin-left: 10px;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .user-dropdown-info small {
        opacity: 0.8;
        font-weight: 400;
        font-size: 0.85rem;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        padding: 0.5rem 0;
        margin-top: 12px;
                margin-right: -50px;

    }

    .dropdown-item {
        padding: 0.7rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: var(--light-bg);
        color: var(--primary-dark);
    }

    /* --- Stat Cards --- */
    .stat-card {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
        height: 100%;
        cursor: pointer;
        box-shadow: var(--card-shadow);
        position: relative;
        z-index: 1;
    }

    .stat-card:hover {
        transform: translateY(-7px);
        box-shadow: var(--hover-shadow);
    }

    .stat-icon {
        width: 65px;
        height: 65px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        font-size: 2rem;
    }

    .stat-card:nth-child(1) .stat-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
    .stat-card:nth-child(2) .stat-icon { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
    .stat-card:nth-child(3) .stat-icon { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
    .stat-card:nth-child(4) .stat-icon { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; }

    .stat-card h4 {
        font-weight: 800;
        font-size: 2rem;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .stat-card small {
        color: #64748b;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* --- Content Card --- */
    .content-card {
        border-radius: 20px;
        border: none;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        background: white;
        margin-bottom: 2rem;
    }

    .card-header-custom {
        background: var(--light-bg);
        border-bottom: 1px solid var(--border-color);
        padding: 1.2rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .card-header-custom h5 {
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        border-radius: 12px;
        padding: 0.7rem 1.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.2);
        color: white;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
        color: white;
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
    }

    /* --- DataTables Customization (Responsive Fixes) --- */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* Smooth scroll on iOS */
        padding-bottom: 10px;
    }

    /* تخصيص شريط التمرير للجدول */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .dataTables_wrapper {
        width: 100% !important;
        padding: 0;
    }

    #datatable {
        width: 100% !important;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0 !important;
    }

    #datatable thead th {
        background-color: #f8fafc;
        font-weight: 700;
        color: #475569;
        border-bottom: 2px solid var(--border-color);
        padding: 1.2rem 1rem;
        font-size: 0.9rem;
        white-space: nowrap; /* منع التفاف النص في العناوين */
        vertical-align: middle;
    }

    #datatable tbody td {
        padding: 1rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        white-space: nowrap; /* منع التفاف النص لضمان شكل مرتب */
    }

    /* Badges & Buttons inside table */
    .badge-status {
        padding: 0.5rem 1rem;
        font-weight: 700;
        border-radius: 50px;
        font-size: 0.75rem;
        display: inline-block;
    }

    .badge-active { background-color: #dcfce7; color: #166534; }
    .badge-inactive { background-color: #fee2e2; color: #991b1b; }

    .btn-action {
        border-radius: 10px;
        padding: 0.5rem 0.9rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        margin: 0 2px;
    }

    /* DataTable Pagination & Controls */
    .dataTables_wrapper .row {
        margin: 0; /* إصلاح هوامش بوتستراب داخل الجدول */
        padding: 10px;
    }

    .dataTables_length label,
    .dataTables_filter label {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 0;
        font-weight: 500;
        color: #64748b;
    }

    .dataTables_filter input,
    .dataTables_length select {
        border-radius: 10px !important;
        border: 1px solid var(--border-color) !important;
        padding: 6px 12px !important;
        outline: none;
        transition: border-color 0.3s;
    }

    .dataTables_filter input:focus,
    .dataTables_length select:focus {
        border-color: var(--primary-color) !important;
    }

    .dataTables_paginate {
        margin-top: 15px !important;
        display: flex;
        justify-content: flex-end;
        gap: 5px;
    }

    .dataTables_paginate .paginate_button {
        padding: 0.4rem 0.8rem !important;
        border-radius: 8px !important;
        border: 1px solid var(--border-color) !important;
        background: white !important;
        color: #64748b !important;
        margin: 0 !important;
        cursor: pointer;
    }

    .dataTables_paginate .paginate_button:hover {
        background: #f1f5f9 !important;
        color: var(--primary-dark) !important;
        border-color: #cbd5e1 !important;
    }

    .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        color: white !important;
        border: none !important;
    }

    /* --- Modals & Forms --- */
    .form-control-lg-custom {
        border-radius: 12px;
        padding: 0.9rem 1rem;
        border: 1px solid var(--border-color);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .form-control-lg-custom:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        outline: none;
    }

    .modal-content {
        border-radius: 25px;
        border: none;
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid var(--border-color);
        padding: 1.5rem;
    }

    /* --- Mobile Bottom Navigation --- */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 -10px 25px rgba(0, 0, 0, 0.05);
        display: none;
        z-index: 1000;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        padding-bottom: env(safe-area-inset-bottom);
    }

    .bottom-nav a {
        flex: 1;
        text-align: center;
        padding: 12px 0;
        color: #94a3b8;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.75rem;
        transition: all 0.3s ease;
    }

    .bottom-nav a.active {
        color: var(--primary-color);
        background-color: #f8fafc;
    }

    .bottom-nav i {
        font-size: 1.4rem;
        display: block;
        margin-bottom: 4px;
    }

    /* --- Responsive & Mobile Styles --- */
    @media (max-width: 991px) {
        .navbar-nav .nav-item { text-align: right; margin-bottom: 5px; }
        .user-dropdown-info { display: none !important; }
        .user-dropdown-toggle { padding: 0.2rem 0.5rem; }
    }

    @media (max-width: 768px) {
        body { padding-bottom: 80px; }
        .bottom-nav { display: flex; }
        
        .navbar-collapse {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            padding: 1rem;
            border-radius: 15px;
            margin-top: 10px;
        }

        .stat-card { margin-bottom: 15px; }
        .card-header-custom {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }
        .card-header-custom .btn { width: 100%; }

        /* Mobile Table Optimization */
        .dataTables_wrapper .row {
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        
        .dataTables_filter {
            width: 100%;
            text-align: center;
        }
        
        .dataTables_filter label {
            width: 100%;
            justify-content: center;
        }
        
        .dataTables_filter input {
            width: 100% !important;
            margin-left: 0 !important;
        }

        .dataTables_paginate {
            justify-content: center;
            flex-wrap: wrap;
        }

        /* تقليل الحشوة والخطوط في الموبايل */
        #datatable thead th, 
        #datatable tbody td {
            padding: 0.8rem 0.6rem !important;
            font-size: 0.85rem !important;
        }
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        /* تحسينات إضافية للشاشات الصغيرة جداً */
        .dataTables_length, .dataTables_info {
            display: none; /* إخفاء معلومات الصفحة لتوفير المساحة */
        }
        
        .dataTables_filter input {
            font-size: 16px; /* منع التكبير التلقائي في آيفون */
        }
        
        #datatable thead th, 
        #datatable tbody td {
            font-size: 0.8rem !important;
        }
        
        .btn-action {
            padding: 0.3rem 0.6rem;
            font-size: 0.8rem;
        }
    }
</style>

    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-speedometer2"></i>
                لوحة التحكم
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door me-1"></i>
                            الرئيسية
                        </a>
                    </li>

                    <!-- <li class="nav-item dropdown"> -->
                                            <li class="nav-item ">
                        <!-- <a class="nav-link dropdown-toggle" href="{{ route('hotels.index') }}" id="reportsDropdown" role="button"
                            data-bs-toggle="dropdown"> -->
                        @auth
@if(in_array(auth()->user()->role, ["0", "1"]))
         <a class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}" 
           href="{{ route('categories.index') }}">
            <i class="bi bi-file-text me-1"></i>
            الاقسام
        </a>
    @endif
@endauth
                        <!-- <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reportsDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up me-2"></i>تقارير المبيعات</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-people me-2"></i>تقارير المستخدمين</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-bar-chart me-2"></i>تقارير الأداء</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>تصدير جميع
                                    التقارير</a></li>
                        </ul> -->
                    </li>
                            <li class="nav-item ">
                        <!-- <a class="nav-link dropdown-toggle" href="{{ route('hotels.index') }}" id="reportsDropdown" role="button"
                            data-bs-toggle="dropdown"> -->
                        @auth
@if(in_array(auth()->user()->role, ["0", "1"]))
         <a class="nav-link {{ request()->routeIs('vendors.index') ? 'active' : '' }}" 
           href="{{ route('vendors.index') }}">
            <i class="bi bi-flag me-1"></i>
            المشاريع
        </a>
    @endif
@endauth
                        <!-- <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reportsDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up me-2"></i>تقارير المبيعات</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-people me-2"></i>تقارير المستخدمين</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-bar-chart me-2"></i>تقارير الأداء</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>تصدير جميع
                                    التقارير</a></li>
                        </ul> -->
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('getUser') ? 'active' : '' }}" href="#" id="managementDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-1"></i>
                            الإدارة
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="managementDropdown">
                            @auth
    @if(auth()->user()->role === "0")
                            <li><a class="dropdown-item {{ request()->routeIs('getUser') ? 'active' : '' }}" href="{{ route('getUser') }}"><i
                                        class="bi bi-person me-2"></i>إدارة المستخدمين</a></li>
                                        @endif
@endauth
                            <li><a class="dropdown-item   {{ request()->routeIs('orders.index') ? 'active' : '' }}" href="{{ route('orders.index') }}" ><i class="bi bi-shield-check me-2"></i>الطلبات</a>
                            </li>
                            <!-- <li><a class="dropdown-item" href="#"><i class="bi bi-card-checklist me-2"></i>إدارة
                                    المحتوى</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-cash-coin me-2"></i>المدفوعات</a></li> -->
                        </ul>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-question-circle me-1"></i>
                            المساعدة
                        </a>
                    </li> -->
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <div class="text-white text-decoration-none user-dropdown-toggle" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">{{ mb_substr(auth()->user()->name, 0, 1, 'UTF-8') }}</div>
                            <div class="d-none d-lg-flex flex-column align-items-start me-2 user-dropdown-info">
                                <span class="fw-bold">{{ auth()->user()->name }}</span>
                            </div>
                            <i class="bi bi-chevron-down me-1 d-lg-block d-none"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>الملف الشخصي</a></li>
                          
                            <li>
                               

                            <form method="post" action="{{ route('logout') }}" class="text-danger">
                                @csrf
                                <button type="submit" class=" dropdown-item text-danger"> تسجيل الخروج</button>
                            </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="bottom-nav d-flex d-lg-none">
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door"></i>
        <span>الرئيسية</span>
    </a>
    <a href="{{ route('getUser') }}" class="{{ request()->routeIs('getUser') ? 'active' : '' }}">
        <i class="bi bi-table"></i>
        <span>المستخدمين</span>
    </a>
    <a href="#" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-circle"></i>
        <span>إضافة</span>
    </a>
    <a href="#">
        <i class="bi bi-graph-up"></i>
        <span>التقارير</span>
    </a>
    <a href="#">
        <i class="bi bi-gear"></i>
        <span>الإعدادات</span>
    </a>
</div>
