<?php
require_once 'config/database.php';
require_once 'includes/header.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: auth/login.php");
    exit;
}

$kullanici_id = $_SESSION['kullanici_id'];
$mesaj = '';

// Delete Operation (Delete logic)
if (isset($_GET['sil_id'])) {
    $sil_id = $_GET['sil_id'];
    $sil_stmt = $pdo->prepare("DELETE FROM antrenman_loglari WHERE id = ? AND kullanici_id = ?");
    if ($sil_stmt->execute([$sil_id, $kullanici_id])) {
        $mesaj = "<div class='alert alert-success'>Log başarıyla silindi.</div>";
    }
}

// Fetch Workout Logs (Read logic)
$stmt = $pdo->prepare("SELECT * FROM antrenman_loglari WHERE kullanici_id = ? ORDER BY tarih DESC");
$stmt->execute([$kullanici_id]);
$loglar = $stmt->fetchAll();
?>

<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="mb-0">Antrenman Günlüğüm</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="create.php" class="btn btn-success fw-bold">+ Yeni Antrenman Ekle</a>
    </div>
</div>

<?php echo $mesaj; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <?php if (count($loglar) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Tarih</th>
                            <th>Gün / Tür</th>
                            <th>Hareket Adı</th>
                            <th>Ağırlık (KG)</th>
                            <th>Tekrar</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($loglar as $log): ?>
                            <tr>
                                <td><?php echo date('d.m.Y', strtotime($log['tarih'])); ?></td>
                                <td><span class="badge bg-primary"><?php echo htmlspecialchars($log['antrenman_turu']); ?></span></td>
                                <td><?php echo htmlspecialchars($log['hareket_adi']); ?></td>
                                <td><strong><?php echo $log['agirlik_kg']; ?></strong></td>
                                <td><?php echo $log['tekrar_sayisi']; ?></td>
                                <td>
                                    <a href="update.php?id=<?php echo $log['id']; ?>" class="btn btn-sm btn-warning">Düzenle</a>
                                    <a href="dashboard.php?sil_id=<?php echo $log['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bu kaydı silmek istediğinize emin misiniz?');">Sil</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info mb-0">
                Henüz hiç antrenman logu girmediniz. Yukarıdaki butondan ilk kaydınızı ekleyebilirsiniz.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>