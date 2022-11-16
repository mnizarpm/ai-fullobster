<link href="<?= base_url() ?>assets/css/light.css" rel="stylesheet">
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Atribut</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="<?= base_url('admin/atribut/add') ?>"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    <div class="card-body">
                        <table id="tb_atribut" class="table table-striped table-bordered">
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
</main>

<script>
    $(document).ready(function() {
        tabel_load();
    });

    function tabel_load() {
        $('#tb_atribut tbody').html(`<tr><td colspan="8" class="text-center"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</td></tr>`);
        $.ajax({
            type: "get",
            url: "<?php echo base_url('admin/atribut/getAtribut') ?>",
            success: function(data) {
                data = JSON.parse(data);
                data = data.data;
                $('#tb_atribut tbody').html('');
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
                                <a href="` + BASE_URL + `admin/atribut/edit/` + val.id + `" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger text-white item_hapus" title="Hapus" data="` + val.id + `"><i class="fas fa-trash"></i></button>
                            </div>
                          </td>`;
                    t += '</tr>';
                    $('#tb_atribut tbody').append(t);
                    no++;
                });
                $('#tb_atribut').DataTable();
            }
        });
    }

    $('#tb_atribut tbody').on('click', '.item_hapus', function() {
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
                    url: "<?php echo base_url('admin/atribut/destroy') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
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