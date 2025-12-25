@include('dashboard.layouts.header')

<div class="container-fluid mt-5 px-3 px-md-4">

    <div class="card content-card mb-5">
        <div class="card-header-custom">
            <h5><i class="bi bi-shop me-2"></i>جدول إدارة البائعين</h5>
            @auth
            @if(auth()->user()->role === "0")
            <a class="btn btn-primary-custom" href="{{ route('vendors.create') }}">
                <i class="bi bi-plus-circle me-1"></i>إضافة بائع جديد
</a>
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
                            <th class="text-center">الاسم</th>
                            <th class="text-center">التصنيف</th>
                            <th class="text-center">الهاتف</th>
                            <th class="text-center">البريد</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تاريخ الإضافة</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $vendor)
                            <tr>
                                <td class="fw-bold text-center">{{ $vendor->id }}</td>
                                <td class="text-center">
                                    @if($vendor->image)
                                        <img src="{{ asset('storage/' . $vendor->image) }}" 
                                             alt="{{ $vendor->name }}" 
                                             class="vendor-image rounded"
                                             style="width: 50px; height: 50px; object-fit: cover;"
                                             title="{{ $vendor->name }}">
                                    @else
                                        <div class="no-image-placeholder d-inline-flex align-items-center justify-content-center rounded"
                                             style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <i class="bi bi-shop text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center fw-semibold">
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if($vendor->logo_url)
                                            <img src="{{ $vendor->logo_url }}" 
                                                 alt="Logo" 
                                                 class="vendor-logo me-2"
                                                 style="width: 24px; height: 24px; object-fit: contain;">
                                        @endif
                                        <span>{{ $vendor->name }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($vendor->category)
                                        <span class="badge bg-info text-white">
                                            {{ $vendor->category->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">غير محدد</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($vendor->phone1)
                                        <a href="tel:{{ $vendor->phone1 }}" class="text-decoration-none">
                                            {{ $vendor->phone1 }}
                                        </a>
                                        @if($vendor->phone2)
                                            <br><small class="text-muted">{{ $vendor->phone2 }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted">لا يوجد</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($vendor->email)
                                        <a href="mailto:{{ $vendor->email }}" class="text-decoration-none">
                                            {{ $vendor->email }}
                                        </a>
                                    @else
                                        <span class="text-muted">لا يوجد</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {!! $vendor->status_badge !!}
                                </td>
                                <td class="text-center">{{ $vendor->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- <button class="btn btn-sm btn-outline-info btn-action me-1" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewModal" 
                                                onclick="viewVendor({{ json_encode($vendor) }})" 
                                                title="عرض التفاصيل">
                                            <i class="bi bi-eye"></i>
                                        </button> -->
                                        @auth
                                        @if(auth()->user()->role === "0")
                                        <a class="btn btn-sm btn-outline-warning btn-action me-1" 
                                                
                                                href="{{ route('vendors.edit',$vendor->id) }}">
                                            <i class="bi bi-pencil"></i>
</a>
                                        <button class="btn btn-sm btn-outline-danger btn-action" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" 
                                                onclick="deleteVendor({{ $vendor->id }})" 
                                                title="حذف">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        @endif
                                        @endauth
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






<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('vendors.delete') }}" class="modal-content">
            @csrf
            @method('POST')
            <input type="hidden" name="id" id="delete_id">

            <div class="modal-header">
                <h5><i class="bi bi-exclamation-triangle me-2 text-danger"></i>تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <i class="bi bi-trash-fill fs-1 text-danger mb-3"></i>
                <h5 class="fw-bold">هل أنت متأكد من حذف هذا البائع؟</h5>
                <p class="text-muted">سيتم حذف جميع البيانات والصور نهائيًا ولا يمكن التراجع.</p>
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
.vendor-image, .vendor-logo {
    border: 2px solid #e9ecef;
    transition: transform 0.3s;
}

.vendor-image:hover {
    transform: scale(1.5);
    z-index: 1000;
}

.no-image-placeholder {
    border: 2px dashed #dee2e6;
}

.color-preview {
    width: 20px;
    height: 20px;
    display: inline-block;
    border-radius: 3px;
    margin-right: 5px;
    border: 1px solid #ddd;
}
</style>

<script>

function deleteVendor(id) {
    document.getElementById('delete_id').value = id;
}


</script>