<?php
require_once '../config/database.php';
require_once '../includes/header.php';

// Zaten giriş yapmış biri kayıt sayfasına gelirse dashboard'a yönlendir
if (isset($_SESSION['kullanici_id'])) {
    header("Location: ../dashboard.php");
    exit;
}

$hata = '';
$basari = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kadi = trim($_POST['kullanici_adi']);
    $sifre = $_POST['sifre'];
    
    if (empty($kadi) || empty($sifre)) {
        $hata = "Lütfen tüm alanları doldurun.";
    } else {
        // Kullanıcı adının benzersiz olup olmadığını kontrol et
        $stmt = $pdo->prepare("SELECT id FROM kullanicilar WHERE kullanici_adi = ?");
        $stmt->execute([$kadi]);
        
        if ($stmt->rowCount() > 0) {
            $hata = "Bu kullanıcı adı zaten alınmış.";
        } else {
            // Şifreyi Hashle (Proje Zorunluluğu)
            $hashli_sifre = password_hash($sifre, PASSWORD_DEFAULT); 
            
            $insert = $pdo->prepare("INSERT INTO kullanicilar (kullanici_adi, sifre_hash) VALUES (?, ?)");
            if ($insert->execute([$kadi, $hashli_sifre])) {
                $basari = "Kayıt başarılı! Şimdi giriş yapabilirsiniz.";
            } else {
                $hata = "Kayıt sırasında bir hata oluştu.";
            }
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Kayıt Ol</h4>
            </div>
            <div class="card-body">
                <?php if($hata): ?>
                    <div class="alert alert-danger"><?php echo $hata; ?></div>
                <?php endif; ?>
                
                <?php if($basari): ?>
                    <div class="alert alert-success">
                        <?php echo $basari; ?> <a href="login.php" class="alert-link">Giriş Yap</a>
                    </div>
                <?php else: ?>
                    <form method="POST" action="register.php">
                        <div class="mb-3">
                            <label class="form-label">Kullanıcı Adı</label>
                            <input type="text" name="kullanici_adi" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Şifre</label>
                            <input type="password" name="sifre" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kayıt Ol</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>