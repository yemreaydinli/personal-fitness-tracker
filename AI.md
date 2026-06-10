# AI.md

Bu dosya, Antrenman Takip Sistemi projesinin geliştirilmesi sırasında yapay zeka araçlarından alınan destekleri ve yapılan sohbetleri içermektedir.

---

# Sohbet 1 - Veritabanı Bağlantısı

## Kullanıcı

Web tabanlı bir antrenman takip sistemi geliştiriyorum. PHP PDO kullanarak MySQL veritabanına bağlanmam gerekiyor. Veritabanımın adı `wtp_proje`, kullanıcı adı `root` ve şifre kısmı boş. Bağlantı sırasında hata oluşursa bunu da yakalamak istiyorum. Nasıl bir `database.php` dosyası hazırlayabilirim?

## Yapay Zeka

PDO kullanarak bağlantı kurabilir ve `try-catch` yapısıyla hataları yakalayabilirsin.

```php
<?php
$host = 'localhost';
$dbname = 'wtp_proje';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>
```

Bu yapı bağlantı hatalarının kontrol edilmesini sağlar ve PDO'nun güvenli özelliklerinden yararlanır.

---

# Sohbet 2 - Login Sonrası Yönlendirme Sorunu

## Kullanıcı

Projeyi üniversitenin sunucusuna yükledim. Giriş yaptıktan sonra bazen yönlendirmeler düzgün çalışmıyor. Ayrıca bazı sayfalarda oturum bilgileri kayboluyor. Bunun nedeni ne olabilir?

## Yapay Zeka

Bu sorun genellikle alt dizinlerde çalışan projelerde yanlış yönlendirme yapılmasından kaynaklanır. Eğer projeniz kullanıcı dizini altında çalışıyorsa yönlendirmelerde tam yolu kullanmanız gerekir.

Örneğin:

```php
header("Location: /~st24360859015/dashboard.php");
```

veya

```php
header("Location: /~st24360859015/auth/login.php");
```

Ayrıca her sayfanın başında aşağıdaki kodun bulunması gerekir:

```php
session_start();
```

Çıkış işlemi sırasında ise:

```php
session_start();

$_SESSION = array();

session_destroy();

header("Location: /~st24360859015/auth/login.php");
exit;
```

şeklinde kullanılabilir.

---

# Sohbet 3 - Kullanıcıların Başka Kayıtları Görmesi

## Kullanıcı

Dashboard ve güncelleme sayfalarında giriş kontrolü yapıyorum. Ancak URL'deki id değerini değiştirince başka kullanıcılara ait kayıtların görüntülenebildiğini fark ettim. Bunu nasıl engelleyebilirim?

## Yapay Zeka

Sorgularda sadece kayıt ID'sini kontrol etmek yeterli değildir. Kullanıcının oturumdaki ID bilgisi de sorguya dahil edilmelidir.

Kayıtları listelerken:

```sql
SELECT *
FROM antrenman_loglari
WHERE kullanici_id = ?
ORDER BY tarih DESC
```

Güncelleme işlemlerinde:

```sql
UPDATE antrenman_loglari
SET ...
WHERE id = ? AND kullanici_id = ?
```

Silme işlemlerinde:

```sql
DELETE FROM antrenman_loglari
WHERE id = ? AND kullanici_id = ?
```

Yeni kayıt eklerken ise kullanıcı ID'si formdan alınmamalı, oturum bilgisinden alınmalıdır:

```php
$kullanici_id = $_SESSION['kullanici_id'];
```

Bu sayede kullanıcılar yalnızca kendi verilerine erişebilir.

---
