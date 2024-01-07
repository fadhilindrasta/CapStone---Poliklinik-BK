<?php
include_once("../connection.php");

$polid = isset($_GET['poli_id']) ? $_GET['poli_id'] : null;

$datajadwal = $database->prepare("SELECT a.nama as nama_dokter,
                                         b.hari as hari,
                                         b.id as id,
                                         b.jam_mulai as jam_mulai,
                                         b.jam_selesai as jam_selesai
                                         
                                         FROM dokter as a
                                         INNER JOIN jadwal_periksa as b
                                         ON a.id = b.id_dokter
                                         WHERE a.id_poli = :poli_id");
$datajadwal->bind_param(':poli_id', $polid);
$datajadwal->execute();

if ($datajadwal->num_rows() == 0) {
    echo '<option>Tidak Ada Jadwal</option>';
} else {
    while ($jd = $datajadwal->fetch()) {
        echo '<option value="' . $jd['id'] . '">Dokte ' . $jd['nama_dokter'] . '|' . $jd['hari'] . '</option>';
    }
}
