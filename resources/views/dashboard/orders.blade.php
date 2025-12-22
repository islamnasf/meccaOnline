@include('dashboard.layouts.header')

<div class="container-fluid mt-5 px-3 px-md-4" dir="rtl">
    {{-- عنوان الصفحة --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">
            <i class="bi bi-bag-check me-2"></i>إدارة الطلبات
        </h4>
    </div>

    @php
        $statuses = [
            'waiting' => ['title' => 'انتظار', 'icon' => 'hourglass-split', 'bg' => 'secondary'],
            'processing' => ['title' => 'قيد التنفيذ', 'icon' => 'clock-history', 'bg' => 'warning'],
            'approved' => ['title' => 'موافقة', 'icon' => 'check-circle', 'bg' => 'success'],
            'rejected' => ['title' => 'رفض', 'icon' => 'x-circle', 'bg' => 'danger'],
        ];
        $currentStatus = request('status');
    @endphp

    {{-- كروت الإحصائيات --}}
    <div class="row g-3 mb-4">
        {{-- كل الطلبات --}}
        
        <div class="col-md-12 mb-2">
            <a href="{{ route('orders.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 rounded-4 p-3 transition-all 
                    {{ is_null($currentStatus) ? 'border border-primary border-3 shadow' : '' }}"
                    style="background: linear-gradient(45deg, #4e73df, #224abe); color: white;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-grid-fill fs-1 me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-0">جميع الطلبات</h5>
                                <small>عرض كافة الحالات</small>
                            </div>
                        </div>
                  
                    </div>
                </div>
            </a>
        </div>

        {{-- بطاقات حسب الحالة --}}
        @foreach($statuses as $key => $status)
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('orders.index', ['status' => $key]) }}" class="text-decoration-none">
                    <div
                        class="card text-center shadow-sm border-0 rounded-4 bg-{{ $status['bg'] }} text-white p-3 h-100 transition-all
                                                    {{ $currentStatus == $key ? 'border border-dark border-3 shadow-lg scale-up' : 'opacity-50' }}">
                        <i class="bi bi-{{ $status['icon'] }} fs-2 mb-2"></i>
                        <h6 class="fw-bold">{{ $status['title'] }}</h6>
                        <div class="mt-2">
                            <small class="d-block">العدد: {{ $stats[$key]->total_orders ?? 0 }}</small>
                            <small class="d-block">المجموع: {{ $stats[$key]->total_price ?? 0 }} ر.س</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- جدول الطلبات --}}
    <div class="card content-card mb-5 border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-table me-2"></i>جدول إدارة الطلبات</h5>
              @auth
    @if(auth()->user()->role !== "1")
            <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle me-1"></i> إضافة طلب جديد
            </button>
              @endif
