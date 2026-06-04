<?php
require_once 'config/database.php';
require_once 'includes/header.php';

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: auth/login.php");
    exit;
}

$hata = '';
$basari = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $antrenman_turu = trim($_POST['antrenman_turu']);
    $hareket_adi = trim($_POST['hareket_adi']);
    $agirlik = $_POST['agirlik_kg'];
    $tekrar = $_POST['tekrar_sayisi'] ?? '';
    $tarih = $_POST['tarih'];
    $kullanici_id = $_SESSION['kullanici_id'];

    if (empty($antrenman_turu) || empty($hareket_adi) || empty($agirlik) || empty($tekrar) || empty($tarih)) {
        $hata = "Lütfen tüm alanları doldurun.";
    } else {
        // Insert data into the database (Create operation)
        $stmt = $pdo->prepare("INSERT INTO antrenman_loglari (kullanici_id, antrenman_turu, hareket_adi, agirlik_kg, tekrar_sayisi, tarih) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$kullanici_id, $antrenman_turu, $hareket_adi, $agirlik, $tekrar, $tarih])) {
            $basari = "Antrenman başarıyla eklendi! <a href='dashboard.php'>Dashboard'a dön</a>";
        } else {
            $hata = "Kayıt eklenirken bir hata oluştu.";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Yeni Antrenman Ekle</h4>
                <a href="dashboard.php" class="btn btn-sm btn-light">Geri Dön</a>
            </div>
            <div class="card-body">
                <?php if($hata): ?>
                    <div class="alert alert-danger"><?php echo $hata; ?></div>
                <?php endif; ?>
                
                <?php if($basari): ?>
                    <div class="alert alert-success"><?php echo $basari; ?></div>
                <?php endif; ?>

                <form method="POST" action="create.php">
                    <div class="mb-3">
                        <label class="form-label">Antrenman Günü / Türü</label>
                        <input type="text" name="antrenman_turu" class="form-control" placeholder="Örn: Push 1, Upper, Fullbody" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hareket Adı</label>
                        <input type="text" name="hareket_adi" class="form-control" placeholder="Örn: Bench Press, Hack Squat" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ağırlık (KG)</label>
                            <input type="number" step="0.5" min="0" name="agirlik_kg" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tekrar Sayısı</label>
                            <input type="number" step="0.5" min="0" name="tekrar_sayisi" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tarih</label>
                        <input type="date" name="tarih" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Logu Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>