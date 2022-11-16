<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Dashboard</h1>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Dataset</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="fas fa-align-center"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $dataset ?></h1>
                        <div class="mb-0">
                            <span class="text-muted">Jumlah Dataset</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Users</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-success">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $user ?></h1>
                        <div class="mb-0">
                            <span class="text-muted">Jumlah User</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>