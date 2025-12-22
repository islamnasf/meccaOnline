@include('dashboard.layouts.header')

<div class="container-fluid mt-5 px-3 px-md-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-box-seam-fill text-primary me-2"></i>جرد محتويات الفنادق
            </h3>
            <p class="text-muted mb-0">إدارة وتتبع الأصول والعناصر داخل كل فندق</p>
        </div>

        {{-- أزرار التحكم: تظهر فقط للرول 0 و 1 --}}
        @auth
            @if(in_array(auth()->user()->role, ["0", "1"]))
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#manageItemTypesModal">
                    <i class="bi bi-gear-fill me-1"></i> أنواع العناصر
                </button>
                <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addDetailModal">
                    <i class="bi bi-plus-lg me-1"></i> إضافة عنصر جديد
                </button>
            </div>
            @endif
        @endauth
    </div>

    <div class="card content-card">
        <div class=" table-responsive  ">
            <table id="datatable" class="table table-hover">
                <thead>
                   <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">الفندق</th>
                        <th class="text-center">العنصر</th>
                        <th class="text-center">النوع</th>
                        <th class="text-center">العدد</th>
                        <th class="text-center">المكان/الوصف</th>
                        {{-- إظهار رأس عمود الإجراءات فقط للمخولين --}}
                        @if(auth()->check() && in_array(auth()->user()->role, ["0", "1"]))
                            <th class="text-center">الإجراءات</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $detail)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td class="text-center" >
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-2 me-2">
                                    <i class="bi bi-building text-primary"></i>
                                </div>
                                <span class="fw-bold">{{ $detail->hotel->name ?? 'غير محدد' }}</span>
                            </div>
                        </td>
                        <td class="text-center">{{ $detail->name }}</td>
                        <td class="text-center"><span class="badge-type">{{ $detail->itemType->name ?? 'N/A' }}</span></td>
                        <td class="text-center">
                            <span class="fw-bold text-dark">{{ $detail->count }}</span>
                        </td>
                        <td class="text-center"><small class="text-muted">{{ $detail->place ?? 'غير محدد' }}</small></td>
                        
                        {{-- إظهار أزرار الإجراءات داخل الجدول فقط للمخولين --}}
                        @if(auth()->check() && in_array(auth()->user()->role, ["0", "1"]))
                        <td class="text-center">
                            <button class="btn btn-outline-warning btn-action me-1" onclick="editDetail({{ json_encode($detail) }})" data-bs-toggle="modal" data-bs-target="#editDetailModal" title="تعديل">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-action" onclick="prepareDelete({{ $detail->id }})" data-bs-toggle="modal" data-bs-target="#deleteDetailModal" title="حذف">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- حماية الموديلات: لن يتم تحميلها في المتصفح إلا لمن لديه صلاحية --}}
@auth
    @if(in_array(auth()->user()->role, ["0", "1"]))
    
    {{-- Add Modal --}}
    <div class="modal fade" id="addDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('hotel_details.store') }}" class="modal-content">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">إضافة عنصر جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">اختر الفندق</label>
                        <select name="hotel_id" class="form-select border-2" required>
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">نوع العنصر</label>
                        <select name="item_type_id" class="form-select border-2" required>
                            @foreach($itemTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-3">
                        <div class="col-8">
                            <label class="form-label fw-semibold">اسم العنصر</label>
                            <input type="text" name="name" class="form-control border-2" placeholder="مثلاً: مكيف سبلت" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label fw-semibold">العدد</label>
                            <input type="number" name="count" class="form-control border-2" value="1">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-semibold">الموقع داخل الفندق</label>
                        <input type="text" name="place" class="form-control border-2" placeholder="مثلاً: الطابق الثالث - غرفة 302">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-5">حفظ البيانات</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Item Types Management Modal --}}
    <div class="modal fade" id="manageItemTypesModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="fw-bold">إدارة أنواع المحتويات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('item_types.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control border-2" placeholder="نوع جديد (أثاث، أجهزة...)" required>
                            <button class="btn btn-dark px-3" type="submit">إضافة</button>
                        </div>
                    </form>
                    
                    <h6 class="fw-bold mb-3">الأنواع الحالية:</h6>
                    <div class="list-group list-group-flush rounded-3 border">
                        @foreach($itemTypes as $type)
                        <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span><i class="bi bi-tag me-2 text-muted"></i>{{ $type->name }}</span>
                            <form action="{{ route('item_types.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $type->id }}">
                                <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('حذف هذا النوع؟')">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editDetailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('hotel_details.update') }}" class="modal-content">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-header border-0">
                    <h5 class="fw-bold">تعديل بيانات العنصر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">اسم العنصر</label>
                        <input type="text" name="name" id="edit_name" class="form-control border-2" required>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">العدد</label>
                            <input type="number" name="count" id="edit_count" class="form-control border-2">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">المكان</label>
                            <input type="text" name="place" id="edit_place" class="form-control border-2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold">تحديث</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteDetailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <form method="POST" action="{{ route('hotel_details.delete') }}" class="modal-content text-center border-0 shadow">
                @csrf
                <input type="hidden" name="id" id="delete_id">
                <div class="modal-body p-4">
                    <div class="text-danger mb-3">
                        <i class="bi bi-exclamation-triangle-fill display-5"></i>
                    </div>
                    <h5 class="fw-bold">تأكيد الحذف</h5>
                    <p class="text-muted small">هل أنت متأكد من رغبتك في حذف هذا العنصر نهائياً؟</p>
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-3">نعم، احذف</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
@endauth

@include('dashboard.layouts.footer')

<script>
    function editDetail(detail) {
        $('#edit_id').val(detail.id);
        $('#edit_name').val(detail.name);
        $('#edit_count').val(detail.count);
        $('#edit_place').val(detail.place);
    }

    function prepareDelete(id) {
        $('#delete_id').val(id);
    }
</script>