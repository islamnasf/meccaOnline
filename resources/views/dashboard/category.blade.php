@include('dashboard.layouts.header')

<div class="container-fluid mt-5 px-3 px-md-4">

    <div class="card content-card mb-5">
        <div class="card-header-custom">
            <h5><i class="bi bi-grid me-2"></i>جدول إدارة الأقسام</h5>
            @auth
            @if(auth()->user()->role === "0")
            <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle me-1"></i>إضافة قسم جديد
            </button>
            @endif
            @endauth
        </div>
        <div class="card-body p-0">
            <div class="table-responsive p-1">
                <table id="datatable" class="table table-hover align-middle mb-0">
                    <thead class="table-dark text-right">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">الصورة</th>
                            <th class="text-center">اسم القسم</th>
                            <th class="text-center">الوصف</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="fw-bold text-center">{{ $category->id }}</td>
                                <td class="text-center">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" 
                                             alt="{{ $category->name }}" 
                                             class="category-image rounded"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="no-image-placeholder d-inline-flex align-items-center justify-content-center rounded"
                                             style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <i class="bi bi-image text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center fw-semibold">{{ $category->name }}</td>
                                <td class="text-center">
                                    {{ Str::limit($category->description, 50) }}
                                </td>
                                <td class="text-center">
                                    @auth
                                    @if(auth()->user()->role === "0")
                                    <button class="btn btn-sm btn-outline-warning btn-action me-1" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal" 
                                            onclick="editCategory({{ json_encode($category) }})" 
                                            title="تعديل">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-action" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" 
                                            onclick="deleteCategory({{ $category->id }})" 
                                            title="حذف">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    @endif
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('categories.store') }}" class="modal-content" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5><i class="bi bi-grid me-2"></i>إضافة قسم جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">اسم القسم</label>
                    <input type="text" name="name" class="form-control form-control-lg-custom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">صورة القسم</label>
                    <input type="file" name="image" class="form-control form-control-lg-custom" accept="image/*">
                    <small class="text-muted">الحد الأقصى للحجم: 2MB | الصيغ المسموحة: jpeg, png, jpg, gif</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">الوصف</label>
                    <textarea name="description" class="form-control form-control-lg-custom" rows="3"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary-custom rounded-pill px-4">إضافة القسم</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('categories.update') }}" class="modal-content" enctype="multipart/form-data" id="editForm">
            @csrf
            @method('PUT') <!-- أو @method('PATCH') -->
            
            <input type="hidden" name="id" id="edit_id">

            <div class="modal-header">
                <h5><i class="bi bi-pencil-square me-2"></i>تعديل بيانات القسم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">اسم القسم <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_name" class="form-control form-control-lg-custom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">صورة القسم الحالية</label>
                    <div id="currentImagePreview" class="mb-2">
                        <!-- سيتم عرض الصورة هنا -->
                    </div>
                    
                    <label class="form-label fw-bold">تغيير الصورة (اختياري)</label>
                    <input type="file" name="image" class="form-control form-control-lg-custom" accept="image/*" id="edit_image">
                    <small class="text-muted">اترك الحقل فارغ إذا لم ترغب بتغيير الصورة</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">الوصف</label>
                    <textarea name="description" id="edit_description" class="form-control form-control-lg-custom" rows="3"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-warning rounded-pill px-4" id="updateBtn">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    تحديث البيانات
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('categories.delete') }}" class="modal-content">
            @csrf
            @method('POST')
            <input type="hidden" name="id" id="delete_id">

            <div class="modal-header">
                <h5><i class="bi bi-exclamation-triangle me-2 text-danger"></i>تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <i class="bi bi-trash-fill fs-1 text-danger mb-3"></i>
                <h5 class="fw-bold">هل أنت متأكد من حذف هذا القسم؟</h5>
                <p class="text-muted">سيتم حذف جميع البيانات نهائيًا ولا يمكن التراجع.</p>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-danger rounded-pill px-4">نعم، قم بالحذف</button>
            </div>
        </form>
    </div>
</div>

@include('dashboard.layouts.footer')

<style>
.category-image {
    border: 2px solid #e9ecef;
    transition: transform 0.3s;
}

.category-image:hover {
    transform: scale(1.5);
    z-index: 1000;
}

.no-image-placeholder {
    border: 2px dashed #dee2e6;
}
</style>

<script>
function editCategory(category) {
    console.log('Editing category:', category); // للتأكد من البيانات
    
    // تعبئة الحقول
    document.getElementById('edit_id').value = category.id;
    document.getElementById('edit_name').value = category.name || '';
    document.getElementById('edit_description').value = category.description || '';
    
    // عرض الصورة الحالية
    const imagePreview = document.getElementById('currentImagePreview');
    imagePreview.innerHTML = '';
    
    if (category.image) {
        const img = document.createElement('img');
        img.src = "{{ asset('storage') }}/" + category.image;
        img.alt = category.name;
        img.className = 'img-thumbnail';
        img.style = 'max-width: 150px; max-height: 150px;';
        imagePreview.appendChild(img);
        
        // إضافة زر لحذف الصورة
        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'btn btn-sm btn-danger mt-2';
        deleteBtn.innerHTML = '<i class="bi bi-trash"></i> حذف الصورة';
        deleteBtn.onclick = function() {
            if (confirm('هل تريد حذف الصورة؟')) {
                deleteImage(category.id);
            }
        };
        imagePreview.appendChild(deleteBtn);
    } else {
        imagePreview.innerHTML = '<div class="alert alert-info">لا توجد صورة</div>';
    }
    
    // إعادة تعيين حقل اختيار الصورة
    document.getElementById('edit_image').value = '';
}

function deleteCategory(id) {
    document.getElementById('delete_id').value = id;
}

// حذف الصورة فقط
function deleteImage(categoryId) {
    if (confirm('هل تريد حذف صورة هذا القسم؟')) {
        fetch("{{ route('categories.deleteImage') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: categoryId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('تم حذف الصورة بنجاح');
                location.reload();
            } else {
                alert('حدث خطأ أثناء حذف الصورة');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ في الاتصال');
        });
    }
}

// إضافة مؤشر تحميل عند النقر على تحديث
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editForm');
    const updateBtn = document.getElementById('updateBtn');
    const spinner = updateBtn.querySelector('.spinner-border');
    
    if (editForm) {
        editForm.addEventListener('submit', function() {
            spinner.classList.remove('d-none');
            updateBtn.disabled = true;
            updateBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري التحديث...';
        });
    }
    
    // معاينة الصورة قبل التحميل
    const editImageInput = document.getElementById('edit_image');
    if (editImageInput) {
        editImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'img-thumbnail mt-2';
                    preview.style = 'max-width: 150px; max-height: 150px;';
                    
                    const container = document.getElementById('currentImagePreview');
                    container.innerHTML = '';
                    container.appendChild(preview);
                    container.innerHTML += '<div class="text-success mt-1"><i class="bi bi-check-circle"></i> سيتم استبدال الصورة القديمة</div>';
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>