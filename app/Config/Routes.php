<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('pajak', 'Pajak::index');
    $routes->get('cicilan', 'Cicilan::index');
    $routes->get('tracking', 'Tracking::index');

    $routes->get('pajak', 'Pajak::index');
    $routes->get('pajak/create', 'Pajak::create');
    $routes->post('pajak/store', 'Pajak::store');
    $routes->post('pajak/simpan', 'Pajak::simpan');

    $routes->get('pajak/delete/(:num)', 'Pajak::delete/$1');

    $routes->get('pajak/edit/(:num)', 'Pajak::edit/$1');
    $routes->post('pajak/update/(:num)', 'Pajak::update/$1');

    $routes->get('pajak/invoice/(:num)', 'Pajak::invoice/$1');

    $routes->get('pajak/surat_keterangan/(:num)', 'Pajak::surat_keterangan/$1');

    $routes->get('cicilan', 'Cicilan::index');

    $routes->post('cicilan/kirim_pesan/(:num)', 'Cicilan::kirim_pesan/$1');

    $routes->post('cicilan/ditandai_dihubungi/(:num)', 'Cicilan::ditandai_dihubungi/$1');


    $routes->get('pajak/get-petugas', 'Pajak::getPetugasByWilayah');

    $routes->get('tracking/penugasan/(:num)', 'Tracking::penugasan/$1');
    $routes->post('tracking/simpanPenugasan/(:num)', 'Tracking::simpanPenugasan/$1');
});


// Petugas
$routes->group('petugas', ['namespace' => 'App\Controllers\Petugas'], function ($routes) {
    // Login Petugas
    $routes->get('login', 'AuthPetugas::login');
    $routes->post('login', 'AuthPetugas::prosesLogin');
    $routes->get('logout', 'AuthPetugas::logout');

    // Dashboard Petugas
    $routes->get('dashboard', 'Dashboard::index', ['filter' => 'authPetugas']);


    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('pengajuan', 'Pengajuan::index');
    $routes->get('pengajuan/edit/(:num)', 'Pengajuan::edit/$1');
    $routes->post('pengajuan/update/(:num)', 'Pengajuan::update/$1');
});
