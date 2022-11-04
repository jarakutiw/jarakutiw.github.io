<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

<head>
    <title>DATA RESPONDEN</title>
</head>

<body style="background-color:white ;">
    <?php
    $koneksi = mysqli_connect("localhost", "root", "", "pandemik_rozak");
    function tambah($koneksi){
        if (isset($_POST['simpan'])){
           $nama_responden = $_POST['nama_responden'];
           $alamat_responden = $_POST['alamat_responden'];
           $jk_responden = $_POST['jk_responden'];
            $id = $_POST['id'];

           
    

            if(!empty($nama_responden) && !empty($alamat_responden) && !empty($jk_responden) && !empty($id)){
                
                $sql = "insert into responden(nama_responden,alamat_responden,jk_responden,id)values('$nama_responden','$alamat_responden','$jk_responden',$id);";
                $simpan= mysqli_query($koneksi, $sql);
                if ($simpan){
                    echo "<script> alert('DATA BERHASIL DISIMPAN');</script>";
                }
                if($simpan && isset($_GET['aksi'])){
                    if($_GET['aksi'] == 'create'){
                        header("location:crud1.php");
                    }
            }
        }
        else{
            $pesan = "Tid_kotaak dapat menyimpan, data belum lengkap!";
        }
    }
}

    ?>
    <div class="container">
        <H1 class="text-center text-danger font-weight-bold">PERAN MAHASISWA TERHADAP Pandemik</H1>
        <H2 class="text-center font-italic">Rozak</H2>
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                INPUT DATA POTENSI Pandemik
            </div>
            <div class="card-body">
                <form action="" method="post">


                    <div class="form-group">
                        <label for="nama_responden">nama responden</label>
                        <input type="text" name="nama_responden" class="form-control" id_kota="nama_responden"
                            placeholder="Masukan... .">
                    </div>
                    <div class="form-group">
                        <label for="alamat_responden">Alamat Responden</label>
                        <input type="text" name="alamat_responden" class="form-control" id_kota="alamat_responden"
                            placeholder="Masukan...">
                    </div>
                    <div class="form-group">
                        <label for="alamat_responden">Jenis kelamin</label>
                        <input type="text" name="jk_responden" class="form-control" id_kota="jk_responden"
                            placeholder="Masukan...">
                    </div>

                    <div class="form-group">
                        <label for="id_kota">Kota</label>
                        <?php
                    $test = mysqli_query($koneksi,"SELECT * from kota");
                
                ?>
                        <select name="id" class="form-control">
                            <?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($category = mysqli_fetch_array($test)):; 
            ?>
                            <option value="<?php echo $category["id"];
                    // The value we usually set is the primary key
                ?>">
                                <?php echo $category["nama_kota"];
                        // To show the category name to the user
                    ?>
                            </option>
                            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
                        </select> </div>

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
    $sql = "SELECT id_kota,nama_responden,alamat_responden,jk_responden,nama_kota FROM responden inner join kota on responden.id = kota.id";
    $query = mysqli_query($koneksi, $sql);
    ?>
    <div class="card m-3">
        <div class="card-header bg-success text-white">
            Data Potensi pandemik
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>nama_responden</th>
                        <th>alamat responden</th>
                        <th>Jenis Kelamin</th>
                        <th>Kota</th>
                        <th>Aksi</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($data = mysqli_fetch_array($query)){
                        ?>
                    <tr>
                        <td><?php echo $data['id_kota']; ?></td>
                        <td><?php echo $data['nama_responden']; ?></td>
                        <td><?php echo $data['alamat_responden']; ?></td>
                        <td><?php echo $data['jk_responden']; ?></td>
                        <td><?php echo $data['nama_kota']; ?></td>

                        <td>
                            <a href="crud1.php?aksi=update&id_kota=<?php echo $data['id_kota']; ?>&nama_responden=<?php echo $data['nama_responden']; ?>&alamat_responden=<?php echo $data['alamat_responden']; ?>&jk_responden=<?php echo $data['jk_responden']; ?>"
                                class="btn btn-warning">update</a>
                            <a href="crud1.php?aksi=delete&id_kota=<?php echo $data['id_kota']; ?>"
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
        $id_kota = $_POST['id_kota'];
        $nama_responden = $_POST['nama_responden'];
        $alamat_responden = $_POST['alamat_responden'];
        $jk_responden = $_POST['jk_responden'];
        
        if(!empty($id_kota) && !empty($nama_responden) && !empty($alamat_responden) && !empty($jk_responden)){
            $sql = "UPDATE  responden SET nama_responden='$nama_responden', alamat_responden='$alamat_responden', jk_responden='$jk_responden' WHERE id_kota= $id_kota";
            $update = mysqli_query($koneksi, $sql);
            
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header("location:crud1.php");
                    
                }
            }
            
        }
        else{
            $pesan = "Tid_kotaak dapat menyimpan, data belum lengkap!";
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
                            <label for="id_kota">id_kota</label>
                            <input type="text" name="id_kota" class="form-control" id_kota="id_kota"
                                value="<?php echo $_GET['id_kota']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_responden">nama_responden </label>
                            <input type="text" name="nama_responden" class="form-control" id_kota="nama_responden"
                                value="<?php echo $_GET['nama_responden']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat_responden">Alamat</label>
                            <input type="text" name="alamat_responden" class="form-control" id_kota="alamat_responden"
                                value="<?php echo $_GET['alamat_responden']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="jk_responden">jenis Kelamin</label>
                            <input type="text" name="jk_responden" class="form-control" id_kota="jk_responden"
                                value="<?php echo $_GET['jk_responden']; ?>">
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
    if(isset($_GET['id_kota'])&& isset($_GET['aksi'])){
        $id_kota = $_GET['id_kota'];
        $sql = "DELETE FROM responden WHERE id_kota=$id_kota";
        $delete = mysqli_query($koneksi, $sql);
        if($delete){
            if($_GET['aksi'] == 'delete'){
                header("location:crud1.php");
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
            echo '<a href="crud.php"> &laquo; Home</a>';
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
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tid_kotaaka ada!</h3>";
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