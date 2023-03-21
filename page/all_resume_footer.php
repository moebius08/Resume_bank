<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js"></script>

<script>
$(document).ready(function() {
    $('#resumes-table').DataTable({
        dom: 'Pfrtip',
        columns: [
            { data: 'name', title: 'Full Name' },
            { data: 'courses', title: 'Course/s', searchPanes: { show: true } },
            { data: 'email', title: 'Email' },
            { data: 'cellphone', title: 'Cellphone Number' },
            { data: 'skills', title: 'Skills', className: 'skills-header' },
            { data: 'action', title: 'Action' },
        ]
    });
});





</script>

</body>
    </html>