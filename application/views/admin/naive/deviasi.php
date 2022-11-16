<div class="col-12">
    <div class="card">
        <div class="card-header">
            <b>Standart Deviasi</b>
        </div>
        <div class="card-body">
            <table id="tb_deviasi" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Hasil</th>
                        <th class="text-center">Suhu</th>
                        <th class="text-center">PH</th>
                        <th class="text-center">TDS</th>
                        <th class="text-center">DO</th>
                        <th class="text-center">Amonia</th>
                        <th class="text-center">Nitrit</th>
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
        tabel_load_deviasi();
    });

    function tabel_load_deviasi() {
        $('#tb_deviasi tbody').html(`<tr><td colspan="4" class="text-center"><i class="fas fa-circle-notch fa-spin"></i> Loading ...</td></tr>`);
        $.ajax({
            type: "get",
            url: "<?php echo base_url('admin/naive/getDeviasi') ?>",
            success: function(data) {
                data = JSON.parse(data);
                data = data.data;
                $('#tb_deviasi tbody').html('');
                $.each(data, function(i, val) {
                    var t = '<tr>';
                    t += '<td class="text-center">' + val.hasil + '</td>';
                    t += '<td class="text-center">' + val.suhu + '</td>';
                    t += '<td class="text-center">' + val.ph + '</td>';
                    t += '<td class="text-center">' + val.tds + '</td>';
                    t += '<td class="text-center">' + val.do + '</td>';
                    t += '<td class="text-center">' + val.amonia + '</td>';
                    t += '<td class="text-center">' + val.nitrit + '</td>';
                    t += '</tr>';
                    $('#tb_deviasi tbody').append(t);
                });
            }
        });
    }
</script>