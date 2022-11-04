<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

<head>
    <title>BANTUAN PEMERINTAH</title>
</head>

<body>
    <?php
    $koneksi = mysqli_connect("localhost", "root", "", "pandemik_rozak");
    function tambah($koneksi){
        if (isset($_POST['simpan'])){
           $sikap = $_POST['sikap'];
           $kerugian = $_POST['kerugian'];

           
    

            if(!empty($sikap) && !empty($kerugian)){
                $sql = "INSERT INTO parameter (sikap, kerugian) VALUES ('$sikap', '$kerugian');";
                $simpan= mysqli_query($koneksi, $sql);
                if ($simpan){ 
                    echo "berhasil" ;
                }
                if($simpan && isset($_GET['aksi'])){
                    if($_GET['aksi'] == 'create'){
                        header("location:crud2.php");
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
        <H2 class="text-center font-italic">Rozak</H2>
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                Parameter
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="sikap">Sikap</label>
                        <input type="text" name="sikap" class="form-control" sikap="sikap" placeholder="Masukan...">
                    </div>
                    <div class="form-group">
                        <label for="kerugian">kerugian</label>
                        <input type="text" name="kerugian" class="form-control" sikap="kerugian" placeholder="Masukan...">
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
    $sql = "SELECT * FROM parameter";
    $query = mysqli_query($koneksi, $sql);
    ?>
    <div class="card m-3">
        <div class="card-header bg-success text-white">
            Data Parameter
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sikap</th>
                        <th>Kerugian</th>
                        <th>aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($data = mysqli_fetch_array($query)){
                        ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['sikap']; ?></td>
                        <td><?php echo $data['kerugian']; ?></td>
                        <td>
                            <a href="crud2.php?aksi=update&id=<?php echo $data['id']; ?>&sikap=<?php echo
                                $data['sikap']; ?>&kerugian=<?php echo $data['kerugian']; ?>"
                                class="btn btn-warning">update</a>
                            <a href="crud2.php?aksi=delete&id=<?php echo $data['id']; ?>"
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
        $sikap = $_POST['sikap'];
        $kerugian = $_POST['kerugian'];
        $id = $_GET['id'];


        if(!empty($sikap) && !empty($kerugian)){
            $sql = "UPDATE parameter SET sikap = '$sikap', kerugian='$kerugian' WHERE id=$id";
            $update = mysqli_query($koneksi, $sql);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header("location:crud2.php");
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
                            <label for="sikap">Sikap</label>
                            <input type="text" name="sikap" class="form-control" id="sikap" value="<?php echo $_GET['sikap']; ?>"
                                >
                        </div>
                        <div class="form-group">
                            <label for="kerugian">kerugian </label>
                            <input type="text" name="kerugian" class="form-control" id="kerugian"
                                value="<?php echo $_GET['kerugian']; ?>">
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
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM parameter WHERE id= $id";
        $delete = mysqli_query($koneksi, $sql);
        if($delete){
            if($_GET['aksi'] == 'delete'){
                header("location:crud2.php");
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
            echo '<a href="crud 2.php"> &laquo; Home</a>';
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
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tsikapaka ada!</h3>";
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