<?php
require __DIR__ . '/../includes/auth.php';
?>
<?php
require __DIR__ . '/../includes/koneksi.php';if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: list.php');exit;}
$id=(int)($_POST['id']??0);$nama=trim($_POST['nama']??'');$no_anggota=trim($_POST['no_anggota']??'');$alamat=trim($_POST['alamat']??'');$no_hp=trim($_POST['no_hp']??'');
if($id<=0||$nama===''||$no_anggota===''){$_SESSION['flash']=['type'=>'error','pesan'=>'Nama dan nomor anggota wajib diisi.'];header('Location: edit.php?id='.$id);exit;}
$stmt=$pdo->prepare('UPDATE anggota SET nama=:nama,no_anggota=:no_anggota,alamat=:alamat,no_hp=:no_hp WHERE id=:id');$stmt->execute(['nama'=>$nama,'no_anggota'=>$no_anggota,'alamat'=>$alamat?:null,'no_hp'=>$no_hp?:null,'id'=>$id]);$_SESSION['flash']=['type'=>'success','pesan'=>'Anggota berhasil diperbarui.'];header('Location: list.php');exit;
?>