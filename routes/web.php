<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// RUOTE DIPAKAI =============================================================================================================
Route::get('/',function(){
	return view('auth.login');
});

Route::get('/login','Login@login');
Route::post('/auth','Login@auth');
Route::get('/logout', 'Login@logout');

Route::group(['middleware' => ['admin']], function () {
#USER
Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index');
	Route::match(array('GET', 'POST'),'/datatables','AdminController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','AdminController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','AdminController@edit');
});
#KELAS
Route::prefix('kelas')->group(function() {
    Route::get('/', 'KelasController@index');
	Route::match(array('GET', 'POST'),'/datatables','KelasController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','KelasController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','KelasController@edit');
	Route::match(array('GET', 'POST'),'/daftar-siswa/{kelas}','KelasController@daftarSiswa');
});
#PEMILIH
Route::prefix('pemilih')->group(function() {
    Route::get('/', 'PemilihController@index');
	Route::match(array('GET', 'POST'),'/datatables','PemilihController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','PemilihController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','PemilihController@edit');
});
#SUB KRITERIA
Route::prefix('sub-kriteria')->group(function() {
    Route::get('/', 'SubKriteriaController@index');
	Route::match(array('GET', 'POST'),'/datatables','SubKriteriaController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','SubKriteriaController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','SubKriteriaController@edit');
});
#PELANGGAN
Route::prefix('pelanggan')->group(function() {
    Route::get('/', 'PelangganController@index');
	Route::match(array('GET', 'POST'),'/datatables','PelangganController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','PelangganController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','PelangganController@edit');
});
#SETTING PARAMETER
Route::prefix('setting-parameter')->group(function() {
    Route::match(array('GET', 'POST'),'/', 'SettingParameterController@form');
});
#TRANSAKSI RETRIBUSI SAMPAH
Route::prefix('transaksi-retribusi-sampah')->group(function() {
    Route::get('/', 'TransaksiSampahController@index');
	Route::match(array('GET', 'POST'),'/datatables','TransaksiSampahController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','TransaksiSampahController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','TransaksiSampahController@edit');
	Route::match(array('GET', 'POST'),'/show/{id}','TransaksiSampahController@show');
	Route::match(array('GET'),'/cetak-nota/{id}','TransaksiSampahController@cetak_nota');
});
#TRANSAKSI PEMBAYARAN ONLINE
Route::prefix('transaksi-pembayaran-online')->group(function() {
    Route::get('/', 'TransaksiOnlineController@index');
	Route::match(array('GET', 'POST'),'/datatables','TransaksiOnlineController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','TransaksiOnlineController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','TransaksiOnlineController@edit');
	Route::match(array('GET', 'POST'),'/show/{id}','TransaksiOnlineController@show');
	Route::match(array('GET'),'/cetak-nota/{id}','TransaksiOnlineController@cetak_nota');
});


#SIMPANAN ANGGOTA
Route::prefix('simpanan-anggota')->group(function() {
    Route::get('/', 'SimpananAnggotaController@index');
	Route::match(array('GET', 'POST'),'/datatables','SimpananAnggotaController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','SimpananAnggotaController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','SimpananAnggotaController@edit');

	Route::match(array('GET', 'POST'),'/wajib/{id}','SimpananAnggotaController@simpanan_wajib');
	Route::match(array('GET'),'/lookup_form_setoran_wajib','SimpananAnggotaController@lookup_form_setoran_wajib');
	Route::match(array('GET'),'/lookup_form_setoran_wajib_penarikan','SimpananAnggotaController@lookup_form_setoran_wajib_penarikan');
	Route::match(array('POST'),'/simpan-setoran-wajib','SimpananAnggotaController@simpan_setoran_wajib');

	Route::match(array('GET', 'POST'),'/pokok/{id}','SimpananAnggotaController@simpanan_pokok');
	Route::match(array('GET'),'/lookup_form_setoran_pokok','SimpananAnggotaController@lookup_form_setoran_pokok');
	Route::match(array('GET'),'/lookup_form_setoran_pokok_penarikan','SimpananAnggotaController@lookup_form_setoran_pokok_penarikan');
	Route::match(array('POST'),'/simpan-setoran-pokok','SimpananAnggotaController@simpan_setoran_pokok');

	Route::match(array('GET', 'POST'),'/tarik/{id}','SimpananAnggotaController@tarik');
	Route::match(array('GET'),'/cetak/{id}','SimpananAnggotaController@cetak');
});

#TABUNGAN BERJANGKA
Route::prefix('tabungan-berjangka')->group(function() {
    Route::get('/', 'TabunganBerjangkaController@index');
	Route::match(array('GET', 'POST'),'/datatables','TabunganBerjangkaController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','TabunganBerjangkaController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','TabunganBerjangkaController@edit');
	Route::match(array('GET', 'POST'),'/setoran/{id}','TabunganBerjangkaController@lookup_form_setoran');
	Route::match(array('GET', 'POST'),'/penarikan/{id}','TabunganBerjangkaController@lookup_form_penarikan');
	Route::match(array('GET', 'POST'),'/simpan-tabungan-berjangka','TabunganBerjangkaController@simpan_tabungan_berjangka');
	Route::match(array('GET', 'POST'),'/detail/{id}','TabunganBerjangkaController@detail');
	Route::match(array('GET', 'POST'),'/datatables-tabungan-berjangka','TabunganBerjangkaController@datatables_collection_tabungan_berjangka');
	Route::match(array('GET', 'POST'),'/list-setoran','TabunganBerjangkaController@list_setoran');
	Route::match(array('GET', 'POST'),'/list-penarikan','TabunganBerjangkaController@list_penarikan');
	Route::match(array('GET', 'POST'),'/proses-setoran/{id}','TabunganBerjangkaController@proses_setoran');
	Route::match(array('GET', 'POST'),'/proses-penarikan/{id}','TabunganBerjangkaController@proses_penarikan');
	Route::match(array('GET'),'/cetak-tabungan/{id}','TabunganBerjangkaController@cetak_tabungan');
	Route::match(array('GET', 'POST'),'/simulasi/{id1}/{id2}/{id3}/{id4}/{id5}/{id6}/{id7}','TabunganBerjangkaController@simulasi');
});

