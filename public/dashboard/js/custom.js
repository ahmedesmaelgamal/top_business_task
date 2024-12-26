<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>


// <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"/>
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
    $('#my-table').DataTable({
        order: [[0, 'desc']],
        responsive: true,
        autoWidth: false,
        paging: true,
        pageLength: 100,
        lengthChange: true,
        searching: true,
        info: true,
    })
});
</script>
