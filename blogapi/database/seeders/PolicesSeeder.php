<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class PolicesSeeder extends Seeder
{
    public function run(): void
    {
        PrivacyPolicy::create([
            'type' => 'kvkk',
                'name' => '6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVKK”) uyarınca, 
                kişisel verilerinizin güvenliği bizim için büyük önem taşımaktadır. Bu kapsamda, 
                blog sitemizi ziyaret ettiğinizde sizden alınan kişisel veriler; yalnızca hizmetlerimizi 
                sunmak, kullanıcı deneyimini iyileştirmek, teknik destek sağlamak, taleplerinizi karşılamak 
                ve yasal yükümlülükleri yerine getirmek amacıyla toplanmakta ve işlenmektedir. Sitemiz 
                üzerinden adınız, e-posta adresiniz, IP bilginiz, yorum içerikleriniz gibi veriler formlar 
                aracılığıyla veya site üzerindeki gezinme süreniz boyunca elde edilebilir. Bu veriler 
                sadece gerekli olduğu sürece ve KVKK’da öngörülen şekillerde saklanmakta, herhangi bir 
                üçüncü kişi veya kurumla izniniz olmadan paylaşılmamaktadır. Ancak, yasal yükümlülükler 
                veya resmi mercilerce talep edilmesi durumunda sınırlı ve gerekli ölçüde paylaşım 
                yapılabilir. Kişisel verileriniz işlenme amacı sona erdiğinde silinir, yok edilir ya da 
                anonim hale getirilir. KVKK’nın 11. maddesi kapsamında; kişisel verilerinizin işlenip 
                işlenmediğini öğrenme, eksik veya yanlış işlenmişse düzeltilmesini isteme, silinmesini 
                veya yok edilmesini talep etme, bu verilerin üçüncü kişilere aktarılıp aktarılmadığını 
                öğrenme ve gerektiğinde bu işleme itiraz etme hakkına sahipsiniz. Bu haklarınızı kullanmak 
                için bizimle iletişime geçebilirsiniz. Blog sitemizde yer alan bu aydınlatma metni, sizi 
                şeffaf bir şekilde bilgilendirmek ve kişisel verilerinizin güvenliğini sağlamak amacıyla 
                düzenlenmiştir.'
        ]);

        PrivacyPolicy::create([
            'type' => 'privacy_policy',
            'name' => 'Blog sitemizi ziyaret ettiğinizde, gizliliğinizin korunması en öncelikli 
            değerlerimizden biridir. Bu kapsamda, kullanıcılarımızdan toplanan bilgiler yalnızca yasal 
            çerçevede, açık ve anlaşılır amaçlarla kullanılmakta; hiçbir koşulda izinsiz şekilde 
            paylaşılmamakta ya da satılmamaktadır. Siteyi kullandığınız süre boyunca IP adresiniz, tarayıcı 
            türünüz, konum bilgileriniz gibi teknik veriler otomatik olarak, adınız, e-posta adresiniz gibi 
            kişisel bilgiler ise yalnızca sizin form aracılığıyla sağlamanız halinde toplanmaktadır. 
            Toplanan bu bilgiler; site performansını artırmak, içerikleri sizin ilgi alanlarınıza göre 
            uyarlamak, geri bildirimlerinizi değerlendirmek ve sizinle gerektiğinde iletişim kurmak amacıyla 
            işlenmektedir. Web sitemizde kullanıcı davranışlarını analiz edebilmek amacıyla çerez (cookie) 
            teknolojisi kullanılmakta olup, bu çerezler sayesinde siteye giriş yaptığınız cihaz ve tarayıcı hakkında 
            sınırlı bilgi elde edilir. Çerez kullanımıyla ilgili tercihinizi tarayıcınız üzerinden değiştirmeniz 
            mümkündür. Tüm bilgileriniz güvenli sunucularda ve gerekli yazılım önlemleriyle korunmakta olup, 
            bilgi güvenliği konusunda uluslararası standartlara uygun hareket edilmektedir. Gizlilik politikamız, 
            kullanıcılarımıza daha güvenli, şeffaf ve dürüst bir hizmet sağlamak amacıyla hazırlanmış olup, 
            dilediğiniz zaman bu politikayı inceleyebilir ve sorularınız için bizimle iletişime geçebilirsiniz.'
        ]);
    }
}
