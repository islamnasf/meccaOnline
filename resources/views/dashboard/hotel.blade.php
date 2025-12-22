@include('dashboard.layouts.header')

<style>
    .content-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .07);
    }

    .hotel-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: bold;
    }

    .btn-action {
        border-radius: 50%;
        width: 34px;
        height: 34px;
        padding: 0;
    }

    /* تصميم التاجات (Chips) */
    .user-tag {
        background: #e9ecef;
        border: 1px solid #dee2e6;
        padding: 5px 12px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .user-tag:hover {
        background: #f8d7da;
        border-color: #f5c2c7;
    }

    .btn-remove-user {
        border: none;
        background: transparent;
        color: #dc3545;
        margin-right: 8px;
        cursor: pointer;
        font-weight: bold;
        padding: 0 4px;
    }

    /* تحسين شكل Select2 إذا كنت تستخدمه */
    .select2-container--bootstrap-5 .select2-selection {
        border-radius: 10px;
    }
</style>

<div class="container-fluid mt-5 px-3 px-md-4">

    <div class="card content-card mb-5">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold">
                <i class="bi bi-building me-2"></i>إدارة الفنادق
            </h5>
            @auth
                @if(auth()->user()->role === "0")
                    <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addHotelModal">
                        <i class="bi bi-plus-circle me-1"></i>إضافة فندق
                    </button>
                @endif
            @endauth
        </div>

        <div class="card-body p-0">
            <div class="table-responsive p-2">
                <table id="datatable" class="table table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">اسم الفندق</th>
                            <th class="text-center">تاريخ الإضافة</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hotels as $hotel)
                            <tr>
                                <td class="fw-bold text-center">{{ $hotel->id }}</td>

                                <td>
                                    <a href="{{ route('hotel_details.index', $hotel->id) }}" class="text-decoration-none text-dark">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="hotel-avatar me-2"
                                                style="background: linear-gradient(135deg,#667eea,#764ba2);">
                                                {{ mb_substr($hotel->name, 0, 1, 'UTF-8') }}
                                            </div>
                                            <span class="fw-semibold">{{ $hotel->name }}</span>
                                        </div>
                                    </a>
                                </td>

                                <td class="text-center">
                                    {{ $hotel->created_at->format('Y-m-d') }}
                                </td>

                                <td class="text-center">
                                    @auth
                                        @if(auth()->user()->role === "0")
                                            <button class="btn btn-outline-info btn-action me-1" data-bs-toggle="modal"
                                                data-bs-target="#hotelUsersModal"
                                                onclick="manageHotelUsers({{ json_encode($hotel) }})" title="إدارة المستخدمين">
                                                <i class="bi bi-people"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-action me-1" data-bs-toggle="modal"
                                                data-bs-target="#editHotelModal" onclick="editHotel({{ json_encode($hotel) }})">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <button class="btn btn-outline-danger btn-action" data-bs-toggle="modal"
                                                data-bs-target="#deleteHotelModal" onclick="deleteHotel({{ $hotel->id }})">
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

{{-- Add Modal --}}
<div class="modal fade" id="addHotelModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('hotels.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5><i class="bi bi-building-add me-2"></i>إضافة فندق</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label class="form-label fw-bold">اسم الفندق</label>
                <input type="text" name="name" class="form-control form-control-lg-custom" required>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary-custom rounded-pill px-4">حفظ</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editHotelModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('hotels.update') }}" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="edit_hotel_id">

            <div class="modal-header">
                <h5><i class="bi bi-pencil-square me-2"></i>تعديل الفندق</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label class="form-label fw-bold">اسم الفندق</label>
                <input type="text" name="name" id="edit_hotel_name" class="form-control form-control-lg-custom"
                    required>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-warning rounded-pill px-4">تحديث</button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteHotelModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('hotels.delete') }}" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="delete_hotel_id">

            <div class="modal-header">
                <h5 class="text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>تأكيد الحذف
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <p class="fw-bold">هل أنت متأكد من حذف هذا الفندق؟</p>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-danger rounded-pill px-4">حذف</button>
            </div>
        </form>
    </div>
