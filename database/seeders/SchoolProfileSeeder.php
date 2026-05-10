<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolProfile;

class SchoolProfileSeeder extends Seeder
{
    public function run(): void
    {
        SchoolProfile::create([
            'name' => 'MI Progresif Al-Huda Ketanon',
            'npsn' => '69894645',
            'accreditation' => 'Terakreditasi',
            'slogan' => 'MI PRO AL HUDA MANTAPP (Mandiri, Taqwa, Peduli dan Prestasi)',
            'logo' => 'logo.png', // Default di folder public
            
            'principal_message' => "Assalamu alaikum warahmatullahi wabarakatuh\n\nAlhamdulillah, segala puji dan syukur kita panjatkan ke hadirat Allah SWT yang telah melimpahkan nikmat kepada kita semua mulai dari nikmat sehat, iman dan kesempatan untuk dapat mengabdi di bidang pendidikan untuk mencerdaskan anak bangsa. Sholawat dan salam semoga tercurahkan kepada Baginda Nabi Besar Muhammad SAW yang syafaatnya kita nantikan besok di yaumil qiyamah.\n\nPendidikan adalah modal utama bagi suatu bangsa dalam upaya meningkatkan kualitas sumberdaya manusia yang dimilikinya. Sumberdaya manusia yang berkualitas akan mampu mengelola sumber daya alam untuk meningkatkan kesejahteraan masyarakat.\n\nMI Progresif Al Huda Ketanon sebagai salah satu lembaga pendidikan yang berada dibawah Kementerian Agama senantiasa berusaha mewujudkan apa yang menjadi harapan pemerintah dan masyarakat melalui serangkaian kegiatan dan program kerja yang berorientasi kepada peningkatan kualitas dan daya saing lulusan. Dalam rangka merealisasikan hal tersebut perlu dijalin kerjasama dan komunikasi yang baik antara pihak madrasah, masyarakat dan pemerintah. Website ini kami hadirkan dalam rangka untuk menjalin komunikasi dan mengawali kerjasama yang baik antara pihak Madrasah, siswa, wali murid, masyarakat dan Pemerintah.\n\nUcapan terimakasih yang sebanyak-banyaknya kami sampaikan kepada semua pihak yang telah berkontribusi terwujudnya Web ini. Kami juga menyadari akan keterbatasan kami sehingga semua kritik, saran dan masukan demi perkembangan web ini akan sangat berharga bagi kami. Akhirnya semoga situs Web ini dapat memberikan manfaat bagi siapa saja yang mengunjungi.\n\nWassalamu alaikum warahmatullahi wabarakatuh",
            'principal_photo' => 'kepsek.jpg', // Default di folder public
            'history' => "MI Progresif Al-Huda Ketanon merupakan lembaga pendidikan dasar berbasis Islam yang didirikan sebagai wujud kepedulian masyarakat terhadap pentingnya pendidikan yang mengintegrasikan ilmu pengetahuan umum dan nilai-nilai keislaman. Madrasah ini berada di bawah naungan Yayasan Al-Huda Ketanon.\nDidirikan pada tahun 2013, MI Progresif Al-Huda Ketanon awalnya memiliki jumlah siswa dan tenaga pendidik yang terbatas. Namun, berkat komitmen para pendiri, dukungan masyarakat, serta semangat untuk mencetak generasi yang berakhlakul karimah, madrasah ini terus berkembang dari waktu ke waktu.\nKonsep “Progresif” yang diusung menjadi ciri khas dalam proses pembelajaran, yaitu mengedepankan metode pendidikan yang aktif, kreatif, inovatif, dan menyenangkan, tanpa meninggalkan nilai-nilai keislaman. Seiring perkembangannya, MI Progresif Al-Huda Ketanon telah mengalami berbagai peningkatan baik dari segi sarana prasarana, kualitas tenaga pendidik, maupun prestasi siswa di berbagai bidang.\nHingga saat ini, MI Progresif Al-Huda Ketanon terus berupaya menjadi lembaga pendidikan yang unggul dalam prestasi, berkarakter islami, serta mampu menjawab tantangan zaman.",
            'vision' => "Terwujudnya generasi islami, hebat, bermatabat, cerdas, berakhlakul Karimah, mandiri, dan berprestasi.",
            'mission' => "1. Mewujudkan generasi Islam berakhlakul karimah\n2. Menciptakan lulusan madrasah yang hebat dan bermartabat\n3. Menciptakan siswa-siswi lulusan mi berkreasi Polda getaran yang mandiri dan berprestasi\n4. Mewujudkan generasi penerus bangsa yang kompetitif dan berdaya saing unggul",
            'goals' => "🎯 Tujuan\n1. Membentuk generasi Islami yang berakhlakul karimah dalam kehidupan sehari-hari.\n2. Menghasilkan lulusan yang hebat, bermartabat, dan berkarakter.\n3. Mengembangkan kecerdasan intelektual, spiritual, dan sosial peserta didik.\n4. Menumbuhkan sikap mandiri dan tanggung jawab pada siswa.\n5. Meningkatkan prestasi siswa baik akademik maupun non-akademik.\n6. Mempersiapkan generasi penerus bangsa yang kompetitif dan unggul.\n\n🎯 Sasaran\n1. Terwujudnya siswa yang memiliki akhlak mulia dan berperilaku islami.\n2. Terwujudnya lulusan yang cerdas, mandiri, dan berprestasi.\n3. Meningkatnya hasil belajar siswa di berbagai bidang.\n4. Meningkatnya partisipasi siswa dalam kegiatan lomba dan kompetisi.\n5. Terbentuknya sikap percaya diri dan daya saing siswa.\n6. Terwujudnya lingkungan madrasah yang mendukung pembelajaran islami dan berkarakter.",
            
            'address' => "Jl.Pahlawan GG.IX, Dusun Ketanon, Desa Ketanon, Kecamatan Kedungwaru, Kabupaten Tulungagung",
            'phone' => "-",
            'whatsapp' => "0856-4959-4876 (Pak Zain) / 0857-0016-1194 (Bu Sapna)",
            'email' => "miprogresifalhudaketanon@gmail.com",
            'maps_link' => "https://maps.app.goo.gl/2dCjHT3hfUscrTQD6?g_st=aw",
            
            'instagram' => "https://www.instagram.com/mialhudaketanon?igsh=MWNyeDBwMmQzbGludQ==",
            'facebook' => "https://www.facebook.com/mi.progresif.al.huda.2025",
            'youtube' => "https://www.youtube.com/@miprogresifalhudaketanon8109",
            'tiktok' => "https://www.tiktok.com/@miproalhudaketanon?_r=1&_t=ZS-967aUEStUut",
        ]);
    }
}
