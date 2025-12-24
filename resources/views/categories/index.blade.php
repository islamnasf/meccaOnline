@extends('layouts.app')

@section('title', 'إدارة الفئات')
@section('page-title', 'إدارة الفئات')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page">الفئات</li>
        </ol>
    </nav>
@endsection

@section('actions')
    <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
        <i class="fas fa-plus me-2"></i>إضافة فئة
    </button>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>جميع الفئات
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover datatable">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>الاسم</th>
                                <th>الوصف</th>
                                <th>عدد البائعين</th>
                                <th>الحالة</th>
                                <th>تاريخ الإضافة</th>
                                <th width="120">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <strong>{{ $category->name }}</strong>
                                </td>
                                <td>{{ Str::limit($category->description, 50) }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $category->vendors_count ?? 0 }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }} badge-custom">
                                        {{ $category->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </td>
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-warning edit-category" 
                                                data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}"
                                                data-description="{{ $category->description }}"
                                                data-status="{{ $category->is_active }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" onclick="confirmDelete('{{ route('categories.destroy', $category->id) }}')" 
                                                class="btn btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="createCategoryForm" method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">إضافة فئة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label required">اسم الفئة</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">الوصف</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">نشط</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">تعديل الفئة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label required">اسم الفئة</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">الوصف</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active" value="1">
                            <label class="form-check-label" for="edit_is_active">نشط</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Edit category
        $('.edit-category').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const description = $(this).data('description');
            const status = $(this).data('status');
            
            $('#edit_name').val(name);
            $('#edit_description').val(description);
            $('#edit_is_active').prop('checked', status == 1);
            
            $('#editCategoryForm').attr('action', '{{ route("categories.update", "") }}/' + id);
            $('#editCategoryModal').modal('show');
        });
        
        // Category form submission
        $('#createCategoryForm').on('submit', function(e) {
            e.preventDefault();
            showLoading();
            this.submit();
        });
        
        $('#editCategoryForm').on('submit', function(e) {
            e.preventDefault();
            showLoading();
            this.submit();
        });
    });
</script>
@endpush