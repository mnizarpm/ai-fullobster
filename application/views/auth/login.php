<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="<?= base_url('uploads\logo\unu1.png') ?>" />

    <title>Login</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link href="<?= base_url() ?>assets/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <script type="text/javascript">
        var BASE_URL = "<?= base_url(); ?>";
    </script>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">FULLOBSTER SURABAYA</h1>
                            <!-- <p class="lead">
                                Masukkan Username dan Password Anda !!
                            </p> -->
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="<?= base_url('uploads\logo\unu1.png') ?>" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    <form id="formLogin">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input class="form-control form-control-lg" type="text" name="username" placeholder="Masukkan username" />
                                            <div class="invalid-feedback" id="username_error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan password" />
                                            <div class="invalid-feedback" id="password_error"></div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="button" id="masuk" class="btn btn-lg btn-primary"><i class="fas fa-sign-in-alt"></i> Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="<?= base_url() ?>assets/plugins/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/app.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- SweetAlert2 -->
    <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $('#masuk').on('click', function() {
            var form_data = new FormData($('#formLogin')[0]);
            var link = BASE_URL + 'auth/login';
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
                        setTimeout(function() {
                            window.location.href = "<?= base_url(); ?>home";
                        }, 2000);
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
        });
        $('#lock').on('click', function() {
            var a = $('#password').attr("type");
            if (a == 'password') {
                $('#password').attr("type", 'text');
                $('#loc').attr("class", 'fas fa-eye');
            } else {
                $('#password').attr("type", 'password');
                $('#loc').attr("class", 'fas fa-lock');
            }
        });
    </script>
</body>

</html>