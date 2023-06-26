<?php

class Laundry {
    private $db;

    public function __construct() {
        require_once 'Database.php';

        $this->db = new Database();
    }

    public function getTransactions() {
        $connection = $this->db->getConnection();
        $sql = "SELECT * FROM transactions ORDER BY tanggal DESC";
        $result = $connection->query($sql);

        $transactions = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $transactions[] = $row;
            }
        }

        return $transactions;
    }

    public function addTransaction($amount, $type) {
        $connection = $this->db->getConnection();
        $tanggal = date('Y-m-d');
        $hargaSatuan = 6000;
    
        // Hitung total harga
        $totalHarga = $amount * $hargaSatuan;
    
        $sql = "INSERT INTO transactions (tanggal, jumlah, jenis, harga_per_kg, total_harga) 
                VALUES ('$tanggal', '$amount', '$type', '$hargaSatuan', '$totalHarga')";
    
        if ($connection->query($sql) === true) {
            echo "Transaksi berhasil ditambahkan";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }
    

    public function deleteTransaction($id) {
        $connection = $this->db->getConnection();

        $sql = "DELETE FROM transactions WHERE id = '$id'";

        if ($connection->query($sql) === true) {
            echo "Transaksi berhasil dihapus";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }
    public function calculatePrice($amount) {
        $hargaSatuan = 6000;
        $totalHarga = $amount * $hargaSatuan;
        return $totalHarga;
    }
    
}
