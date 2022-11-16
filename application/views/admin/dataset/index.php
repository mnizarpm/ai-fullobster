<link href="<?= base_url() ?>assets/css/light.css" rel="stylesheet">
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Dataset</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="<?= base_url('admin/dataset/add') ?>"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    <div class="card-body">
                        <table id="tb_dataset" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Suhu</th>
                                    <th class="text-center">PH</th>
                                    <th class="text-center">TDS</th>
                                    <th class="text-center">DO</th>
                                    <th class="text-center">Amonia</th>
                                    <th class="text-center">Nitrit</th>
                                    <th class="text-center">Hasil</th>
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
        $('#tb_dataset tbody').html(`<tr><td colspan="6" class="text-center"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</td></tr>`);
        $.ajax({
            type: "get",
            url: "<?php echo base_url('admin/dataset/getDataset') ?>",
            success: function(data) {
                data = JSON.parse(data);
                data = data.data;
                $('#tb_dataset tbody').html('');
                var no = 1;
                $.each(data, function(i, val) {
                    var hasil = val.hasil;
                    if (hasil == 1) {
                        hasil = "Layak";
                    } if (hasil == 3) {
                        hasil = "Optimal";
                    } if (hasil == 2) {
                        hasil = "Tidak Layak";
                    }
                    var t = '<tr>';
                    t += '<td class="text-center">' + no + '</td>';
                    t += '<td class="text-center">' + val.suhu + '</td>';
                    t += '<td class="text-center">' + val.ph + '</td>';
                    t += '<td class="text-center">' + val.tds + '</td>';
                    t += '<td class="text-center">' + val.do + '</td>';
                    t += '<td class="text-center">' + val.amonia + '</td>';
                    t += '<td class="text-center">' + val.nitrit + '</td>';
                    t += '<td class="text-center">' + hasil + '</td>';
                    t += `<td class="text-center">
                            <div class="btn-group">
                                <a href="` + BASE_URL + `admin/dataset/edit/` + val.id + `" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger text-white item_hapus" title="Hapus" data="` + val.id + `"><i class="fas fa-trash"></i></button>
                            </div>
                          </td>`;
                    t += '</tr>';
                    $('#tb_dataset tbody').append(t);
                    no++;
                });
                $('#tb_dataset').DataTable();
            }
        });
    }

    $('#tb_dataset tbody').on('click', '.item_hapus', function() {
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
                    url: "<?php echo base_url('admin/dataset/destroy') ?>",
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