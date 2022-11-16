<link href="<?= base_url() ?>assets/css/light.css" rel="stylesheet">
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Users</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="<?= base_url('admin/user/add') ?>"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    <div class="card-body">
                        <table id="tb_user" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Level</th>
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
</main>

<script>
    $(document).ready(function() {
        tabel_load();
    });

    function tabel_load() {
        $('#tb_user tbody').html(`<tr><td colspan="8" class="text-center"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</td></tr>`);
        $.ajax({
            type: "get",
            url: "<?php echo base_url('admin/user/getUser') ?>",
            success: function(data) {
                data = JSON.parse(data);
                data = data.data;
                $('#tb_user tbody').html('');
                var no = 1;
                $.each(data, function(i, val) {
                    var image = val.image;
                    if (image == '') {
                        image = "default.png";
                    }
                    var t = '<tr>';
                    t += '<td class="text-center">' + no + '</td>';
                    t += '<td class="text-center"><img width="75" src="' + BASE_URL + 'uploads/user/foto/' + image + '"</td>';
                    t += '<td class="text-center">' + val.nama + '</td>';
                    t += '<td class="text-center">' + val.username + '</td>';
                    t += '<td class="text-center">' + val.level + '</td>';
                    t += `<td class="text-center">
                            <div class="btn-group">
                                <a href="` + BASE_URL + `admin/user/edit/` + val.id_user + `" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger text-white item_hapus" title="Hapus" data="` + val.id_user + `"><i class="fas fa-trash"></i></button>
                            </div>
                          </td>`;
                    t += '</tr>';
                    $('#tb_user tbody').append(t);
                    no++;
                });
                $('#tb_user').DataTable();
            }
        });
    }

    $('#tb_user tbody').on('click', '.item_hapus', function() {
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
                    url: "<?php echo base_url('admin/user/destroy') ?>",
                    dataType: "JSON",
                    data: {
                        id_user: id
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: data.pesan,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(() => {
                                tabel_load();
                            }, 1000);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.pesan,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        })
    });
</script>
<script src="<?= base_url() ?>assets/js/datatables.js"></script>