    {!! ToastMagic::scripts() !!}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


<script>
    $(function(){
        // Initialize DataTable with full responsive settings
        $('#datatable').DataTable({
            responsive: true,
            scrollX: true,
            autoWidth: false,
            language: {
                search: 'بحث:',
                lengthMenu: 'عرض _MENU_ سجل',
                info: 'عرض _START_ إلى _END_ من _TOTAL_ سجل',
                infoEmpty: 'لا توجد سجلات متاحة',
                infoFiltered: '(تمت التصفية من إجمالي _MAX_ سجل)',
                emptyTable: 'لا توجد بيانات متاحة في الجدول',
                zeroRecords: 'لم يتم العثور على سجلات مطابقة',
                paginate: {
                    next: 'التالي',
                    previous: 'السابق'
                }
            },
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "الكل"]],
            order: [[0, 'desc']],
            drawCallback: function(settings) {
                // إصلاح عرض الجدول بعد كل رسم
                $('.dataTables_scrollHeadInner').css('width', '100%');
                $('.dataTables_scrollHeadInner table').css('width', '100%');
            }
        });
        
        // إصلاح عرض الجدول بعد تحميل الصفحة
        setTimeout(function() {
            $('.dataTables_scrollHeadInner').css('width', '100%');
            $('.dataTables_scrollHeadInner table').css('width', '100%');
            $('#datatable').css('width', '100%');
        }, 500);
        
        // Handle bottom nav active state
        $('.bottom-nav a').on('click', function(e) {
            $('.bottom-nav a').removeClass('active');
            $(this).addClass('active');

            if ($(this).attr('href') === '#datatable') {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $('#datatable').closest('.card').offset().top - 70 
                }, 500);
            }
        });
        
        // إعادة ضبط عرض الجدول عند تغيير حجم النافذة
        $(window).on('resize', function() {
            $('.dataTables_scrollHeadInner').css('width', '100%');
            $('.dataTables_scrollHeadInner table').css('width', '100%');
            $('#datatable').css('width', '100%');
        });
        
        
    });
</script>

</body>
</html>