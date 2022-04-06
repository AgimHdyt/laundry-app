<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Routing auth
$routes->get('/', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::save');
$routes->get('/verify', 'Auth::verify');
$routes->get('/logout', 'Auth::logout');
// $routes->get('/register/save', 'Auth::save');

$routes->get('/menu', 'Master::index');
$routes->get('/submenu', 'Master::subMenu');
$routes->post('/menu', 'Master::save');
$routes->post('/submenu', 'Master::saveSubmenu');
$routes->post('/get-submenu', 'Master::getSubmenu');
$routes->post('/edit-submenu', 'Master::editSubmenu');
$routes->get('/layanan', 'Master::layanan');
$routes->get('/d-layanan/(:num)', 'Master::detailLayanan/$1');
$routes->post('/add-layanan', 'Master::saveLayanan');
$routes->post('/edit-layanan', 'Master::editLayanan');
$routes->post('/delete-layanan', 'Master::deleteLayanan');
$routes->post('/getLayanan', 'Master::getLayanan');
$routes->post('/jenis-layanan', 'Master::saveJenisLayanan');
$routes->post('/edit-jenis-layanan', 'Master::editJenisLayanan');
$routes->post('/delete-jenis-layanan', 'Master::deleteDetailLayanan');
$routes->post('/getDetailLayanan', 'Master::getDetailLayanan');

$routes->get('/member', 'Master::member');
$routes->post('/add-member', 'Master::addMember');
$routes->post('/edit-member', 'Master::editMember');
$routes->post('/getMember', 'Master::getMember');
$routes->post('/edit-member', 'Master::member');
$routes->delete('/del-member/(:num)', 'Master::delMember/$1');




// Admin router
$routes->get('/admin', 'Admin::index');
$routes->post('/add-user', 'Admin::addUser');
$routes->post('/get-user', 'Admin::getuser');
$routes->post('/edit-user', 'Admin::editUser');
$routes->delete('/del-user/(:num)', 'Admin::delUser/$1');


$routes->get('/user', 'User::index');
$routes->get('/edit-profile', 'User::edit');
$routes->post('/edit', 'User::editProfile');
$routes->get('/edit-password', 'User::editpassword');
$routes->post('/changepassword', 'User::changepassword');
$routes->get('/dashboard', 'User::dashboard');



$routes->get('/transaksi', 'Transaksi::index');
$routes->get('/data-transaksi', 'Transaksi::dataTransaksi');
$routes->get('/detail-transaksi', 'Transaksi::detailTransaksi');
$routes->get('/cetak-pdf', 'Transaksi::cetakPDF');
$routes->get('/cetak-thermal', 'Transaksi::cetakThermal');
$routes->get('/unduh-pdf', 'Transaksi::printPdf');
$routes->post('/layananTable', 'Transaksi::layananTable');
$routes->post('/getJenisLayanan', 'Transaksi::getJenisLayanan');
$routes->post('/get-tanggal', 'Transaksi::getTanggal');
$routes->post('/get-harga', 'Transaksi::getHarga');
$routes->post('/add-transaksi', 'Transaksi::transaksiBaru');
$routes->post('/get-id-transaksi', 'Transaksi::getTransaksiById');
$routes->post('/edit-transaksi', 'Transaksi::editTransaksi');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
