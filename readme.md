# Woocommerce SanalPosPRO Ödeme Modülü Entegrasyonu

Woocommerce, e-ticaret siteleri için popüler bir açık kaynaklı platformdur. SanalPosPRO ödeme modülü ile müşterilerinize güvenli ödeme seçenekleri sunabilirsiniz. Aşağıda, SanalPosPRO modül kurulum sürecini adım adım anlatan bir kılavuz bulunmaktadır.

## EKLENTİ YÜKLEME

### WordPress Marketplace Üzerinden Kurulum (Önerilen Yöntem)

1. WordPress yönetici panelinize giriş yapın.
2. Sol menüden **Eklentiler > Yeni eklenti ekle** sekmesine tıklayın.
3. "Eklenti Ara" kutusuna "SanalPosPRO" yazın.
4. Arama sonuçlarında SanalPosPRO eklentisini bulun ve **Şimdi Kur** butonuna tıklayın.
5. Kurulum tamamlandıktan sonra **Etkinleştir** butonuna tıklayın.

![WordPress Marketplace kurulum](https://cdn.paythor.com/1/103/installation/marketplace.png)

### Manuel Kurulum (Alternatif Yöntem)

Eğer WordPress Marketplace üzerinden kurulum yapamıyorsanız, aşağıdaki manuel kurulum yöntemini kullanabilirsiniz:

1. [Releases](https://github.com/eticsoft/SanalPosPRO-woocommerce-module/releases) sayfasına giderek en son sürümü seçin ardından SanalPosPRO.zip adlı dosyayı indirebilirsiniz.

![Woocommerce eklenti indirme](https://cdn.paythor.com/1/103/installation/3.png) 

2. Woocommerce yönetici panelinize giriş yapın.
3. Sol menüden **Eklentiler > Yeni eklenti ekle** sekmesine tıklayın.
4. Sayfanın üst bölümünde bulunan **Şimdi Kur** butonuna tıklayın.
5. Açılan pencerede, bilgisayarınıza indirdiğiniz SanalPosPRO Modülü ZIP dosyanızı seçin ve yüklemenin tamamlanmasını bekleyin. 
6. Tamamlandıktan sonra **Eklentiyi Etkinleştir** butonuna tıklayın.

![Woocommerce kurulum adım 1](https://cdn.paythor.com/1/103/installation/1.png)

### FTP Üzerinden Kurulum (Ek Yöntem)

Eğer yukarıdaki yöntemlerle kurulum yapamıyorsanız, FTP üzerinden kurulum yapabilirsiniz:

1. FileZilla veya benzeri bir FTP istemcisi kullanarak sunucunuza bağlanın.
2. `plugins` dizinine gidin (`/var/www/html/wp-content/plugins` veya `/public_html/wp-content/plugins`).
3. ZIP dosyanızı bilgisayarınıza çıkarın.
4. Çıkarılan `SanalPosPRO` klasörünü `plugins` dizinine yükleyin.

![FTP kurulum görseli](https://cdn.paythor.com/1/103/installation/2.png)

5. Yönetici paneline giriş yaparak sol menüden **Eklentiler > Kurulu eklentiler** sekmesine tıklayın.
6. SanalPosPRO modülünü listeden bulun ve **Etkinleştir** butonuna tıklayın.

## AYARLARIN YAPILANDIRILMASI

1. Yönetici panelinden **Woocommerce > Ayarlar** sekmesine gidin.
2. Açılan sayfada **Ödemeler** butonuna tıklayın
3. SanalPosPRO modülünün yanındaki **Kurulumu tamamla** veya **Yönet** butonuna tıklayın.

![Ayarların Yapılandırılması](https://cdn.paythor.com/1/103/installation/pluginconfig.png)

4. **SanalPosPRO ödeme yöntemini etkinleştir/devre dışı bırak** seçeneğinin seçili olduğundan emin olun. Seçili değilse seçtikten sonra **Değişiklikleri Kaydet** butonuna tıklayın.
5. **SanalPosPRO Paneline Erişmek İçin Tıklayınız** butonuna tıklayarak yapılandırma ayarları sayfasına yönlendirilebilirsiniz. Alternatif olarak, WordPress yönetici panelinde sol menüdeki **WooCommerce > SanalPosPRO** menüsüne tıklayarak da aynı sayfaya ulaşabilirsiniz.

![Ayarların Yapılandırılması 2](https://cdn.paythor.com/1/103/installation/pluginconfig2.png)

![SanalPosPRO Erişim Butonu](https://cdn.paythor.com/1/103/installation/accessbutton.png)

6. Modülü kullanabilmek için açılan modül arayüzünde Kayıt Olun butonuna tıklayın ve gerekli bilgileri girerek hesap oluşturun.

![Giriş Ekranı](https://cdn.paythor.com/1/confsteps/login.png)

![Kayıt Ekranı](https://cdn.paythor.com/1/confsteps/register.png)

7. Oluşturduğunuz kullanıcı bilgileri girerek giriş yap butonuna tıklayın.
8. E-posta adresinize gelen doğrulama kodunu giriniz.
9. Doğrula butonuna basınız.

![Doğrulama Ekranı](https://cdn.paythor.com/1/confsteps/verification.png)

10. Açılan arayüzden Ödeme Yöntemi sekmesine tıklayın.
11. Kullanmak istediğiniz ödeme kuruluşu veya bankayı seçip **installable** butonuna tıklayınız ardından ödeme kuruluşu veya bankanız tarafından sizlere iletilen bilgileri girin.

![Ödeme Yöntemi Ayarları](https://cdn.paythor.com/1/confsteps/gateway.png)

12. Yapılandırmaları girdikten sonra **install** butonuna basın.

![Ödeme Yöntemi Yapılandırmaları](https://cdn.paythor.com/1/confsteps/gatewayconfig.png)

Test siparişi oluşturarak SanalPosPRO ödeme işleminin sorunsuz çalıştığını doğrulayın.

## TEST AŞAMASI

1. Ödeme Yöntemi (GATEWAY) butonuna tıklayın.
2. Test Modu başlığının altında yer alan seçilebilir alanı Test Modu olarak seçin ve Kaydet butonuna tıklayın.
3. Sepetinize bir ürün ekleyin ve ödeme adımında SanalPosPRO ile Öde seçeneğini seçin.
4. Açılan Pop-up ödeme sayfası üzerinde test kart bilgilerini giriş yapın ve ödemeyi tamamlayın.

![Ödeme Ekranı](https://cdn.paythor.com/1/confsteps/paymentpage.png)

Bu işlemlerden sonra problem yaşanır ise **DESTEK** (**SUPPORT**) butonuna tıklayarak destek ekibi ile iletişime geçebilirsiniz.
