<?php
require_once '../config/database.php';
require_once '../includes/header.php';

// Redirect to dashboard if the user is already logged in
if (isset($_SESSION['kullanici_id'])) {
    header("Location: ../dashboard.php");
    exit;
}

$hata = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kadi = trim($_POST['kullanici_adi']);
    $sifre = $_POST['sifre'];
    
    if (empty($kadi) || empty($sifre)) {
        $hata = "Lütfen tüm alanları doldurun.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi = ?");
        $stmt->execute([$kadi]);
        $kullanici = $stmt->fetch();
        
        // Project Rule: Verify hashed password and use Sessions
        if ($kullanici && password_verify($sifre, $kullanici['sifre_hash'])) {
            $_SESSION['kullanici_id'] = $kullanici['id'];
            $_SESSION['kullanici_adi'] = $kullanici['kullanici_adi'];
            
            header("Location: ../dashboard.php");
            exit;
        } else {
            $hata = "Hatalı kullanıcı adı veya şifre!";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Giriş Yap</h4>
            </div>
            <div class="card-body">
                <?php if($hata): ?>
                    <div class="alert alert-danger"><?php echo $hata; ?></div>
                <?php endif; ?>
                
                <?php if(isset($_GET['basarili'])): ?>
                    <div class="alert alert-success">Kayıt başarılı! Lütfen giriş yapın.</div>
                <?php endif; ?>
                
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label class="form-label">Kullanıcı Adı</label>
                        <input type="text" name="kullanici_adi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Şifre</label>
                        <input type="password" name="sifre" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Giriş Yap</button>
                </form>
                
                <div class="mt-3 text-center">
                    <p>Hesabınız yok mu? <a href="register.php">Kayıt Ol</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>