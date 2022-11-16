<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Atribut Add</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/atribut') ?>">Atribut</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Atribut Add</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div id="alert">
                </div>
                <form id="formAtribut" class="form-horizontal">
                    <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">
                    <div class="card-body pt-3">
                        <div class="form-group">
                            <label>Nama Atribut</label>
                            <input type="text" class="form-control" value="<?= $data['nama'] ?>" id="nama" name="nama" placeholder="nama atribut ...">
                            <div class="invalid-feedback" id="nama_error"></div>
                        </div>
                        <div class="form-group">
                            <label>Status Atribut</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="0">Dihitung</option>
                                <option value="1">Dicari</option>
                            </select>
                            <div class="invalid-feedback" id="status_error"></div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="button" onclick="simpanAtribut()" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#status").val('<?= $data['status'] ?>');

    function simpanAtribut() {
        var form_data = new FormData($('#formAtribut')[0]);
        var link = BASE_URL + 'admin/atribut/store';
        $.ajax({
            url: link,
            type: "POST",
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status == 1) {
                    $('#alert').html(`
                        <div class="alert alert-success" role="alert">
                            ` + data.pesan + `
                        </div>`);
                    setTimeout(() => {
                        window.location.href = '<?= base_url('admin/atribut'); ?>';
                    }, 1000);
                } else if (data.status == 3) {
                    $.each(data.pesan, function(i, item) {
                        $('#' + i + '_error').html(item);
                        $('#' + i + '_error').show();
                        if (item) {
                            $('#' + i).removeClass("is-valid").addClass("is-invalid");
                        } else {
                            $('#' + i).removeClass("is-invalid").addClass("is-valid");
                        }
                    });
                } else {
                    $('#alert').html(`
                        <div class="alert alert-danger" role="alert">
                            ` + data.pesan + `
                        </div>`);
                }
            }
        });
    }
</script>