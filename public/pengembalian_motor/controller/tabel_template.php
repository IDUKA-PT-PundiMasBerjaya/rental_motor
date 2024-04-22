<a href="tambah/tambah.php">| Tambah Data pengembalian |</a>
<a href="cetak.php" target="_blank">| Cetak |</a>
<a href="../dashboard.php">| Home |</a>
<form action="../dashboard.php" method="get">
    <label>Tampilkan : </label>
    <select name="perPage" onchange="this.form.submit()">
        <option value="15" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 5 ? 'selected' : ''; ?>>15</option>
        <option value="25" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 10 ? 'selected' : ''; ?>>25</option>
        <option value="35" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 20 ? 'selected' : ''; ?>>35</option>
        <option value="50" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 30 ? 'selected' : ''; ?>>50</option>    
    </select>
</form>
<table border="1">
    <tr>
        <th> No </th>
        <th> ID Pengembalian </th>
        <th> Nama Peminjam </th>
        <th> Tanggal Pengembalian</th>
        <th> Motor </th>
        <th> Unit </th>
        <th> Harga per Hari </th>
        <th> Denda </th>
        <th> Total Harga </th>
        <th> Gambar </th>
        <th> Aksi </th>
    </tr>
    <?php 
        $prevPengembalianID = null;
        $rowSpanCounts = [];

        if ($num > 0) {
            while ($row = mysqli_fetch_array($ambildata)) {
                $pengembalianID = $row['id_pengembalian'];
                $rowSpanCounts[$pengembalianID][] = $row;
            }

            mysqli_data_seek($ambildata, 0);
            $no = $start + 1;
            foreach  ($rowSpanCounts as $pengembalianID => $rows) {
                $rowSpanCount = count($rows);
                $firstRow = true;
                foreach ($rows as $key => $userAmbilData) {
                    echo "<tr>";
                    if ($firstRow) {
                        echo "<td rowspan='{$rowSpanCount}'>" . $no++ . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['id_pengembalian'] . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['namapenyewa'] . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['tanggal_pengembalian'] . "</td>";
                        $firstRow = false;
                    }
                        echo "<td>" . $userAmbilData['motor'] . "</td>";
                        echo "<td>" . $userAmbilData['unit'] . "</td>";
                        echo "<td>Rp." . $userAmbilData['harga'] . "/Hari</td>";
                        echo "<td>" . $userAmbilData['telat_hari'] . " Hari - Rp. " . $userAmbilData['denda'] . "</td>";          
                        echo "<td>Rp." . $userAmbilData['total_harga'] . "</td>";
                        echo "<td><img src='../kendaraan/aset/" . $userAmbilData['gambar'] ."' alt='{$userAmbilData['gambar']}' width='180' height='150'></td>";
                    
                        if ($key === 0) {
                            echo "<td rowspan='{$rowSpanCount}'>";
                            if (isset($userAmbilData['id_pengembalian'])) {
                                echo "<a href='cetak/cetak.php?id_pengembalian={$userAmbilData['id_pengembalian']}' target='_blank'> Cetak </a>";
                            }
                            echo "</td>";
                        }
                    echo "</tr>";
                }
            }
        } else {
            echo "</tr><td colspan='11'>Data tidak ditemukan.</td></tr>";
        }
    ?>
</table>