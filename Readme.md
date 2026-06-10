# Kişisel Antrenman ve Ağırlık Takip Sistemi (WTP Proje 2)

Bu proje, kullanıcıların kendi egzersiz rutinlerini (Push/Pull/Legs, Upper/Lower vb.) ve kaldırdıkları ağırlıkları gün gün takip edebilmelerini sağlayan PHP ve MySQL tabanlı bir web uygulamasıdır. 

Uygulama, framework kullanılmadan saf (yalın) PHP ile geliştirilmiştir.

## Özellikler
* **Güvenli Kimlik Doğrulama:** Şifreli kullanıcı kaydı (`password_hash`) ve güvenli giriş/çıkış işlemleri (Session yönetimi).
* **Create (Oluşturma):** Esnek antrenman günleri ve hareketleri için log ekleme.
* **Read (Okuma):** Geçmiş antrenman verilerini SQL veritabanından çekerek tablo halinde listeleme.
* **Update (Güncelleme):** Girilen antrenman loglarını sonradan düzenleyebilme.
* **Delete (Silme):** Hatalı girilen logları sistemden kaldırma.
* **Arayüz:** Bootstrap 5 kullanılarak tamamen mobil uyumlu (responsive) ve modern bir tasarım (Sticky footer dahil).

## Ekran Görüntüleri
*(Buraya uygulamanızın çalıştığını gösteren en az 2 adet ekran görüntüsü ekleyin)*

![Dashboard Ekranı](https://github.com/user-attachments/assets/6805a5c9-98df-4981-a9de-35f32f2fe332)

![Giriş Ekleme Ekranı](https://github.com/user-attachments/assets/c5a2a9e2-d9ae-4c8c-bffd-6cc16df68af8)

## Tanıtım Videosu
Projenin nasıl çalıştığını (kayıt olma, giriş yapma ve CRUD işlemleri) anlatan 1-3 dakikalık videoyu aşağıdan izleyebilirsiniz:
[Proje Tanıtım Videosunu İzlemek İçin Tıklayın](https://youtu.be/vrl6wkmT0hU)

## Kurulum ve Kullanım (Lokal Ortam İçin)
1. Bu repoyu bilgisayarınıza klonlayın.
2. XAMPP/WAMP sunucunuzu başlatın ve dosyaları `htdocs` veya `www` dizinine alın.
3. phpMyAdmin üzerinden `wtp_proje` adında bir veritabanı oluşturun.
4. Gerekli `kullanicilar` ve `antrenman_loglari` tablolarını oluşturmak için SQL sorgularını çalıştırın.
5. `config/database.php` içerisindeki veritabanı ayarlarını kendi sunucunuza göre düzenleyin.
