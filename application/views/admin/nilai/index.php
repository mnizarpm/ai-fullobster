<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/extra-libs/multicheck/multicheck.css">
<link href="<?= base_url() ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Nilai Atribut</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nilai Atribut</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="btn btn-primary" href="<?= base_url('admin/nilai/add') ?>"><i class="fas fa-plus"></i></a>
                        Data Nilai Atribut
                    </h5>
                    <div id="alert">
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="tb_nilai" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        tabel_load();
    });

    function tabel_load() {
        $('#tb_nilai tbody').html(`<tr><td colspan="4" class="text-center"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</td></tr>`);
        $.ajax({
            type: "get",
            url: "<?php echo base_url('admin/nilai/getNilai') ?>",
            success: function(data) {
                data = JSON.parse(data);
                data = data.data;
                $('#tb_nilai tbody').html('');
                var no = 1;
                $.each(data, function(i, val) {
                    var status = val.status;
                    if (status == 0) {
                        status = "Dihitung";
                    } else if (status == 1) {
                        status = "Dicari";
                    }
                    var t = '<tr>';
                    t += '<td class="text-center">' + no + '</td>';
                    t += '<td class="text-center">' + val.nama + '</td>';
                    t += '<td class="text-center">' + status + '</td>';
                    t += `<td class="text-center">
                            <div class="btn-group">
                                <a href="` + BASE_URL + `admin/nilai/edit/` + val.id + `" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger text-white item_hapus" title="Hapus" data="` + val.id + `"><i class="fas fa-trash"></i></button>
                            </div>
                          </td>`;
                    t += '</tr>';
                    $('#tb_nilai tbody').append(t);
                    no++;
                });
                $('#tb_nilai').DataTable();
            }
        });
    }

    $('#tb_nilai tbody').on('click', '.item_hapus', function() {
        var id = $(this).attr('data');
        Swal.fire({
            title: 'Anda yakin ?',
            text: "Anda akan menghapus data ini !",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin/nilai/destroy') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            $('#alert').html(`<div class="alert alert-success" role="alert">
                                <strong>Sukses !  </strong>` + data.pesan + `
                            </div>`);
                            setTimeout(() => {
                                $('#alert').html('');
                                tabel_load();
                            }, 1000);
                        } else {
                            $('#alert').html(`<div class="alert alert-danger" role="alert">
                                <strong>Gagal! </strong>` + data.pesan + `
                            </div>`);
                            setTimeout(() => {
                                $('#alert').html('');
                            }, 1000);
                        }
                    }
                });
            }
        })
    });
</script>
<!-- this page js -->
<script src="<?= base_url() ?>assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="<?= base_url() ?>assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="<?= base_url() ?>assets/extra-libs/DataTables/datatables.min.js"></script>