Sitelere Videolar Koyulmasını Sağlayan Eklentidir.
============

Version  : 0.3

Wordpress admin panelinde videolar adında bir bölüm açar.
Bu bölüme direk youtube linki yapıştırılır.
Iframe kodu yapıştırılmamalıdır.

İstenirse anayfa veya istenen bir sayfaya oklar yardımıyla çalışan bir bölüm ekler.
Aynı zamanda bileşen olarak da kullanılabilir.

Kısa kod kullanılarak Videolar sayfası bir sayfa içine iliştirilebilrir.
Sayfaya iliştirilen kısa kod videoları sırasıyla koyar.

0.1 versiyonunda sayfalama yoktur.


Algoritma
======================

Veritabanında wp_ms_videos adında bir tablo açar.
Admin panelden gelen youtube linklerini buraya kaydeder.
UI sayfasında kullanılacağı zaman bu tablonun tamamı dizi olarak çekilir ve foreach döngüsüne sokulur.
Eğer youtube linki varsa sayfaya video koymaya hazırdır.

İlk olarak admin panelden videoya ait bir resim yüklenmiş mi diye bakılır.
Yüklenmemişse youtube dan otomatik olarak resim çekilir.

İkinci olarak panelden bir başlık girilmiş mi diye bakılır.
Eklenmemişse Başlık youtube dan otomatik çekilir.

Sitenin yavaşlamamsı için video nun ilk görüntüsü Google plus sayfasında Youtube videoları gibi resim olarak görüntülenir.
Böylece tüm videoların yüklenmesini beklemeyerek sistem yorulmaz.

0.2
======================
İsteğe göre oklar veya slider altında bir liste görünümü eklenmesi sağlandı.
Gerekli CSS düzenlemerinde eksikler var.

0.3
======================
Icomoon sitesinden fontlar indirilildi ve entegre edildi.
Videolar carousel slider şeklinde sıralandığında sağ ve sol oklar font olarak yapıldı.

0.4
======================
Veritabanından kaynaklı bir hata giderildi.
Bu hata yüzünden site ilk açıldığında url girilecek alan bulunamıyordu.


