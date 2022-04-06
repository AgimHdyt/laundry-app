<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">G-sok <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $title == 'Dashboard' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Melakukan Query Menu -->
    <?php
    $db = \Config\Database::connect();
    // $role_id = $user['role_id'];
    $role_id = session()->get('role_id');
    $queryMenu = "SELECT `user_menu`.`id`, `menu`
                        FROM `user_menu` JOIN `user_access_menu` 
                        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                ORDER BY `menu` ASC
                ";
    $menu = $db->query($queryMenu)->getResultArray();
    ?>
    <?php foreach ($menu as $m) : ?>

        <!-- Heading -->
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <!-- SIAPKAN SUMB-MENU SESUAI MENU -->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT *
                            FROM `user_sub_menu`
                            WHERE`menu_id` = $menuId
                            AND `is_active` = 1
                        ORDER BY `title` ASC
                        ";
        $subMenu = $db->query($querySubMenu)->getResultArray();
        ?>

        <?php foreach ($subMenu as $s) : ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= $s['title'] == $title ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $s['url']; ?>">
                    <i class="<?= $s['icon']; ?>"></i>
                    <span><?= $s['title']; ?></span></a>
            </li>
        <?php endforeach; ?>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

    <?php endforeach; ?>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">