#PINJAMAN
Route::prefix('pinjaman')->group(function() {
    Route::get('/', 'PinjamanController@index');
	Route::match(array('GET', 'POST'),'/datatables','PinjamanController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','PinjamanController@create');
	Route::match(array('GET', 'POST'),'/edit/{id}','PinjamanController@edit');
	Route::match(array('GET', 'POST'),'/nasabah','PinjamanController@datatables_collection_nasabah');
	Route::match(array('GET'),'/get_saldo/{id}','PinjamanController@get_saldo');
	Route::match(array('GET', 'POST'),'/bayar/{id}','PinjamanController@bayar');
	Route::match(array('GET', 'POST'),'/lunas/{id}','PinjamanController@lunas');
	Route::match(array('GET', 'POST'),'/details/{id}','PinjamanController@details');
	Route::match(array('GET', 'POST'),'/angsuran','PinjamanController@angsuran');
	Route::match(array('GET', 'POST'),'/datatables-angsuran','PinjamanController@datatables_collection_angsuran');
	Route::match(array('GET', 'POST'),'/proses/{id}','PinjamanController@proses');
	Route::match(array('GET'),'/cetak-detail/{id}','PinjamanController@cetak_detail');
	Route::match(array('GET', 'POST'),'/simulasi/{id1}/{id2}/{id3}/{id4}/{id5}/{id6}/{id7}/{id8}/{id9}/{id10}','PinjamanController@simulasi');
});

#DASHBOARD
Route::prefix('dashboard')->group(function() {
	Route::get('/','Dashboard@index');
	Route::match(array('GET', 'POST'),'/refresh','Dashboard@refresh');
	Route::post('/chart','Dashboard@chart');
});

#MUTASI KAS
Route::prefix('mutasi-kas')->group(function() {
    Route::get('/', 'MutasiController@index');
	Route::match(array('GET', 'POST'),'/datatables','MutasiController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','MutasiController@create');
	Route::match(array('GET', 'POST'),'/detail/{id}','MutasiController@detail');
	Route::match(array('GET', 'POST'),'/lookup_detail/{id}','MutasiController@lookup_detail');


});

#JURNAL
Route::prefix('jurnal')->group(function() {
    Route::get('/', 'JurnalController@index');
	Route::match(array('GET', 'POST'),'/datatables','JurnalController@datatables_collection');
	Route::match(array('GET', 'POST'),'/create','JurnalController@create');
	Route::match(array('GET', 'POST'),'/detail/{id}','JurnalController@detail');
	Route::match(array('GET', 'POST'),'/lookup_akun','JurnalController@lookup_akun');
});

#LAPORAN
Route::prefix('laporan')->group(function() {
	Route::get('/simpanan-anggota','Laporan@simpanan_anggota');
	Route::post('/simpanan-anggota/print','Laporan@print_simpanan_anggota');

	Route::get('/tabungan-sukarela','Laporan@tabungan_sukarela');
	Route::post('/tabungan-sukarela/print','Laporan@print_tabungan_sukarela');

	Route::get('/tabungan-berjangka','Laporan@tabungan_berjangka');
	Route::post('/tabungan-berjangka/print','Laporan@print_tabungan_berjangka');

	Route::get('/pinjaman','Laporan@pinjaman');
	Route::post('/pinjaman/print','Laporan@print_pinjaman');

	Route::get('/keuangan','Laporan@keuangan');
	Route::post('/keuangan/print-jurnal-umum','Laporan@print_jurnal_umum');
	Route::post('/keuangan/print-buku-besar','Laporan@print_buku_besar');
	Route::post('/keuangan/print-laba-rugi','Laporan@print_laba_rugi');
	Route::post('/keuangan/print-neraca','Laporan@print_neraca');
	Route::post('/keuangan/print-arus-kas','Laporan@print_arus_kas');
	Route::post('/keuangan/print-neraca-lajur','Laporan@print_neraca_lajur');
});

#NASABAH
Route::prefix('nasabah')->group(function() {
    Route::get('/tabungan', 'TabunganController@tabungan_nasabah');
	Route::match(array('GET', 'POST'),'/tabungan/datatables','TabunganController@datatables_collection_nasabah');

	Route::get('/tabungan-berjangka', 'TabunganBerjangkaController@tabungan_nasabah');
	Route::match(array('GET', 'POST'),'/tabungan-berjangka/datatables','TabunganBerjangkaController@datatables_collection_nasabah');

	Route::get('/simpanan-anggota', 'SimpananAnggotaController@tabungan_nasabah');
	Route::match(array('GET', 'POST'),'/simpanan-anggota/datatables','SimpananAnggotaController@datatables_collection_nasabah');
	Route::match(array('GET', 'POST'),'/simpanan-anggota-pokok/datatables','SimpananAnggotaController@datatables_collection_simpanan_pokok_nasabah');

	Route::get('/pinjaman', 'PinjamanController@pinjaman_nasabah');
	Route::match(array('GET', 'POST'),'/pinjaman/datatables','PinjamanController@datatables_collection_pinjaman_nasabah');
});

});

?>