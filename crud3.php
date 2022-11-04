<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

<head>
    <title>KOTA</title>
</head>

<body>
    <?php
    $koneksi = mysqli_connect("localhost", "root", "", "pandemik_rozak");
    function tambah($koneksi){
        if (isset($_POST['simpan'])){
           $id = $_POST['id'];
           $nama_kota = $_POST['nama_kota'];
           $provinsi = $_POST['provinsi'];
           
    

            if(!empty($id) && !empty($nama_kota) && !empty($provinsi)){
                $sql = "INSERT INTO kota VALUES ($id, '$nama_kota', '$provinsi');";
                $simpan= mysqli_query($koneksi, $sql);
                if ($simpan){
                    echo "<center>Data berhasil Ditambahkan</center>" ;
                }
                if($simpan && isset($_GET['aksi'])){
                    if($_GET['aksi'] == 'create'){
                        header("location:crud3.php");
                    }
            }
        }
        else{
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
}

    ?>
    <div class="container">
        <H1 class="text-center font-weight-bold">PERAN MAHASISWA TERHADAP Pandemik</H1>
        <H2 class="text-center font-italic">mohammad rozak</H2>
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                kota
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" name="id" class="form-control" id="id" placeholder="Masukan...">
                    </div>
                    <div class="form-group">
                        <label for="nama_kota">Nama kota</label>
                        <input type="text" name="nama_kota" class="form-control" id="nama_kota" placeholder="Masukan...">
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" id="provinsi"
                            placeholder="Masukan...">
                    </div>
                   
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <button class="btn btn-primary"><a href="index.html" class="text-white">Kembali ke home</a></button>

                </form>
            </div>
            <div>
                <?php
                    if(isset($pesan)){
                        echo $pesan;
                    }
                    ?>
            </div>
            </form>
        </div>
    </div>
    <?php
        
// --- Tutup Fngsi tambah data
// --- Fungsi Baca Data (Read)
function tampil_data($koneksi){
    $sql = "SELECT * FROM kota";
    $query = mysqli_query($koneksi, $sql);
    ?>
    <div class="card m-3">
        <div class="card-header bg-success text-white">
            Data Sembako
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>nama_kota</th>
                        <th>provinsi</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($data = mysqli_fetch_array($query)){
                        ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['nama_kota']; ?></td>
                        <td><?php echo $data['provinsi']; ?></td>
                        <td>
                            <a href="crud3.php?aksi=update&id=<?php echo $data['id']; ?>&nama_kota=<?php echo $data['nama_kota']; ?>&provinsi=<?php echo $data['provinsi']; ?>"
                                class="btn btn-warning">update</a>
                            <a href="crud3.php?aksi=delete&id=<?php echo $data['id']; ?>"
                                class="btn btn-danger">delete</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
}
        // --- Tutup Fungsi Baca Data
            // --- Fungsi Ubah Data (Update)
function update($koneksi){
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $nama_kota = $_POST['nama_kota'];
        $provinsi = $_POST['provinsi'];



        if(!empty($id) && !empty($nama_kota) && !empty($provinsi)){
            $sql = "UPDATE kota SET nama_kota='$nama_kota', provinsi='$provinsi' WHERE id=$id";
            $update = mysqli_query($koneksi, $sql);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header("location:crud3.php");
                }
            }
        }
        else{
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }

 // tampilkan form ubah
 if(isset($_GET['aksi'])){
     ?>
            <div class="card card-body">
                <div class="card-header bg-warning text-white">
                    Ubah Data Club
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" name="id" class="form-control" id="id" value="<?php echo $_GET['id']; ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_kota">nama_kota </label>
                            <input type="text" name="nama_kota" class="form-control" id="nama_kota"
                                value="<?php echo $_GET['nama_kota']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" id="provinsi"
                                value="<?php echo $_GET['provinsi']; ?>">
                        </div>
                        
                        <button type="submit" name="update" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
            <?php
    }
}
// --- Tutup Fungsi Update
// --- Fungsi Delete
function delete($koneksi){
    if(isset($_GET['id'])&& isset($_GET['aksi'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM kota WHERE id=$id";
        $delete = mysqli_query($koneksi, $sql);
        if($delete){
            if($_GET['aksi'] == 'delete'){
                header("location:crud3.php");
            }
        }
    }
}
// --- Tutup Fungsi Hapus
// ===================================================================
// --- Program Utama
if(isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case 'tambah':
            echo '<a href="crud 1.php"> &laquo; Home</a>';
            tambah($koneksi);
            break;
        case 'update':
            update($koneksi);
            tampil_data($koneksi);
            break;
        case 'delete':
            delete($koneksi);
            tampil_data($koneksi);
            break;
            default:
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
            tambah($koneksi);
            tampil_data($koneksi);
        }
    }
    else{
        tambah($koneksi);
        tampil_data($koneksi);
    }
    ?>

            <script type="text/javascript" src="js/bootsrap.min"></script>
</body>

</html>