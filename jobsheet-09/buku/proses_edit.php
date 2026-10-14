<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: list.php');exit;}
$id=(int)($_POST['id']??0);$judul=trim($_POST['judul']??'');$pengarang=trim($_POST['pengarang']??'');$tahun=filter_var($_POST['tahun']??null,FILTER_VALIDATE_INT);$isbn=trim($_POST['isbn']??'');$stok=filter_var($_POST['stok']??null,FILTER_VALIDATE_INT);$kategori=trim($_POST['kategori']??'');
if($id<=0||$judul===''||$pengarang===''||$tahun===false||$tahun<1900||$tahun>2026||$stok===false||$stok<0){$_SESSION['flash']=['type'=>'error','pesan'=>'Data tidak valid. Periksa kembali form edit.'];header('Location: edit.php?id='.$id);exit;}
$stmt=$pdo->prepare('UPDATE buku SET judul=:judul,pengarang=:pengarang,tahun=:tahun,isbn=:isbn,stok=:stok,kategori=:kategori WHERE id=:id');$stmt->execute(['judul'=>$judul,'pengarang'=>$pengarang,'tahun'=>$tahun,'isbn'=>$isbn?:null,'stok'=>$stok,'kategori'=>$kategori,'id'=>$id]);$_SESSION['flash']=['type'=>'success','pesan'=>'Buku berhasil diperbarui.'];header('Location: list.php');exit;
?>