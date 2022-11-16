<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand text-center" href="<?= base_url() ?>">
            <p class="align-middle mb-0"><img src="<?= base_url('uploads/logo/unu1.png') ?>" width="80" alt=""></p>
            <span class="align-middle mt-0">Fullobster Surabaya</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                UMUM
            </li>

            <li class="sidebar-item <?= act('home') ?>">
                <a class="sidebar-link" href="<?= base_url('home') ?>">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item <?= act('dataset') ?>">
                <a class="sidebar-link" href="<?= base_url('admin/dataset') ?>">
                    <i class="fas fa-align-center"></i> <span class="align-middle">Dataset</span>
                </a>
            </li>
            <li class="sidebar-item <?= act('naive') ?>">
                <a class="sidebar-link" href="<?= base_url('admin/naive') ?>">
                    <i class="fas fa-calculator"></i> <span class="align-middle">Uji Kualitas Air</span>
                </a>
            </li>
            <!-- <li class="sidebar-item <?= act('riwayat') ?>">
                <a class="sidebar-link" href="<?= base_url('admin/riwayat') ?>">
                    <i class="fas fa-history"></i> <span class="align-middle">Riwayat</span>
                </a>
            </li> -->
            <li class="sidebar-header">
                PENGATURAN
            </li>
            <?php if ($this->session->userdata('level') == 'admin') : ?>
                <li class="sidebar-item <?= act('user') ?>">
                    <a class="sidebar-link" href="<?= base_url('admin/user') ?>">
                        <i class="fas fa-users"></i> <span class="align-middle">Users</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="sidebar-item <?= act('profil') ?>">
                <a class="sidebar-link" href="<?= base_url('admin/profil') ?>">
                    <i class="fas fa-user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('auth/logout') ?>">
                    <i class="fas fa-sign-out-alt"></i> <span class="align-middle">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>