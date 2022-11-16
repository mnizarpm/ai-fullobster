<div class="col-12">
    <div class="card">
        <div class="card-header">
            <!-- <b>Data Test</b>
        </div>
        <div class="card-body">
            <table id="tb_datates" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Suhu Air</th>
                        <th class="text-center">PH</th>
                        <th class="text-center">TDS</th>
                        <th class="text-center">DO</th>
                        <th class="text-center">Amonia</th>
                        <th class="text-center">Nitrit</th>
                        <th class="text-center">Hasil</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table> -->
            <div class="alert alert-<?= $alert ?> p-3" role="alert">
                <span class="text-center">Status Kualitas Air Adalah : <b><?= $hasil ?></b></span>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        tabel_load();
    });

    function tabel_load() {
        $('#tb_datates tbody').html(`<tr><td colspan="4" class="text-center"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</td></tr>`);
        $.ajax({
            type: "get",
            url: "<?php echo base_url('admin/naive/getDatates') ?>",
            success: function(data) {
                data = JSON.parse(data);
                data = data.data;
                $('#tb_datates tbody').html('');
                $.each(data, function(i, val) {
                    var t = '<tr>';
                    t += '<td class="text-center">' + val.suhu + '</td>';
                    t += '<td class="text-center">' + val.ph + '</td>';
                    t += '<td class="text-center">' + val.tds + '</td>';
                    t += '<td class="text-center">' + val.do + '</td>';
                    t += '<td class="text-center">' + val.amonia + '</td>';
                    t += '<td class="text-center">' + val.nitrit + '</td>';
                    t += '<td class="text-center">' + val.hasil + '</td>';
                    t += '</tr>';
                    $('#tb_datates tbody').append(t);
                });
            }
        });
    }
</script>