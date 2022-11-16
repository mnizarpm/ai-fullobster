<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Profile Edit</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form id="formUser" class="form-horizontal">
                        <div class="card-body pt-3">
                            <input type="hidden" name="id_user" id="id_user" value="<?= $data['id_user'] ?>">
                            <div class="form-group mt-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" id="nama" value="<?= $data['nama'] ?>" name="nama" placeholder="nama lengkap ...">
                                <div class="invalid-feedback" id="nama_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>Username</label>
                                <input type="text" class="form-control" value="<?= $data['username'] ?>" id="username" name="username" placeholder="username ...">
                                <div class="invalid-feedback" id="username_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="password ...">
                                <div class="invalid-feedback" id="password_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>Ulangi Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="ulangi password ...">
                                <div class="invalid-feedback" id="cpassword_error"></div>
                            </div>
                            <div class="form-group mt-3">
                                <label>Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input onchange="readURL(this, '#image');" name="image" type="file" class="custom-file-input" accept="image/gif, image/jpeg, image/png" id="image">
                                    </div>
                                </div>
                                <div class="invalid-feedback" id="image_error"></div>
                                <div id="image-display">
                                    <?php if ($data['image'] != '') : ?>
                                        <img id="blah" src="<?= base_url('uploads/user/foto/') . $data['image'] ?>" alt="Mengambil Foto ..." class="mt-2" style="height: 200px;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="button" onclick="simpanUser()" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function simpanUser() {
        var form_data = new FormData($('#formUser')[0]);
        var link = BASE_URL + 'admin/profil/store';
        $.ajax({
            url: link,
            type: "POST",
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.status == 1) {
                    $('#alert').html(`
                        <div class="alert alert-success" role="alert">
                            ` + data.pesan + `
                        </div>`);
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


    function readURL(input, image) {
        set_null_image(image + '');
        var FileUploadPath = input.value;
        var Extension = FileUploadPath.substring(
            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

        if (Extension == "gif" || Extension == "png" || Extension == "bmp" ||
            Extension == "jpeg" || Extension == "jpg") {

            if (input.files && input.files[0]) {
                var size = input.files[0].size;
                var name = input.files[0].name;
                if (size > 2000000) {
                    $(image + '_error').html('Ukuran Maksimum 2Mb');
                    $(image + '_error').show();
                    $(image).addClass("is-invalid");
                    $(image).val('');
                } else {
                    $(image + '-label').html(name);
                    var reader = new FileReader();

                    $(image + '-display').html(`<img id="blah" src="" alt="Mengambil Foto ..." class="mt-2" />`);
                    reader.onload = function(e) {
                        $('#blah')
                            .attr('src', e.target.result)
                            .height(200);
                    };

                    reader.readAsDataURL(input.files[0]);
                    // $('#blah').show();
                    $(image).addClass("is-valid");
                }
            }
        } else {
            $(image + '_error').html('Foto hanya boleh (GIF, PNG, JPG, JPEG and BMP)');
            $(image + '_error').show();
            $(image).addClass("is-invalid");
            $(image).val('');
        }
    }

    function set_null_image(image) {
        $(image).removeClass("is-valid");
        $(image).removeClass("is-invalid");
        $(image + '-display').html("");
        $(image + '_error').html("");
        $(image + '-label').html("Pilih file");
    }
</script>