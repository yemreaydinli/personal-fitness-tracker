<?php
require_once 'config/database.php';
require_once 'includes/header.php';

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: auth/login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$hata = '';
$basari = '';

// Check if an ID was provided in the URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$log_id = $_GET['id'];

// Fetch the existing data to populate the form
$stmt = $pdo->prepare("SELECT * FROM antrenman_loglari WHERE id = ? AND kullanici_id = ?");
$stmt->execute([$log_id, $kullanici_id]);
$log = $stmt->fetch();

// If the log doesn't exist or doesn't belong to the user, redirect
if (!$log) {
    header("Location: dashboard.php");
    exit;
}

// Handle the Update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $antrenman_turu = trim($_POST['antrenman_turu']);
    $hareket_adi = trim($_POST['hareket_adi']);
    $agirlik = $_POST['agirlik_kg'];
    $tekrar = $_POST['tekrar_sayisi'];
    $tarih = $_POST['tarih'];

    if (empty($antrenman_turu) || empty($hareket_adi) || empty($agirlik) || empty($tekrar) || empty($tarih)) {
        $hata = "Lütfen tüm alanları doldurun.";
    } else {
        // Update operation
        $update_stmt = $pdo->prepare("UPDATE antrenman_loglari SET antrenman_turu = ?, hareket_adi = ?, agirlik_kg = ?, tekrar_sayisi = ?, tarih = ? WHERE id = ? AND kullanici_id = ?");
        
        if ($update_stmt->execute([$antrenman_turu, $hareket_adi, $agirlik, $tekrar, $tarih, $log_id, $kullanici_id])) {
            $basari = "Kayıt başarıyla güncellendi! <a href='dashboard.php'>Dashboard'a dön</a>";
            // Update the local array so the form shows the new values immediately
            $log['antrenman_turu'] = $antrenman_turu;
            $log['hareket_adi'] = $hareket_adi;
            $log['agirlik_kg'] = $agirlik;
            $log['tekrar_sayisi'] = $tekrar;
            $log['tarih'] = $tarih;
        } else {
            $hata = "Güncelleme sırasında bir hata oluştu.";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Kaydı Düzenle</h4>
                <a href="dashboard.php" class="btn btn-sm btn-dark">İptal / Geri Dön</a>
            </div>
            <div class="card-body">
                <?php if($hata): ?>
                    <div class="alert alert-danger"><?php echo $hata; ?></div>
                <?php endif; ?>
                
                <?php if($basari): ?>
                    <div class="alert alert-success"><?php echo $basari; ?></div>
                <?php endif; ?>

                <form method="POST" action="update.php?id=<?php echo $log_id; ?>">
                    <div class="mb-3">
                        <label class="form-label">Antrenman Günü / Türü</label>
                        <input type="text" name="antrenman_turu" class="form-control" value="<?php echo htmlspecialchars($log['antrenman_turu']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hareket Adı</label>
                        <input type="text" name="hareket_adi" class="form-control" value="<?php echo htmlspecialchars($log['hareket_adi']); ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ağırlık (KG)</label>
                            <input type="number" step="0.5" name="agirlik_kg" class="form-control" value="<?php echo $log['agirlik_kg']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tekrar Sayısı</label>
                            <input type="number" name="tekrar_sayisi" class="form-control" value="<?php echo $log['tekrar_sayisi']; ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tarih</label>
                        <input type="date" name="tarih" class="form-control" value="<?php echo $log['tarih']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Değişiklikleri Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>