<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <form action="" method="post">
        <div class="all">
            <h1 class="text-center">Form Rental Motor</h1>
            <div class="input-group mb-3 px-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                <input type="text" class="form-control" name="nama" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="Masukkan Nama Lengkap" required>
            </div>

            <div class="input-group mb-3 px-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Lama Rental</span>
                <input type="Number" class="form-control" name="lamarental" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default"
                    placeholder="Masukkan Lama Rental Menggunakan Angka per Hari" required>
            </div>

            <div class="px-3">
                <select class="form-select" aria-label="Default select example" name="jenis">
                    <option selected>Pilih Jenis Motor</option>
                    <option value="Scooter">Scooter</option>
                    <option value="Sport">Motor Sport</option>
                    <option value="SportTouring">Motor Sport Touring</option>
                    <option value="Cross">Motocross</option>
                </select>
            </div>

            <div class="px-3">
                <button type="submit" name="submit" class="btn btn-light my-2 px-3">Submit</button>
            </div>
    </form>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<?php
$proses = new Rental();
$proses->setHarga(70000, 90000, 90000, 100000);

if (isset($_POST['submit'])) {
    $proses->member = strtolower($_POST['nama']);
    $proses->jenis = $_POST['jenis'];
    $proses->waktu = $_POST['lamarental'];
    $proses->pembayaran();
}

class Data
{
    public $member;
    public $jenis;
    public $waktu;
    public $diskon;
    protected $pajak;
    private $Scooter, $Sport, $SportTouring, $Cross;
    private $listMember = ['fiony', 'christy', 'delynn', 'ribka', 'indah'];

    function __construct()
    {
        $this->pajak = 10000;
    }

    public function getMember()
    {
        if (in_array($this->member, $this->listMember)) {
            return "Member";
        } else {
            return "Non Member";
        }
    }

    public function setHarga($jenis1, $jenis2, $jenis3, $jenis4)
    {
        $this->Scooter = $jenis1;
        $this->Sport = $jenis2;
        $this->SportTouring = $jenis3;
        $this->Cross = $jenis4;
    }

    public function getHarga()
    {
        $data["Scooter"] = $this->Scooter;
        $data["Sport"] = $this->Sport;
        $data["Sport Touring"] = $this->SportTouring;
        $data["Cross"] = $this->Cross;
        return $data;
    }
}

class Rental extends Data
{
    public function hargaRental()
    {
        $dataHarga = $this->getHarga()[$this->jenis];
        $diskon = $this->getMember() == "Member" ? 5 : 0;
        if ($this->waktu === 1) {
            $bayar = ($dataHarga - ($dataHarga * $diskon / 100)) + $this->pajak;
        } else {
            $bayar = (($dataHarga * $this->waktu) - ($dataHarga * $diskon / 100)) + $this->pajak;
        }
        return [$bayar, $diskon];
    }

    public function pembayaran()
    {
        echo "<center>";
        echo $this->member . " berstatus sebagai " . $this->getMember() . " mendapatkan diskon sebesar " . $this->hargaRental()[1] . "%";
        echo "<br>";
        echo "Jenis motor yang di rental adalah " . $this->jenis . " selama " . $this->waktu . " hari";
        echo "<br>";
        echo "Harga rental per-harinya : Rp. " . number_format($this->getHarga()[$this->jenis], 0, '', '.');
        echo "<br>";
        echo "<br>";
        echo "Besar yang harus dibayarkan adalah Rp. " . number_format($this->hargaRental()[0], 0, '', '.');
        echo "</center>";
    }
}

?>
</div>
</body>
</html>