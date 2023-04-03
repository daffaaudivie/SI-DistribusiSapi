<?php 
    include 'sidebarnav.php';
    include_once 'config.php';
    ob_start();

    $redirect_path = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ;
    if(isset($_POST['create'])) {
        $nama_pemilik = $conn->real_escape_string($_POST['nama_pemilik']);
        $id_peternak = $conn->real_escape_string($_POST['id_peternak']);
        $nama_peternakan = $conn->real_escape_string($_POST['nama_peternakan']);
        $no_hp = $conn->real_escape_string($_POST['no_hp']);
        $norek = $conn->real_escape_string($_POST['norek']);

        $sql = "INSERT INTO peternak (id_peternak, nama_pemilik , nama_peternakan, no_hp, norek) VALUES ('$id_peternak', '$nama_pemilik', '$nama_peternakan', '$no_hp', '$norek')";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    if (isset($_POST['update'])) {
        $nama_pemilik = $conn->real_escape_string($_POST['nama_pemilik']);
        $id_peternak = $conn->real_escape_string($_POST['id_peternak']);
        $nama_peternakan = $conn->real_escape_string($_POST['nama_peternakan']);
        $no_hp = $conn->real_escape_string($_POST['no_hp']);
        $norek = $conn->real_escape_string($_POST['norek']);

        $sql = "UPDATE peternak SET nama_pemilik = '$nama_pemilik', nama_peternakan = '$nama_peternakan', no_hp = '$no_hp', norek = '$norek' WHERE id_peternak = '$id_peternak'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    if (isset($_POST['delete'])) {
        $id_peternak = $conn->real_escape_string($_POST['delete']);
        $sql = "DELETE FROM peternak WHERE id_peternak = '$id_peternak'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }
?>

<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="page-breadcrumb">
                    <div class="row align-items-center">
                        <div class="align-self-center d-flex gap-3">
                            <h3 class="page-title mb-0 p-0">Data Peternak</h3>
                            <?php if(!isset($_GET['add'])): ?>
                                <a href="?add=true" class="btn btn-success">
                                    Tambah Data Peternak +
                                </a>
                            <?php endif?>
                        </div>

                    <!-- table  -->
                    <?php if(isset($_GET['add'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-group">
                                <label for="id_peternak">ID Peternak</label>
                                <input id="id_peternak" name="id_peternak" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_pemilik">Nama Pemilik</label>
                                <input id="nama_pemilik" name="nama_pemilik" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_peternakan">Nama Peternakan</label>
                                <input id="nama_peternakan" name="nama_peternakan" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor HP</label>
                                <input id="no_hp" name="no_hp" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="norek">Norek</label>
                                <input id="norek" name="norek" type="text" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-block btn-success" name="create">Tambah</button>
                        </form>
                        
                    <?php endif?>

                    <?php if(isset($_GET['edit'])): ?>
                        <form class="mt-2" action="" method="post">
                        <div class="form-group">
                                <label for="id_peternak">ID Peternak</label>
                                <input id="id_peternak" name="id_peternak" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_pemilik">Nama Pemilik</label>
                                <input id="nama_pemilik" name="nama_pemilik" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_peternakan">Nama Peternakan</label>
                                <input id="nama_peternakan" name="nama_peternakan" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor HP</label>
                                <input id="no_hp" name="no_hp" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="norek">Norek</label>
                                <input id="norek" name="norek" type="text" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-block btn-success" name="update" value="<?= $_GET['edit']?>">Ubah</button>
                        </form>
                    <?php endif?>

                    <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                        <div class="my-4">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemilik</th>
                                    <th>Nama Peternakan</th>
                                    <th>No HP</th>
                                    <th>Norek</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $result = mysqli_query($conn, "SELECT * FROM peternak"); ?>
                                <?php while ($data = mysqli_fetch_array($result)): ?>
                                    <tr>
                                        <td><?= $data['id_peternak'] ?></td>
                                        <td><?= $data['nama_pemilik'] ?></td>
                                        <td><?= $data['nama_peternakan'] ?></td>
                                        <td><?= $data['no_hp'] ?></td>
                                        <td><?= $data['norek'] ?></td>
                                        <td class="d-flex gap-3">
                                            <a class="btn btn-outline-primary" href="?edit=<?= $data['id_peternak'] ?>&nama_pemilik=<?= $data['nama_pemilik']?>&no_hp=<?= $data['no_hp']?>&norek=<?= $data['norek']?>">Ubah</a>

                                            <form action="" method="post">
                                                <button type="submit" class="btn btn-outline-danger" name="delete" value="<?= $data['id_peternak'] ?>">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif?>

                    </div>
                </div>        
            </div>
            <?php require_once('footer.php') ?>
        </div>
    <!-- ============================================================== -->
<!-- End Wrapper -->

<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>