@endauth
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="datatable" class="table table-hover align-middle mb-0 text-center">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">المستخدم</th>
                            <th class="text-center">اسم الطلب</th>
                            <th class="text-center">نوع الطلب</th>
                            <th class="text-center">الفندق</th>
                            <th class="text-center">المكان</th>
                            <th class="text-center">الملف</th>
                            <th class="text-center">السعر</th>
                            <th class="text-center">الكمية</th>
                            <th class="text-center">الوحده</th>
                            <th class="text-center">الوصف</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">عرض السعر</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->type ?? '-' }}</td>
                                            <td>{{ $order->hotel?->name ?? '-' }}</td>
                                            <td>{{ $order->place ?? '-' }}</td>
                                            <td>
                                                {{-- عرض الملف --}}
                                                @if($order->file)
                                                    @php $ext = pathinfo($order->file, PATHINFO_EXTENSION); @endphp
                                                    @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset($order->file) }}" alt="file" class="order-image"
                                                            style="width:50px; height:50px; object-fit:cover; border-radius:5px; cursor:pointer;"
                                                            onclick="showImageModal('{{ asset($order->file) }}')">
                                                    @elseif(strtolower($ext) === 'pdf')
                                                        <a href="{{ asset($order->file) }}" target="_blank" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-file-earmark-pdf"></i> PDF
                                                        </a>
                                                    @else
                                                        <a href="{{ asset($order->file) }}" target="_blank">فتح الملف</a>
                                                    @endif
                                                @else
                                                    <span class="text-muted">لا يوجد ملف</span>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-light text-dark">{{ $order->price }} ر.س</span></td>
                                            <td>{{ $order->count }}</td>
                                            <td>{{ $order->unit ?? '-' }}</td>
                                            <td class="text-truncate" style="max-width: 150px;">{{ $order->description }}</td>
                                            <td>
                                                <span class="badge rounded-pill px-3 py-2
                            @if($order->status == 'waiting') bg-secondary
                            @elseif($order->status == 'processing') bg-warning text-dark
                            @elseif($order->status == 'approved') bg-success
                            @else bg-danger @endif">
                                                    {{ $statuses[$order->status]['title'] ?? $order->status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($order->price_file)
                                                    @php $ext = pathinfo($order->price_file, PATHINFO_EXTENSION); @endphp
                                                    @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset($order->price_file) }}" alt="price_file" class="order-image"
                                                            style="width:50px; height:50px; object-fit:cover; border-radius:5px; cursor:pointer;"
                                                            onclick="showImageModal('{{ asset($order->price_file) }}')">
                                                    @elseif(strtolower($ext) === 'pdf')
                                                        <a href="{{ asset($order->price_file) }}" target="_blank" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-file-earmark-pdf"></i> PDF
                                                        </a>
                                                    @else
                                                        <a href="{{ asset($order->price_file) }}" target="_blank">فتح الملف</a>
                                                    @endif
                                                @else
                                                    <span class="text-muted">لا يوجد ملف</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
  @auth
    @if(auth()->user()->role === "3")
                                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editModal" onclick="editOrder({{ json_encode($order) }})">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
      @endif
@endauth

                                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                                        data-bs-target="#statusModal"
                                                        onclick="setStatus({{ $order->id }}, '{{ $order->status }}')">
                                                        <i class="bi bi-arrow-repeat"></i>
                                                    </button>
                                                      @auth
    @if(auth()->user()->role === "0")
                                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal" onclick="deleteOrder({{ $order->id }})">
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

{{-- مودال عرض الصورة --}}
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-body p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal"></button>
                <img src="" id="modalImage" class="img-fluid w-100" style="border-radius: 8px;">
            </div>
        </div>
    </div>
</div>

