<?php
require_once 'Classes/Laundry.php';

// Buat objek Laundry
$laundry = new Laundry();

// Periksa tindakan yang dikirimkan melalui metode POST atau GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $amount = $_POST['amount'];
        $type = $_POST['type'];

        // Tambahkan transaksi
        $laundry->addTransaction($amount, $type);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'];

    if ($action === 'delete') {
        $id = $_GET['id'];

        // Hapus transaksi
        $laundry->deleteTransaction($id);
    }
}

// Redirect kembali ke halaman utama setelah pemrosesan selesai
header("Location: index.php");
exit();
?>
