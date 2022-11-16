<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Dataset Add</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form id="formDataset" class="form-horizontal">
                        <div class="card-body pt-3">
                            <div class="form-group mt-3">
                                <label>Suhu</label>
                                <input type="number" class="form-control" id="suhu" name="suhu" placeholder="Suhu ...">
                                <div class="invalid-feedback" id="suhu_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>PH</label>
                                <input type="number" class="form-control" id="ph" name="ph" placeholder="PH ...">
                                <div class="invalid-feedback" id="ph_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>TDS</label>
                                <input type="number" class="form-control" id="tds" name="tds" placeholder="TDS ...">
                                <div class="invalid-feedback" id="tds_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>DO</label>
                                <input type="number" class="form-control" id="do" name="do" placeholder="DO ...">
                                <div class="invalid-feedback" id="tds_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>Amonia</label>
                                <input type="number" class="form-control" id="amonia" name="amonia" placeholder="Amonia ...">
                                <div class="invalid-feedback" id="Amonia_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>Nitrit</label>
                                <input type="number" class="form-control" id="nitrit" name="nitrit" placeholder="Nitrit ...">
                                <div class="invalid-feedback" id="nitrit_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>Hasil</label>
                                <select name="hasil" id="hasil" class="form-control">
                                    <option value="">Pilih Hasil</option>
                                    <option value="1">Layak</option>
                                    <option value="2">Tidak Layak</option>
                                    <option value="3">Optimal</option> 
                                </select>
                                <div class="invalid-feedback" id="hasil_error"></div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="button" onclick="simpan()" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function simpan() {
        var form_data = new FormData($('#formDataset')[0]);
        var link = BASE_URL + 'admin/dataset/store';
        $.ajax({
            url: link,
            type: "POST",
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: data.pesan,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        window.location.href = '<?= base_url('admin/dataset'); ?>';
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
</script>