{{-- مودال إضافة طلب --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- تم تكبير المودال قليلاً لعرض أفضل --}}
        <form method="POST" action="{{ route('orders.store') }}" class="modal-content border-0 shadow-lg rounded-4"
            enctype="multipart/form-data">
            @csrf
            
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">إضافة طلب جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                
                {{-- الصف الأول: الاسم والنوع --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">اسم الطلب</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="أدخل اسم الطلب" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">نوع الطلب</label>
                        <select name="type" class="form-select rounded-3" required>
                            <option value="" selected disabled>-- اختر النوع --</option>
                            <option value="خدمة">خدمة</option>
                            <option value="منتج">منتج</option>
                        </select>
                    </div>
                </div>

                {{-- الصف الثاني: الفندق والمكان --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">الفندق</label>
                        <select name="hotel_id" class="form-select rounded-3" required>
                            <option value="">اختر الفندق</option>
    @auth
    @if(auth()->user()->role == "2")
        @foreach($hotels as $hotel)
            <option value="{{ $hotel->id }}">
                {{ $hotel->name }}
            </option>
        @endforeach
    @else
        @foreach($allhotels as $hotel)
            <option value="{{ $hotel->id }}">
                {{ $hotel->name }}
            </option>
        @endforeach
    @endif
@endauth

                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">المكان</label>
                        <input type="text" name="place" class="form-control rounded-3" placeholder="أدخل المكان (رقم الغرفة/القسم)">
                    </div>
                </div>

                {{-- الصف الثالث: الملف والكمية --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">تحميل ملف</label>
                        <input type="file" name="file" class="form-control rounded-3">
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label fw-bold">الكمية</label>
                                <input type="number" name="count" class="form-control rounded-3" placeholder="0">
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold">الوحدة</label>
                                <input type="text" name="unit" class="form-control rounded-3" placeholder="حبة/..">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">الوصف وتفاصيل إضافية</label>
                    <textarea name="description" class="form-control rounded-3" rows="3" placeholder="اكتب تفاصيل الطلب هنا..."></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">إضافة الطلب</button>
            </div>
        </form>
    </div>
</div>

{{-- مودال تعديل الطلب --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('orders.update') }}" class="modal-content border-0 shadow-lg rounded-4"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="edit_id">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">تحديث بيانات الطلب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">اسم الطلب</label>
                    <input type="text" name="name" id="edit_name" class="form-control rounded-3">
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">السعر</label>
                        <input type="number" name="price" id="edit_price" class="form-control rounded-3">
                    </div>
<!-- 
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">الكمية</label>
                        <input type="number" name="count" id="edit_count" class="form-control rounded-3">
                    </div> -->
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">عرض سعر </label>
                    <input type="file" name="price_file" class="form-control rounded-3" placeholder="ارفع عرض السعر">
                </div>
                <!-- <div class="mb-3">
                    <label class="form-label fw-bold">الوصف</label>
                    <textarea name="description" id="edit_description" class="form-control rounded-3"
                        rows="3"></textarea>
                </div> -->
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-warning rounded-pill px-4">تحديث البيانات</button>
            </div>
        </form>
    </div>
</div>

{{-- مودال تغيير الحالة --}}
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form method="POST" action="{{ route('orders.status') }}" class="modal-content border-0 shadow-lg rounded-4">
            @csrf
            <input type="hidden" name="id" id="status_id">
            <div class="modal-header border-0">
                <h6 class="fw-bold mb-0">تغيير حالة الطلب</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-0">
                <select name="status" id="status_value" class="form-select form-select-lg rounded-3">
                      @auth
    @if(auth()->user()->role === "3")
                    <option value="waiting">انتظار</option>
                    <option value="processing">قيد التنفيذ</option>
                     @endif
@endauth
 @auth
    @if(auth()->user()->role === "1")
                    <option value="approved">موافقة</option>
                    <option value="rejected">رفض</option>
                      @endif
@endauth
                </select>
            </div>
            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-success w-100 rounded-pill">حفظ الحالة الجديدة</button>
            </div>
        </form>
    </div>
</div>

{{-- مودال الحذف --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form method="POST" action="{{ route('orders.delete') }}" class="modal-content border-0 shadow-lg rounded-4">
            @csrf
            <input type="hidden" name="id" id="delete_id">
            <div class="modal-body text-center py-4">
                <i class="bi bi-exclamation-triangle text-danger display-4 mb-3"></i>
                <h5 class="fw-bold">هل أنت متأكد؟</h5>
                <p class="text-muted small">لا يمكن التراجع عن هذه العملية بعد الحذف</p>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">حذف الآن</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('dashboard.layouts.footer')



<script>
    function editOrder(order) {
        document.getElementById('edit_id').value = order.id;
        document.getElementById('edit_name').value = order.name;
        document.getElementById('edit_price').value = order.price;
        document.getElementById('edit_count').value = order.count;
        document.getElementById('edit_description').value = order.description;
    }

    function setStatus(id, status) {
        document.getElementById('status_id').value = id;
        document.getElementById('status_value').value = status;
    }

    function deleteOrder(id) {
        document.getElementById('delete_id').value = id;
    }

    function showImageModal(src) {
        document.getElementById('modalImage').src = src;
        var modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }
</script>