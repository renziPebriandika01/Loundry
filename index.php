<?php
require_once 'Classes/Laundry.php';

// Buat objek Laundry
$laundry = new Laundry();

// Tampilkan daftar pemasukan dan pengeluaran
$transactions = $laundry->getTransactions();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Management</title>
    <link rel="stylesheet" href="dist/output.css">
</head>

<body class="ml-5">
    <h1 class="text-center font-semibold text-blue-500 mt-10 text-2xl">Laundry Management</h1>

    <p class="">harga 1kg adalah Rp.6000</p>

    <!-- Tampilkan formulir untuk menambahkan transaksi baru -->

    <form action="process.php" method="post" class="mt-4">
        <input type="hidden" name="action" value="add">
        <div class="mb-4">
            <label for="amount" class="block text-gray-700 font-medium">Jumlah:</label>
            <input type="text" name="amount" id="amount" class="border border-gray-300 rounded px-3 py-2 w-60" required>
        </div>
        <div class="mb-4">
            <label for="type" class="block text-gray-700 font-medium">Jenis:</label>
            <select name="type" id="type" class="border border-gray-300 rounded px-3 py-2 w-60">
                <option value="pemasukan">Pemasukan</option>
                <option value="pengeluaran">Pengeluaran</option>
            </select>
        </div>
        <div class="flex">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">Tambah</button>
            <button onclick="printTable()"
                class="bg-green-500 hover:bg-green-700 text-white font-medium py-2 px-4 rounded mt-4 ml-3">Cetak</button>
        </div>

    </form>


    <!-- Tampilkan daftar pemasukan dan pengeluaran -->
    <h2 class="mt-3 mb-3 text-center font-semibold text-blue-500">Daftar Transaksi</h2>
    <div class="w-full">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jumlah</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jenis</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total Harga</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php echo $transaction['tanggal']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php echo $transaction['jumlah'] . " kg"; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php echo $transaction['jenis']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp.
                            <?php echo $laundry->calculatePrice($transaction['jumlah']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="process.php?action=delete&id=<?php echo $transaction['id']; ?>"
                                class="text-red-600 hover:text-red-900">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
<script>
        function printTable() {
        window.print();
    }
</script>

</html>