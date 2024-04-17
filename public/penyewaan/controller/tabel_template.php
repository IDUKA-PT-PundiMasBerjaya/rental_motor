<a href="#">| Tambah Data Penyewaan |</a>
<a href="#" target="_blank">| Cetak |</a>
<a href="../../dashboard.php">| Home |</a>
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
        <th> ID Penyewa </th>
        <th> Nama Peminjam </th>
        <th> Tanggal Pinjam </th>
        <th> Tanggal Balik </th>
        <th> Motor </th>
        <th> Harga </th>
        <th> Gambar </th>
        <th> Aksi </th>
    </tr>
    <?php 
        $prevPenyewaanID = null;
        $rowSpanCounts = [];

        if ($num > 0) {
            while ($row = mysqli_fetch_array($ambildata)) {
                $penyewaanID = $row['id_penyewaan'];
                $rowSpanCounts[$penyewaanID][] = $row;
            }

            mysqli_data_seek($ambildata, 0);
            $no = $start + 1;
            foreach  ($rowSpanCounts as $penyewaanID => $rows) {
                $rowSpanCount = count($rows);
                $firstRow = true;
                foreach ($rows as $key => $userAmbilData) {
                    echo "<tr>";
                    if ($firstRow) {
                        echo "<td rowspan='{$rowSpanCount}'>" . $no++ . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['id_penyewaan'] . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['namapeminjam'] . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['tanggal_pinjam'] . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['tanggal_balik'] . "</td>";
                        $firstRow = false;
                    }
                        echo "<td>" . $userAmbilData['motor'] . "</td>";
                        echo "<td>Rp." . $userAmbilData['harga_per_hari'] . "/Hari</td>";
                        echo "<td><img src='../kendaraan/aset/" . $userAmbilData['gambar'] ."' alt='{$userAmbilData['gambar']}' width='180' height='150'></td>";
                    
                        if ($key === 0) {
                            echo "<td rowspan='{$rowSpanCount}'>";
                            if (isset($userAmbilData['id_penyewaan'])) {
                                echo "<a href='#?id_penyewaan={$userAmbilData['id_penyewaan']}' target='_blank'> Cetak </a>";
                            }
                            echo "</td>";
                        }
                    echo "</tr>";
                }
            }
        } else {
            echo "</tr><td colspan='9'>Data tidak ditemukan.</td></tr>";
        }
    ?>
</table>