@include('dashboard.layouts.header')

<div class="container-fluid mt-5 px-3 px-md-4">

    <div class="card content-card mb-5">
        <div class="card-header-custom">

            <h5><i class="bi bi-table me-2"></i>جدول إدارة المستخدمين</h5>
              @auth
    @if(auth()->user()->role === "0")
            <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle me-1"></i>إضافة مستخدم جديد
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
                            <th class="text-center">الاسم الكامل</th>
                            <th class="text-center">البريد الإلكتروني</th>
                            <th class="text-center">الدور</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تاريخ التسجيل</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="fw-bold text-center">{{ $user->id }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="text-center user-avatar me-2"
                                            style="width: 32px; height: 32px; font-size: 0.85rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            {{ mb_substr($user->name, 0, 1, 'UTF-8') }}
                                        </div>
                                        <div class="fw-semibold text-center">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary text-white fw-bold">
                                        @php
                                            switch($user->role) {
                                                case 0: echo 'مسئول'; break;
                                                case 1: echo 'مدير'; break;
                                                case 2: echo 'مشرف'; break;
                                                case 3: echo 'مشتريات'; break;
                                                default: echo 'لايوجد';
                                            }
                                        @endphp
                                    </span>
                                </td>
                                <td class="text-center"><span class="badge badge-status badge-active">نشط</span></td>
                                <td class="text-center">{{ $user->created_at }}</td>
                                <td class="text-center">
                                      @auth
    @if(auth()->user()->role === "0")
                                    <button class="btn btn-sm btn-outline-warning btn-action me-1" 
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal" 
                                        onclick="editUser({{ json_encode($user) }})" 
                                        title="تعديل">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-action" 
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" 
                                        onclick="deleteUser({{ $user->id }})" 
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
        <form method="POST" action="{{ route('users.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5><i class="bi bi-person-plus me-2"></i>إضافة مستخدم جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">الاسم الكامل</label>
                    <input type="text" name="name" class="form-control form-control-lg-custom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">رقم الجوال</label>
                    <input type="text" name="phone" class="form-control form-control-lg-custom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control form-control-lg-custom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">كلمة المرور</label>
                    <input type="password" name="password" class="form-control form-control-lg-custom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">الدور</label>
                    <select name="role" class="form-select form-control-lg-custom" required>
                        <option value="">اختر دور المستخدم</option>
                        <option value="0">مسئول</option>
                        <option value="1">مدير</option>
                        <option value="2">مشرف</option>
                        <option value="3">مشتريات</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary-custom rounded-pill px-4">إضافة المستخدم</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('users.update') }}" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="edit_id">

            <div class="modal-header">
                <h5><i class="bi bi-pencil-square me-2"></i>تعديل بيانات المستخدم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">الاسم الكامل</label>
                    <input type="text" name="name" id="edit_name" class="form-control form-control-lg-custom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">رقم الجوال</label>
                    <input type="text" name="phone" id="edit_phone" class="form-control form-control-lg-custom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">البريد الإلكتروني</label>
                    <input type="email" name="email" id="edit_email" class="form-control form-control-lg-custom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">كلمة المرور</label>
                    <input type="password" name="password" id="edit_password" class="form-control form-control-lg-custom">
                    <small class="text-muted">اترك الحقل فارغ إذا لم ترغب بتغيير كلمة المرور</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">الدور</label>
                    <select name="role" id="edit_role" class="form-select form-control-lg-custom" required>
                        <option value="0">مسئول</option>
                        <option value="1">مدير</option>
                        <option value="2">مشرف</option>
                        <option value="3">مشتريات</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-warning rounded-pill px-4">تحديث البيانات</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('users.delete') }}" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="delete_id">

            <div class="modal-header">
                <h5><i class="bi bi-exclamation-triangle me-2 text-danger"></i>تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <i class="bi bi-trash-fill fs-1 text-danger mb-3"></i>
                <h5 class="fw-bold">هل أنت متأكد من حذف هذا المستخدم؟</h5>
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


<script>
function editUser(user) {
    document.getElementById('edit_id').value = user.id;
    document.getElementById('edit_name').value = user.name;
    document.getElementById('edit_phone').value = user.phone;
    document.getElementById('edit_email').value = user.email;
    document.getElementById('edit_role').value = user.role;
    document.getElementById('edit_password').value = '';
}

function deleteUser(id) {
    document.getElementById('delete_id').value = id;
}
</script>
