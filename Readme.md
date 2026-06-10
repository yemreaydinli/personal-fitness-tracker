# Kişisel Antrenman ve Ağırlık Takip Sistemi (WTP Proje 2)

Bu proje, kullanıcıların kendi egzersiz rutinlerini (Push/Pull/Legs, Upper/Lower vb.) ve kaldırdıkları ağırlıkları gün gün takip edebilmelerini sağlayan PHP ve MySQL tabanlı bir web uygulamasıdır. 

Uygulama, framework kullanılmadan saf (yalın) PHP ile geliştirilmiştir.

## 🚀 Canlı Demo
Uygulamayı canlı sunucu üzerinde anlık olarak test etmek için aşağıdaki bağlantıyı kullanabilirsiniz:
👉 [http://95.130.171.20/~st24360859015](http://95.130.171.20/~st24360859015)

## Özellikler
* **Güvenli Kimlik Doğrulama:** Şifreli kullanıcı kaydı (`password_hash`) ve güvenli giriş/çıkış işlemleri (Session yönetimi ve yetkisiz erişim bouncer koruması).
* **Create (Oluşturma):** Esnek antrenman günleri, hareket adları, ağırlık, set ve tekrar sayıları içeren yeni log ekleme.
* **Read (Okuma):** Geçmiş antrenman verilerini SQL veritabanından çekerek tablo halinde listeleme.
* **Update (Güncelleme):** Girilen antrenman loglarını ve set/tekrar sayılarını sonradan düzenleyebilme.
* **Delete (Silme):** Hatalı girilen logları sistemden tamamen kaldırma.
* **Arayüz:** Bootstrap 5 kullanılarak tamamen mobil uyumlu (responsive) ve modern bir tasarım (Sticky footer dahil).

## Ekran Görüntüleri

### 1. Dashboard Ekranı
<img src="https://github.com/user-attachments/assets/6805a5c9-98df-4981-a9de-35f32f2fe332" alt="Dashboard Ekranı" width="100%" />

### 2. Giriş ve Kayıt Ekranı
<img src="https://github.com/user-attachments/assets/c5a2a9e2-d9ae-4c8c-bffd-6cc16df68af8" alt="Giriş Ekleme Ekranı" width="100%" />

## Tanıtım Videosu
Projenin canlı sunucudaki işleyişini (kayıt olma, giriş yapma ve tüm CRUD işlemlerini) anlatan tanıtım videosunu aşağıdan izleyebilirsiniz:
🎥 [Proje Tanıtım Videosunu İzlemek İçin Tıklayın](https://youtu.be/vrl6wkmT0hU)

## Kurulum ve Kullanım (Lokal Ortam İçin)
1. Bu repoyu bilgisayarınıza klonlayın.
2. XAMPP/WAMP sunucunuzu başlatın ve dosyaları `htdocs` veya `www` dizinine alın.
3. phpMyAdmin üzerinden `dbstorage24360859015` adında bir veritabanı oluşturun.
4. Gerekli `kullanicilar` ve `antrenman_loglari` tablolarını oluşturmak için SQL sorgularını çalıştırın.
5. `config/database.php` içerisindeki veritabanı ayarlarını kendi sunucu ve kullanıcı bilgilerinize göre düzenleyin.
