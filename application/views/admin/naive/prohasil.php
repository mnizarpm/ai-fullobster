<div class="col-12">
    <div class="card">
        <div class="card-header">
            <b>Probabilitas Hasil</b>
        </div>
        <div class="card-body">
            <table id="tb_prohasil" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Hasil</th>
                        <th class="text-center">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        tabel_load_prohasil();
    });

    function tabel_load_prohasil() {
        $('#tb_prohasil tbody').html(`<tr><td colspan="2" class="text-center"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</td></tr>`);
        $.ajax({
            type: "get",
            url: "<?php echo base_url('admin/naive/getProhasil') ?>",
            success: function(data) {
                data = JSON.parse(data);
                data = data.data;
                $('#tb_prohasil tbody').html('');
                $.each(data, function(i, val) {
                    var t = '<tr>';
                    t += '<td class="text-center">' + val.hasil + '</td>';
                    t += '<td class="text-center">' + val.nilai + '</td>';
                    t += '</tr>';
                    $('#tb_prohasil tbody').append(t);
                });
            }
        });
    }
</script>