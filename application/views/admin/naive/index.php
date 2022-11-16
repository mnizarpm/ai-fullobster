<link href="<?= base_url() ?>assets/css/light.css" rel="stylesheet">
<style>
    .card-header {
        padding-bottom: 0;
    }
</style>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Uji Kualitas Air</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mb-0">
                        <b>Mulai Uji</b>
                    </div>
                    <div class="card-body mt-0">
                        <form id="formProses">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group mt-3">
                                        <label>Suhu Air</label>
                                        <input type="number" class="form-control" id="suhu" name="suhu" placeholder="Suhu Air...">
                                        <div class="invalid-feedback" id="suhu_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group mt-3">
                                        <label>PH</label>
                                        <input type="number" class="form-control" id="ph" name="ph" placeholder="PH ...">
                                        <div class="invalid-feedback" id="ph_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group mt-3">
                                        <label>TDS</label>
                                        <input type="number" class="form-control" id="tds" name="tds" placeholder="TDS ...">
                                        <div class="invalid-feedback" id="tds_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group mt-3">
                                        <label>DO</label>
                                        <input type="number" class="form-control" id="do" name="do" placeholder="DO ...">
                                        <div class="invalid-feedback" id="do_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group mt-3">
                                        <label>Amonia</label>
                                        <input type="number" class="form-control" id="amonia" name="amonia" placeholder="Amonia ...">
                                        <div class="invalid-feedback" id="amonia_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group mt-3">
                                        <label>Nitrit</label>
                                        <input type="number" class="form-control" id="nitrit" name="nitrit" placeholder="Nitrit ...">
                                        <div class="invalid-feedback" id="nitrit_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group mt-3">
                                        <label> </label>
                                        <button type="button" id="proses" onclick="hitung();" class="btn btn-primary form-control"><i class="fas fa-caret-right"></i> Proses</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="datates"></div>
        <!-- <div class="row" id="mean"></div>
        <div class="row" id="deviasi"></div>
        <div class="row" id="prohasil"></div> -->
    </div>
</main>

<script>
    // getMean(6);

    function hitung() {
        $('#proses').html('<i class="fas fa-circle-notch fa-spin"></i> Proses');
        var form_data = new FormData($('#formProses')[0]);
        var link = BASE_URL + 'admin/naive/store';
        $.ajax({
            url: link,
            type: "POST",
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                $('#proses').html('<i class="fas fa-caret-right"></i> Proses');
                if (data.status == 1) {
                    $('.form-control').removeClass("is-invalid").addClass("is-valid");
                    $('.invalid-feedback').hide();
                    getMean(data.data);
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

    function getMean(id) {
        $('#mean').html('<div class="col-md-12"><div class="card"><div class="card-body"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</div></div></div>')
        var link = BASE_URL + 'admin/naive/getViewMean';
        $.ajax({
            url: link,
            type: "POST",
            success: function(data) {
                $('#mean').html(data);
                getDeviasi(id);
            }
        });
    }

    function getDeviasi(id) {
        $('#deviasi').html('<div class="col-md-12"><div class="card"><div class="card-body"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</div></div></div>')
        var link = BASE_URL + 'admin/naive/getViewDeviasi';
        $.ajax({
            url: link,
            type: "POST",
            success: function(data) {
                $('#deviasi').html(data);
                getProhasil(id);
            }
        });
    }

    function getProhasil(id) {
        $('#prohasil').html('<div class="col-md-12"><div class="card"><div class="card-body"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</div></div></div>')
        var link = BASE_URL + 'admin/naive/getViewProhasil';
        $.ajax({
            url: link,
            type: "POST",
            success: function(data) {
                $('#prohasil').html(data);
                getDatates(id)
            }
        });
    }

    function getDatates(id) {
        $('#datates').html('<div class="col-md-12"><div class="card"><div class="card-body"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</div></div></div>')
        var link = BASE_URL + 'admin/naive/getViewDatates';
        $.ajax({
            url: link,
            data: {
                id: id
            },
            type: "POST",
            success: function(data) {
                $('#datates').html(data);
            }
        });
    }
</script>
<script src="<?= base_url() ?>assets/js/datatables.js"></script>