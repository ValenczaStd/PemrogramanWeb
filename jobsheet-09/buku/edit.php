<?php
require __DIR__ . '/../includes/koneksi.php'; $page_title='Edit Buku';
$id=(int)($_GET['id']??0); if($id<=0){header('Location: list.php');exit;}
$stmt=$pdo->prepare('SELECT * FROM buku WHERE id=:id');$stmt->execute(['id'=>$id]);$buku=$stmt->fetch();if(!$buku){$_SESSION['flash']=['type'=>'error','pesan'=>'Data buku tidak ditemukan.'];header('Location: list.php');exit;}
include __DIR__ . '/../includes/header.php';$flash=$_SESSION['flash']??null;unset($_SESSION['flash']);function h($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
?>
<section class="card shadow-sm mb-4"><div class="card-body"><h2 class="text-brand mb-3">Edit Buku</h2><?php if($flash):?><p class="flash flash-<?php echo h($flash['type']);?>"><?php echo h($flash['pesan']);?></p><?php endif;?>
<form id="form-tambah" method="post" action="proses_edit.php"><input type="hidden" name="id" value="<?php echo (int)$buku['id'];?>">
<div class="mb-3"><label class="form-label" for="judul">Judul</label><input class="form-control" id="judul" name="judul" value="<?php echo h($buku['judul']);?>" required></div>
<div class="mb-3"><label class="form-label" for="pengarang">Pengarang</label><input class="form-control" id="pengarang" name="pengarang" value="<?php echo h($buku['pengarang']);?>" required></div>
<div class="mb-3"><label class="form-label" for="tahun">Tahun Terbit</label><input class="form-control" type="number" min="1900" max="2026" id="tahun" name="tahun" value="<?php echo h($buku['tahun']);?>" required></div>
<div class="mb-3"><label class="form-label" for="isbn">ISBN</label><input class="form-control" id="isbn" name="isbn" value="<?php echo h($buku['isbn']);?>"></div>
<div class="mb-3"><label class="form-label" for="stok">Stok</label><input class="form-control" type="number" min="0" id="stok" name="stok" value="<?php echo h($buku['stok']);?>" required></div>
<div class="mb-3"><label class="form-label" for="kategori">Kategori</label><select class="form-select" id="kategori" name="kategori"><?php foreach(['fiksi'=>'Fiksi','non-fiksi'=>'Non-Fiksi','referensi'=>'Referensi'] as $val=>$label):?><option value="<?php echo h($val);?>" <?php echo $buku['kategori']===$val?'selected':'';?>><?php echo h($label);?></option><?php endforeach;?></select></div>
<button class="btn btn-brand" type="submit">Simpan Perubahan</button> <a class="btn btn-outline-secondary" href="list.php">Batal</a></form></div></section><?php include __DIR__ . '/../includes/footer.php'; ?>