</div>
{{-- Hotel Users Modal --}}
<div class="modal fade" id="hotelUsersModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form method="POST" action="{{ route('hotels.assignUsers') }}"
            class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
            @csrf
            <input type="hidden" name="hotel_id" id="hotel_users_id">

            <div class="modal-header border-0 bg-primary bg-gradient text-white p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                        style="width: 45px; height: 45px;">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-0">إدارة مستخدمي الفندق</h5>
                        <small class="opacity-75">تخصيص الصلاحيات والوصول للموظفين</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 p-lg-5">
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <label class="form-label fw-bold mb-0 text-dark">
                            <i class="bi bi-person-check-fill text-success me-1"></i>
                            المستخدمون المرتبطون حالياً
                        </label>
                    </div>

                    <div id="selectedUsersContainer"
                        class="d-flex flex-wrap gap-2 p-3 border border-dashed rounded-4 bg-light"
                        style="min-height: 80px; transition: all 0.3s ease;">
                        <div class="text-muted w-100 text-center py-2 empty-state">
                            <small>لا يوجد مستخدمين مرتبطين حالياً</small>
                        </div>
                    </div>
                </div>

                <div class="divider d-flex align-items-center my-4">
                    <hr class="flex-grow-1 text-muted opacity-25">
                    <span class="mx-3 text-muted small fw-bold">إضافة جديدة</span>
                    <hr class="flex-grow-1 text-muted opacity-25">
                </div>

                <div class="mb-2">
                    <label for="hotel_users_select" class="form-label fw-bold mb-2">
                        <i class="bi bi-plus-circle-dotted text-primary me-1"></i> اختر الموظفين
                    </label>
                    <div class="input-group-custom">
                        <select name="user_ids[]" id="hotel_users_select" class="form-select select2-custom py-3"
                            multiple>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" data-email="{{ $user->email }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div
                        class="d-flex align-items-start mt-3 p-3 bg-info bg-opacity-10 border border-info border-opacity-25 rounded-3">
                        <i class="bi bi-info-circle-fill text-info me-2 fs-5"></i>
                        <small class="text-secondary leading-sm">
                            اختر واحدًا أو أكثر من القائمة .
                        </small>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 bg-light p-4">

                <button type="button" class="btn btn-outline-secondary px-4 rounded-pill"
                    data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm fw-bold">
                    <i class="bi bi-save2 me-2"></i> حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>

@include('dashboard.layouts.footer')

{{-- DataTable --}}
<script>

    function editHotel(hotel) {
        $('#edit_hotel_id').val(hotel.id);
        $('#edit_hotel_name').val(hotel.name);
    }

    function deleteHotel(id) {
        $('#delete_hotel_id').val(id);
    }
    function manageHotelUsers(hotel) {
        $('#hotel_users_id').val(hotel.id);

        // إزالة أي تحديد سابق
        $('#hotel_users_select option').prop('selected', false);

        // مسح قائمة المستخدمين المختارين في الأعلى
        $('#selectedUsersList').empty();

        // تحديد المستخدمين الحاليين وإظهارهم في القائمة
        if (hotel.users && hotel.users.length > 0) {
            hotel.users.forEach(user => {
                $('#hotel_users_select option[value="' + user.id + '"]').prop('selected', true);

                // إضافة المستخدم للقائمة فوق
                $('#selectedUsersList').append(
                    '<li class="list-group-item list-group-item-info">' + user.name + ' - ' + user.email + '</li>'
                );
            });
        }

        // إعادة تهيئة المودال لو تستخدم Select2 أو plugin آخر
        $('#hotel_users_select').trigger('change');
    }
    function manageHotelUsers(hotel) {
        $('#hotel_users_id').val(hotel.id);
        const container = $('#selectedUsersContainer');
        const select = $('#hotel_users_select');

        container.empty();
        select.val(null).trigger('change'); // إعادة تصفير السيلكت

        if (hotel.users && hotel.users.length > 0) {
            hotel.users.forEach(user => {
                // 1. إضافة التاج في الحاوية العلوية
                const tag = `
                <div class="user-tag" id="user-tag-${user.id}">
                    <span>${user.name}</span>
                    <button type="button" class="btn-remove-user" onclick="removeUserFromList(${user.id})">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>`;
                container.append(tag);

                // 2. تحديد المستخدم في السيلكت (عشان لو عمل حفظ مباشرة يفضلوا موجودين)
                select.find(`option[value="${user.id}"]`).prop('selected', true);
            });
        }

        select.trigger('change');
    }

    // وظيفة إزالة المستخدم من القائمة المرئية والسيلكت
    function removeUserFromList(userId) {
        // إزالة التاج من الواجهة
        $(`#user-tag-${userId}`).fadeOut(200, function () {
            $(this).remove();
        });

        // إلغاء التحديد من السيلكت المخفي
        $(`#hotel_users_select option[value="${userId}"]`).prop('selected', false);
        $('#hotel_users_select').trigger('change');
    }

</script>