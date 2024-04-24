<a href="tambah/tambah.php"
    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Tambah Data Penyewaan</a>
<a href="cetak.php" target="_blank"
    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Cetak</a>
<a href="../dashboard.php"
    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
<form action="../dashboard.php" method="get" class="mb-4 inline-block">
    <label for="perPage" class="mr-2 font-bold">Tampilkan </label>
    <select name="perPage" id="perPage" onchange="this.form.submit()" class="px-3 py-2 border rounded">
        <option value="15" class="py-1" <?php isset($_GET['perPage']) && $_GET['perPage'] == 15 ? 'selected' : '' ?>>15</option>
        <option value="25" class="py-1" <?php isset($_GET['perPage']) && $_GET['perPage'] == 25 ? 'selected' : '' ?>>25</option>
        <option value="35" class="py-1" <?php isset($_GET['perPage']) && $_GET['perPage'] == 35 ? 'selected' : '' ?>>35</option>
        <option value="50" class="py-1" <?php isset($_GET['perPage']) && $_GET['perPage'] == 50 ? 'selected' : '' ?>>50</option>
    </select>
</form>
<table class="border-collapse border border-gray-400 w-full">
    <thead>
        <tr>
            <th class="border border-gray-400 px-4 py-2"> No </th>
            <th class="border border-gray-400 px-4 py-2"> ID Penyewa </th>
            <th class="border border-gray-400 px-4 py-2"> Nama Peminjam </th>
            <th class="border border-gray-400 px-4 py-2"> Tanggal Pinjam </th>
            <th class="border border-gray-400 px-4 py-2"> Tanggal Balik </th>
            <th class="border border-gray-400 px-4 py-2"> Motor </th>
            <th class="border border-gray-400 px-4 py-2"> Harga per Hari </th>
            <th class="border border-gray-400 px-4 py-2"> Unit </th>
            <th class="border border-gray-400 px-4 py-2"> Gambar </th>
            <th class="border border-gray-400 px-4 py-2"> Aksi </th>
        </tr>
    </thead>
    <tbody>
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
                            echo "<td class='border border-gray-400 px-4 py-2' rowspan='{$rowSpanCount}'>" . $no++ . "</td>";
                            echo "<td class='border border-gray-400 px-4 py-2' rowspan='{$rowSpanCount}'>" . $userAmbilData['id_penyewaan'] . "</td>";
                            echo "<td class='border border-gray-400 px-4 py-2' rowspan='{$rowSpanCount}'>" . $userAmbilData['namapenyewa'] . "</td>";
                            echo "<td class='border border-gray-400 px-4 py-2' rowspan='{$rowSpanCount}'>" . $userAmbilData['tanggal_pinjam'] . "</td>";
                            echo "<td class='border border-gray-400 px-4 py-2' rowspan='{$rowSpanCount}'>" . $userAmbilData['tanggal_balik'] . "</td>";
                            $firstRow = false;
                        }
                            echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['motor'] . "</td>";
                            echo "<td class='border border-gray-400 px-4 py-2'>Rp." . $userAmbilData['harga'] . "/Hari</td>";
                            echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['unit'] . "</td>";
                            echo "<td class='border border-gray-400 px-4 py-2'><img src='../kendaraan/aset/" . $userAmbilData['gambar'] ."' alt='{$userAmbilData['gambar']}' width='180' height='150'></td>";
                        
                            if ($key === 0) {
                                echo "<td class='border border-gray-400 px-4 py-2' rowspan='{$rowSpanCount}'>";
                                if (isset($userAmbilData['id_penyewaan'])) {
                                    echo "<a href='cetak/cetak.php?id_penyewaan={$userAmbilData['id_penyewaan']}' target='_blank'
                                                class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded'> Cetak </a>";
                                }
                                echo "</td>";
                            }
                        echo "</tr>";
                    }
                }
            } else {
                echo "</tr><td class='border border-gray-400 px-4 py-2' colspan='10'>Data tidak ditemukan.</td></tr>";
            }
        ?>
    </tbody>
</table>