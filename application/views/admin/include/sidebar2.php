<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item <?= selected('home') ?>">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link <?= act('home') ?>" href="<?= base_url() ?>" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item <?= selected('atribut') ?>">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link <?= act('atribut') ?>" href="<?= base_url('admin/atribut') ?>" aria-expanded="false">
                        <i class="fas fa-align-justify"></i>
                        <span class="hide-menu">Atribut</span>
                    </a>
                </li>
                <li class="sidebar-item <?= selected('nilai') ?>">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link <?= act('nilai') ?>" href="<?= base_url('admin/nilai') ?>" aria-expanded="false">
                        <i class="fas fa-book"></i>
                        <span class="hide-menu">Nilai Atribut</span>
                    </a>
                </li>
                <li class="sidebar-item <?= selected('user') ?>">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link <?= act('user') ?>" href="<?= base_url('admin/user') ?>" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>