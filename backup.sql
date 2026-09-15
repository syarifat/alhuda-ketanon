CREATE DATABASE IF NOT EXISTS `alhuda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `alhuda`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `views` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `thumbnail`, `is_published`, `views`, `created_at`, `updated_at`) VALUES
(9, 'SELAMAT DAN SUKSES PERAIH NILAI TERBAIK TKA MI PROGRESIF AL-HUDA KETANON', 'selamat-dan-sukses-peraih-nilai-terbaik-tka-mi-progresif-al-huda-ketanon-ufxIE', '<p>Selamat kepada 5 siswa siswi MI Progresif Al-Huda Ketanon yang meraih nilai terbaik TKA (Tes Kemampuan Akademik) Tahun Ajaran 2025/2026. 5 siswa siswi MI Progresif Al-Huda Ketanon atas nama :</p>\r\n\r\n<p>1. Titis Wahyu Widayati&nbsp;</p>\r\n\r\n<p>- Bahasa Indonesia&nbsp; (83,33)</p>\r\n\r\n<p>- Matematika (70)</p>\r\n\r\n<p>2. Fatihatun Naytunis</p>\r\n\r\n<p>-Bahasa Indonesia (83,33)&nbsp;</p>\r\n\r\n<p>3. Ahmad Arief Rifa&#39;i</p>\r\n\r\n<p>- Bahasa Indonesia (80)</p>\r\n\r\n<p>4. Felisha Derry B.P</p>\r\n\r\n<p>- Bahasa Indonesia (76,67)</p>\r\n\r\n<p>5. M. Ar Rayyan Ellang S.</p>\r\n\r\n<p>- Bahasa Indonesia (76,67)</p>\r\n\r\n<p>Semoga dengan hasil yang diterima tetap menjadi semangat untuk terus belajar. Dan tak lupa untuk seluruh siswa siswi kela 6 Kami ucapkan semangat untuk terus belajar meraih cita cita di masa depan. Perjalanan kalian tidak berhenti disini tapi masih banyak proses yang kalian harus lalui. Semangat dan terus berjuang meraih mimpi kalian anak anak MI Progresif Al-Huda Ketanon.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>MI PROGRESIF AL-HUDA KETANON</p>\r\n\r\n<p><strong>MANTAPP</strong></p>\r\n\r\n<p><em>(MANDIRI,TAQWA,PEDULI DAN PRESTASI)</em></p>', 'articles/G3XAUuM7qYTpFmsYvfN9A3vxLlavUwaozhKgiijk.jpg', 1, 121, '2026-05-29 21:21:57', '2026-09-02 16:56:03'),
(10, 'ASSESSMENT SUMATIF AKHIR SEMESTER GENAP MI PROGRESIF AL-HUDA KETANON', 'assessment-sumatif-akhir-semester-genap-mi-progresif-al-huda-ketanon-uZmdW', '<p><strong>Assessment Sumatif Akhir Semester Genap Berjalan Sukses di MI Progresif Al-Huda Ketanon</strong></p>\r\n\r\n<p>MI PROGRESIF AL-HUDA KETANON &ndash; Sebagai bentuk evaluasi pembelajaran akhir semester genap, MI Progresif Al-Huda Ketanon melaksanakan Assessment Sumatif yang berlangsung secara rutin dan terstruktur. Kegiatan ini menjadi momen penting bagi para siswa dan siswi untuk mengevaluasi kemajuan belajar selama semester genap 2025/2026.</p>\r\n\r\n<p>Assessment Sumatif ini dilaksanakan secara mandiri oleh para siswa, dengan bimbingan guru-guru yang berkompeten. Kegiatan ini tidak hanya menguji pemahaman akademik, tetapi juga melatih kemandirian dan tanggung jawab dalam menyelesaikan tugas belajar. Selain itu, Assessment Sumatif juga menjadi sarana untuk mengukur kemampuan berpikir kritis dan kreatif para siswa.</p>\r\n\r\n<p>Dalam pelaksanaannya, para siswa menunjat belajar yang tinggi. Mereka dengan tekun menyelesaikan soal-soal yang diberikan, baik dalam bentuk ujian tertulis maupun proyek kreatif. Guru-guru juga memberikan bimbingan dan dorongan moral agar para siswa tetap fokus dan percaya diri dalam menghadapi ujian.</p>\r\n\r\n<p><em>Kepala MI Progresif Al-Huda Ketanon, Bapak Ahmad Zainuri,S.Pd.I</em> , menyampaikan bahwa Assessment Sumatif ini merupakan bagian dari upaya sekolah dalam meningkatkan kualitas pembelajaran. &quot;Kami berharap melalui Assessment Sumatif ini, para siswa dapat lebih memahami materi yang telah dipelajari dan siap menghadapi tantangan belajar di masa depan,&quot; ujarnya.</p>\r\n\r\n<p>Dengan berjalannya Assessment Sumatif yang sukses, MI Progresif Al-Huda Ketanon kembali menunjukkan komitmen dalam memberikan pendidikan yang berkualitas dan berbasis kurikulum yang relevan dengan kebutuhan masa kini.</p>\r\n\r\n<p><strong>MI PROGRESIF AL-HUDA KETANON MANTAPP<br />\r\n<em>&quot;MANDIRI,TAQWA, PEDULI DAN PRESTASI&quot;</em></strong></p>', 'articles/VHg9A7DnEmwb1ICtKKknqFgkSp8yqs7xWhuRrrju.jpg', 1, 91, '2026-06-01 19:08:19', '2026-09-02 16:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `image_path`, `description`, `created_at`, `updated_at`) VALUES
(8, 'PELAKSANAAN UJIAN MADRASAH', 'galleries/mzK6PFIQA3cKSIZSR6JltgyUpo59ImFOK7016xST.jpg', 'Pelaksanaan Ujian Madrasah (UM) MI Progresif Al-Huda Ketanon, yang dilaksanakan pada tanggal 4 - 11 Mei 2026, Ujian Madrasah diikuti oleh 13 peserta didik.', '2026-05-11 18:25:18', '2026-05-11 18:25:18'),
(9, 'PERPUSTAKAAN KELILING', 'galleries/yREDywhhgwAmhUi0dDjZmlnzbtdDgEhPx7aZ7TRG.jpg', NULL, '2026-07-22 00:03:54', '2026-07-22 00:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `contact`, `content`, `is_read`, `created_at`, `updated_at`) VALUES
(5, 'Davidrox', 'jxjad@qeokam.vtx ulnr 04hp', 'Hi! miproalhuda.sch.id, \r\nI noticed miproalhuda.sch.id while browsing websites. \r\nWe provide a platform that helps businesses connect with website owners through their contact pages. \r\nThis approach helps businesses reach websites in different niches. \r\nPricing for the service is kept straightforward and accessible. \r\nYou can explore the platform with a free test. \r\nFeel free to reach out if you would like to learn more. \r\n \r\nThanks and have a great day. \r\nContact us. \r\nTelegram - https://t.me/FeedbackFormEU \r\nWhatsApp - +375259112693 \r\nWhatsApp  https://wa.me/+375259112693', 1, '2026-05-27 16:36:58', '2026-05-29 21:11:23'),
(6, 'Davidrox', 'rsmjs@dlxamp.pui sjhu 63af', 'Good morning! miproalhuda.sch.id, \r\nWhile researching online I found miproalhuda.sch.id. \r\nOur service helps businesses share information with websites through their contact pages. \r\nOur system can send up to 50,000 messages. \r\nOur pricing structure is designed to remain transparent. \r\n  \r\nIf you would like to know more, just reply. \r\n \r\nThanks for taking a moment to read this. \r\nContact us. \r\nTelegram - https://t.me/FeedbackFormEU \r\nWhatsApp - +375259112693 \r\nWhatsApp  https://wa.me/+375259112693', 0, '2026-06-04 03:54:04', '2026-06-04 03:54:04'),
(7, 'Youssef Abdullah', 'gefov@pkscss.uig mskl 28lm', 'Seasons Greetings, \r\n \r\nWe are a Dubai-based business consulting and sourcing company with an extensive network of buyers, importers, distributors, and investors across the UAE and the Middle East. \r\n \r\nBased on the growing demand from our clients, we are seeking to establish business relationships with reputable manufacturers, traders, and distributors interested in expanding their products into the UAE market. \r\n \r\nThrough our network, we can introduce qualified buyers and business opportunities in sectors such as agriculture, manufacturing, construction, mining, oil and gas, consumer goods, and other industries. We conduct our business professionally and in full compliance with UAE laws and regulations. \r\n \r\nIf your company is interested in exploring cooperation opportunities, please send us your company profile, product e-catalog, and pricing information. We would be pleased to review your offerings and discuss potential business opportunities. \r\n \r\nContact me on this email address: yabdullah-agency@finvlimited.com \r\n \r\nKind regards, \r\nMr. Youssef Abdullah \r\nDubai Business Consultants', 0, '2026-06-09 11:21:00', '2026-06-09 11:21:00'),
(8, 'Olivier G Balzac', 'cphkr@gswvfg.tvc cnxv 47un', 'Good day, \r\n \r\nMy name is Olivier G Balzac. I previously sent you a letter regarding a transaction involving 13.5 million US dollars, which was left by my deceased client. As I have not received a response from you, I have chosen to reach out again through this platform. After reviewing your profile, I am firmly convinced that you are capable of managing this transaction alongside me very effectively. \r\n \r\nI would like to highlight that upon the successful completion of the transaction, 10% of the funds will be donated to charitable organizations, while the remaining 90% will be divided between us, resulting in an equal distribution of 45% each. \r\n \r\nPlease respond at your earliest convenience to obtain further details about the transaction. \r\n \r\nSincerely, \r\n \r\nOlivier G Balzac, \r\nAttorney. \r\nE-mail: info@balzacavocate.com \r\nWebsite: http://www.balzacavocate.com/', 0, '2026-06-10 14:58:00', '2026-06-10 14:58:00'),
(9, 'Daniel', 'cunbu@sohnjx.thh doaf 03sf', 'Hey \r\n \r\nI came across your business and wanted to reach out. \r\n \r\nWe\'re an email marketing agency that helps businesses generate new leads and sales through highly targeted email campaigns. We\'ve been doing this for over 7 years and currently work with more than 4,000 clients across a range of industries. \r\n \r\nWhat we\'ve found is that many businesses are leaving significant revenue on the table simply because they\'re not consistently reaching the right prospects with the right message. \r\n \r\nOur team handles the entire process—from identifying and targeting qualified audiences to campaign creation, delivery, and optimization—so you can focus on running your business. \r\n \r\nWe\'ve also been featured in Forbes and other major publications. \r\n \r\nIf you\'re open to exploring whether this could work for your business, I\'d be happy to schedule a quick 15-minute call. \r\n \r\nYou can read more about the approach here: \r\n \r\nhttps://www.digitalme.cc/full-managed-plan/ \r\n \r\nWould you be open to a brief conversation next week? \r\n \r\nBest, \r\n \r\nDaniel', 0, '2026-06-10 21:37:52', '2026-06-10 21:37:52'),
(10, 'Hugo L Mateo', 'onnkp@orcfot.web scgn 14aq', 'Dear Sirs/ma, \r\n \r\nTake advantage of our limited?time loan offer and gain vital access to a flexible repayment plan designed to fit your budget. \r\n \r\nWhy choose this offer: Discounted interest rate, Instant approval, No collateral required, and 100% online processing, Including a face to face table meeting for closing. \r\n \r\nThis offer is valid and made available to all sectors, lucrative and projects with high value of returns. \r\n \r\nTo proceed, kindly reply to this email with your confirmation. \r\n \r\nDon’t miss out on this opportunity to fund your plans with ease. \r\n \r\nSincerely, \r\n \r\nHugo L Mateo \r\n \r\nFinancial Broker Authority \r\nDohat Al-Adab Street, Al-Khuwair, \r\nLevel 43, Building 115, King Abdullah Financial. \r\nanwar@anwarcapitalllc.com \r\nW: +96875039067', 0, '2026-07-03 04:15:34', '2026-07-03 04:15:34'),
(11, 'Nik Georgios', 'iijmb@afnhds.tmc kwgv 76jg', 'Dear Sir/Madam, \r\nI hope this message finds you well. \r\n \r\nMy name is Nik Georgios, and I am a private investment consultant based in the United Kingdom. I work with private investors to identify experienced business owners and fund managers who have the capability to manage capital through viable businesses and investment opportunities. \r\n \r\nI am currently working with a private investor who is seeking qualified business owners and fund managers with the capacity to manage substantial investment capital. \r\n \r\nIf you are interested in exploring this opportunity, please reply to this email, and I will be pleased to provide you with further details and discuss the next steps. \r\n \r\nKindly send your reply to: nickgeorgio@mail.com \r\n \r\nI look forward to hearing from you. \r\n \r\nKind regards, \r\n \r\nNik Georgios', 0, '2026-07-06 19:00:18', '2026-07-06 19:00:18'),
(12, 'Davidrox', 'ckofp@rgbasr.qhb orao 52fa', 'Salutations! miproalhuda.sch.id, \r\nWhile browsing online I noticed miproalhuda.sch.id. \r\nWe also help businesses communicate with website owners through contact forms. \r\nThe platform supports scalable communication with websites. \r\nBusinesses can start using the platform with a modest budget. \r\nA free demo is available if you would like to evaluate the service. \r\nYou are welcome to contact us if this relevant for you. \r\n \r\nThanks for reading. \r\nContact us. \r\nTelegram - https://t.me/FeedbackFormEU \r\nWhatsApp - +375259112693 \r\nWhatsApp  https://wa.me/+375259112693 \r\nWe only use chat for communication.', 0, '2026-07-26 23:24:39', '2026-07-26 23:24:39'),
(13, 'Peter Randall', 'vurlj@ilexot.luw vfat 38ro', 'Hello, \r\n \r\nI hope this message finds you well. \r\n \r\nMy name is Peter Randall, and I represent the Marketing Department at SMG Capital Inc., a Canada-based investment firm specializing in helping businesses grow and expand through capital investments. \r\n \r\nWe support businesses with Flexible business financing, Growth capital \r\ninvestment and Custom financing solutions that align with all \r\nstrategic business goals. \r\n \r\nAs part of our ongoing global expansion we are currently looking for \r\nserious business owners outside Canada and United States who are currently \r\nexploring funding options for business expansion for access to fast \r\ncapital. \r\n \r\nIf you are interested, please feel free to reach out to me at: \r\npetrandall@smgcapinc.com \r\n \r\nBest Regards \r\nPeter Randall', 0, '2026-08-04 05:27:19', '2026-08-04 05:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_11_041407_create_articles_table', 2),
(5, '2026_04_11_041408_create_galleries_table', 2),
(6, '2026_04_11_041409_create_messages_table', 2),
(7, '2026_05_09_043523_create_school_profiles_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_profiles`
--

CREATE TABLE `school_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npsn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accreditation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slogan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `principal_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `vision` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `goals` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maps_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_profiles`
--

INSERT INTO `school_profiles` (`id`, `name`, `npsn`, `accreditation`, `slogan`, `logo`, `principal_message`, `principal_photo`, `history`, `vision`, `mission`, `goals`, `address`, `phone`, `whatsapp`, `email`, `maps_link`, `instagram`, `facebook`, `youtube`, `tiktok`, `created_at`, `updated_at`) VALUES
(1, 'MI Progresif Al-Huda Ketanon', '69894645', 'Terakreditasi', 'MI PRO AL HUDA MANTAPP (Mandiri, Taqwa, Peduli dan Prestasi)', 'profiles/jYgsHKFVblOqUJ9ldo7iiWotUffFxbtK6Jb4W8Sy.png', 'Assalamu alaikum warahmatullahi wabarakatuh\r\n\r\nAlhamdulillah, segala puji dan syukur kita panjatkan ke hadirat Allah SWT yang telah melimpahkan nikmat kepada kita semua mulai dari nikmat sehat, iman dan kesempatan untuk dapat mengabdi di bidang pendidikan untuk mencerdaskan anak bangsa. Sholawat dan salam semoga tercurahkan kepada Baginda Nabi Besar Muhammad SAW yang syafaatnya kita nantikan besok di yaumil qiyamah.\r\n\r\nPendidikan adalah modal utama bagi suatu bangsa dalam upaya meningkatkan kualitas sumberdaya manusia yang dimilikinya. Sumberdaya manusia yang berkualitas akan mampu mengelola sumber daya alam untuk meningkatkan kesejahteraan masyarakat.\r\n\r\nMI Progresif Al Huda Ketanon sebagai salah satu lembaga pendidikan yang berada dibawah Kementerian Agama senantiasa berusaha mewujudkan apa yang menjadi harapan pemerintah dan masyarakat melalui serangkaian kegiatan dan program kerja yang berorientasi kepada peningkatan kualitas dan daya saing lulusan. Dalam rangka merealisasikan hal tersebut perlu dijalin kerjasama dan komunikasi yang baik antara pihak madrasah, masyarakat dan pemerintah. Website ini kami hadirkan dalam rangka untuk menjalin komunikasi dan mengawali kerjasama yang baik antara pihak Madrasah, siswa, wali murid, masyarakat dan Pemerintah.\r\n\r\nUcapan terimakasih yang sebanyak-banyaknya kami sampaikan kepada semua pihak yang telah berkontribusi terwujudnya Web ini. Kami juga menyadari akan keterbatasan kami sehingga semua kritik, saran dan masukan demi perkembangan web ini akan sangat berharga bagi kami. Akhirnya semoga situs Web ini dapat memberikan manfaat bagi siapa saja yang mengunjungi.\r\n\r\nWassalamu alaikum warahmatullahi wabarakatuh', 'profiles/iPHTmeAf38SUgAZySnt296EQoj0C6ovQwz7WGrKI.jpg', 'MI Progresif Al-Huda Ketanon merupakan lembaga pendidikan dasar berbasis Islam yang didirikan sebagai wujud kepedulian masyarakat terhadap pentingnya pendidikan yang mengintegrasikan ilmu pengetahuan umum dan nilai-nilai keislaman. Madrasah ini berada di bawah naungan Yayasan Al-Huda Ketanon.\r\nDidirikan pada tahun 2013, MI Progresif Al-Huda Ketanon awalnya memiliki jumlah siswa dan tenaga pendidik yang terbatas. Namun, berkat komitmen para pendiri, dukungan masyarakat, serta semangat untuk mencetak generasi yang berakhlakul karimah, madrasah ini terus berkembang dari waktu ke waktu.\r\nKonsep “Progresif” yang diusung menjadi ciri khas dalam proses pembelajaran, yaitu mengedepankan metode pendidikan yang aktif, kreatif, inovatif, dan menyenangkan, tanpa meninggalkan nilai-nilai keislaman. Seiring perkembangannya, MI Progresif Al-Huda Ketanon telah mengalami berbagai peningkatan baik dari segi sarana prasarana, kualitas tenaga pendidik, maupun prestasi siswa di berbagai bidang.\r\nHingga saat ini, MI Progresif Al-Huda Ketanon terus berupaya menjadi lembaga pendidikan yang unggul dalam prestasi, berkarakter islami, serta mampu menjawab tantangan zaman.', 'Terwujudnya generasi islami, hebat, bermatabat, cerdas, berakhlakul Karimah, mandiri, dan berprestasi.', '1. Mewujudkan generasi Islam berakhlakul karimah\r\n2. Menciptakan lulusan madrasah yang hebat dan bermartabat\r\n3. Menciptakan siswa-siswi lulusan mi berkreasi Polda getaran yang mandiri dan berprestasi\r\n4. Mewujudkan generasi penerus bangsa yang kompetitif dan berdaya saing unggul', '🎯 Tujuan\r\n1. Membentuk generasi Islami yang berakhlakul karimah dalam kehidupan sehari-hari.\r\n2. Menghasilkan lulusan yang hebat, bermartabat, dan berkarakter.\r\n3. Mengembangkan kecerdasan intelektual, spiritual, dan sosial peserta didik.\r\n4. Menumbuhkan sikap mandiri dan tanggung jawab pada siswa.\r\n5. Meningkatkan prestasi siswa baik akademik maupun non-akademik.\r\n6. Mempersiapkan generasi penerus bangsa yang kompetitif dan unggul.\r\n\r\n🎯 Sasaran\r\n1. Terwujudnya siswa yang memiliki akhlak mulia dan berperilaku islami.\r\n2. Terwujudnya lulusan yang cerdas, mandiri, dan berprestasi.\r\n3. Meningkatnya hasil belajar siswa di berbagai bidang.\r\n4. Meningkatnya partisipasi siswa dalam kegiatan lomba dan kompetisi.\r\n5. Terbentuknya sikap percaya diri dan daya saing siswa.\r\n6. Terwujudnya lingkungan madrasah yang mendukung pembelajaran islami dan berkarakter.', 'Jl.Pahlawan GG.IX, Dusun Ketanon, Desa Ketanon, Kecamatan Kedungwaru, Kabupaten Tulungagung', '-', '0856-4959-4876 (Pak Zain) / 0857-0016-1194 (Bu Sapna)', 'miprogresifalhudaketanon@gmail.com', 'https://maps.app.goo.gl/2dCjHT3hfUscrTQD6?g_st=aw', 'https://www.instagram.com/mialhudaketanon?igsh=MWNyeDBwMmQzbGludQ==', 'https://www.facebook.com/mi.progresif.al.huda.2025', 'https://www.youtube.com/@miprogresifalhudaketanon8109', 'https://www.tiktok.com/@miproalhudaketanon?_r=1&_t=ZS-967aUEStUut', '2026-05-08 21:43:49', '2026-05-15 20:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0TLVRotlfKGnwCTqyU6HhSyKbbVXp92tyzj6o7eC', NULL, '127.0.0.1', 'Mozilla/5.0 (compatible; ForestEngine/1.0; +https://forestengine.net/)', 'eyJfdG9rZW4iOiJhN1Q0bkxOUWszckRnZktlQldJUndtZVFPckE3bEJmc0d2WkFxYjBUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788178592),
('0tzWhg8Ym6zHEs9MHPEr01f4QccSZ47fo0W6rBod', NULL, '127.0.0.1', 'curl/8.7.1', 'eyJfdG9rZW4iOiJzUkFwWUlBWVYxMTZHcXdQdHd2V3VSeFRzM0JFZ254dmF5VmIyQmtVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788109959),
('1166fJSkDecYKXGHVo8LWsXI9Yq9cwQ95s8IAYy2', NULL, '127.0.0.1', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'eyJfdG9rZW4iOiJzWERScEo2YzFIcDVQTUpOYkQyNjh3WUtqUmpLUWJ5VzE5VzZyMFA4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788169199),
('1MB3JINC4CQOf4QX0trvuzsEwXcrZNAPgs1BPOiV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJDZkdjd1lFWXpJQTFZQWNET1BBUzZYOFpyaVp2dkE1Yktzbkp2MDYzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788134440),
('3Bn4UnK2OiuMctS7FNktcG71HlHhwrjnR7W2r9OG', NULL, '127.0.0.1', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'eyJfdG9rZW4iOiJxNXlhSm5kbGNoRldiSHBQbWw3MzVrUlAxbFRvV2FnZndBOXg2OFZnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788178431),
('3xGTujK8QUFFp9diewJQamZAdLfG3PNIgIuKXUTr', NULL, '127.0.0.1', 'curl/8.7.1', 'eyJfdG9rZW4iOiJ2OWYxODExMVFpaUg2cTkzNkhIU3Y0Rlp3RGpFSkVzUDFBQnozMnBNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhXC9zZWxhbWF0LWRhbi1zdWtzZXMtcGVyYWloLW5pbGFpLXRlcmJhaWstdGthLW1pLXByb2dyZXNpZi1hbC1odWRhLWtldGFub24tdWZ4SUUiLCJyb3V0ZSI6ImFydGljbGUuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788109962),
('4n3FHvoUgXkhp2YOUYaullMHuKBM6wKzwXGha2s3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Viewer/99.9.8853.8', 'eyJfdG9rZW4iOiIwem9RODA5Um5KckQ3Z0tqTmxoSUJzNkI3S3NSaUVaTTExdUxKek45IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhXC9zZWxhbWF0LWRhbi1zdWtzZXMtcGVyYWloLW5pbGFpLXRlcmJhaWstdGthLW1pLXByb2dyZXNpZi1hbC1odWRhLWtldGFub24tdWZ4SUUiLCJyb3V0ZSI6ImFydGljbGUuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788152393),
('5tvS36exz2lV2oo1ftN8xnv2HnFRbLrb297loFlM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'eyJfdG9rZW4iOiJyWkxNcWhSM2t3N05Uc05aOFNHYmNlc3ZlVnhLSkVoRFBOVW5ING91IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788109270),
('9YDNeW12DXg0ZVTMGV4rLksUECT65i9slFLbDgkT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', 'eyJfdG9rZW4iOiJQbnU3N284VzVyaWJUSjJRZlFpN1o4WXJ6d3JMNndDNzBnUU40MlRxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvP3BhZ2U9Z3Jhdml0eXNtdHAtY29ubmVjdGlvbnMmcmVzdF9yb3V0ZT0lMkZncmF2aXR5c210cCUyRnYxJTJGdGVzdHMlMkZtb2NrLWRhdGEiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1788117905),
('dzvm8ktvFfBfP2OAEbvkUdFxGJ8Pj1P2OQP7TyBb', NULL, '127.0.0.1', 'python-requests/2.34.2', 'eyJfdG9rZW4iOiJPOHNuRXc0ekRYWUJDRmJBU3V6Z2lXWDU4QXdDZUREVTYwdkt6ck8yIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788115064),
('e4ZxgsWyDAxD9pLH3ey6FaqS6GnJoGidZn3bwna2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.3', 'eyJfdG9rZW4iOiJkY1RaeTRjNXVja3FjZ1M2ZnFhWkljV05mc3VMSGQ3OWVpeGF5RW83IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhXC9hc3Nlc3NtZW50LXN1bWF0aWYtYWtoaXItc2VtZXN0ZXItZ2VuYXAtbWktcHJvZ3Jlc2lmLWFsLWh1ZGEta2V0YW5vbi11Wm1kVyIsInJvdXRlIjoiYXJ0aWNsZS5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788393364),
('g54rgmkzaEM64slUDCy6kAyMm5lXbL2rqU0MnQFc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', 'eyJfdG9rZW4iOiJBSHVsYkE1SUNBYjFlNDVKS3FZUnpNUXI4OXhmYzI4RWR0dkUwVG0wIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788107898),
('G9d2VECGMEO8RnjUnfxC8lHIcqZAiCNlk3AnCe67', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJvWlZ0MGdQanYzMVdlVm5YY1oxS00wRTN6ck9UcHJTUjFvTFR6S3V6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvaW5kZXgucGhwP29wdGlvbj1jb21fc3BsbXMmdmlldz1jYXJ0Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788102940),
('KNlsD1eStKQo94TdhnRhzjbc04leRPNQ20rtve4w', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Safari/605.1.15', 'eyJfdG9rZW4iOiJaN1I5NFZaZEdnSkxmTExzYUJ1Y0ZVNnV1MzRDOW8zdU16c0xvOUdOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788182413),
('lFDHVkfmqT2NFmkdd6UzAqu4mdbVUwvcQh8LVsn9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Viewer/99.9.8853.8', 'eyJfdG9rZW4iOiJVdGdXZkVyQzVTTlNaTGFOSDh4QnFoUEdjcGNIcHBjTmMxYnpuV004IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhXC9hc3Nlc3NtZW50LXN1bWF0aWYtYWtoaXItc2VtZXN0ZXItZ2VuYXAtbWktcHJvZ3Jlc2lmLWFsLWh1ZGEta2V0YW5vbi11Wm1kVyIsInJvdXRlIjoiYXJ0aWNsZS5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788152394),
('liLkw2wW8Uz8BJjrbKzS4yVd2YYVjGYoB2bvT7C0', NULL, '127.0.0.1', 'curl/8.7.1', 'eyJfdG9rZW4iOiJZamhsMVQ4R096d2MzTWgwRkZGUDdoNEhBTmdJNDlyNmk4YnpoRVZtIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhXC9hc3Nlc3NtZW50LXN1bWF0aWYtYWtoaXItc2VtZXN0ZXItZ2VuYXAtbWktcHJvZ3Jlc2lmLWFsLWh1ZGEta2V0YW5vbi11Wm1kVyIsInJvdXRlIjoiYXJ0aWNsZS5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788109961),
('lOhbFdRK2W27ykjlFgQiymWpepiqG1I8GLJYAvqg', NULL, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1', 'eyJfdG9rZW4iOiI3dm9oc2pXQlZoZjRXZHBhWXJ4c3BjdzYySDNBNVZvODVZUnN6elN5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvaW5kZXgucGhwP3BhZ2U9Z3Jhdml0eXNtdHAtc2V0dGluZ3MmcmVzdF9yb3V0ZT0lMkZncmF2aXR5c210cCUyRnYxJTJGdGVzdHMlMkZtb2NrLWRhdGEiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1788117906),
('lOSEmyanwOTkSxa5taIMOTxXI4bBHy2p7lKRBoAL', NULL, '127.0.0.1', 'curl/8.7.1', 'eyJfdG9rZW4iOiIyT3l2SDVIOWJWU2E2UDRlTDMxaHdxWVBaRWROZllIRHA5RkEwU05rIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhXC9zZWxhbWF0LWRhbi1zdWtzZXMtcGVyYWloLW5pbGFpLXRlcmJhaWstdGthLW1pLXByb2dyZXNpZi1hbC1odWRhLWtldGFub24tdWZ4SUUiLCJyb3V0ZSI6ImFydGljbGUuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788116738),
('mpoedPx2FjkvhakBm4nP1tVbcrjhW2eJ0nJ8ps61', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Viewer/99.9.8853.8', 'eyJfdG9rZW4iOiJjZ0VzRVNqRUVBTms3SFFsQlNXZEZnWmlZa3A4SElFeTdqdm9uWDBsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788152392),
('P5EampB1nLGTYhh2ItjkLDCawxWi4aD9qknO1e1p', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15', 'eyJfdG9rZW4iOiJpdlRROWZYM2hnSGd1Z3FVTUVxdWVUa2d4clVEWnJyOXhqb2FlUlozIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvP3BhZ2U9Z3Jhdml0eXNtdHAtc2V0dGluZ3MmcmVzdF9yb3V0ZT0lMkZncmF2aXR5c210cCUyRnYxJTJGdGVzdHMlMkZtb2NrLWRhdGEiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1788117904),
('PjtujlUk0FS8LQUGScWlbG34FMUWHI8WR1EYCOce', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.3', 'eyJfdG9rZW4iOiJMdDdIU3NDYVh5VGJIdUFnOTIyT09UWktjbFlaN1d1WWZSNUJtOG5WIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhIiwicm91dGUiOiJuZXdzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788393365),
('pXibk0uBST604bemweoEB78Dww0lZ8QT5QVV3A11', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'eyJfdG9rZW4iOiJGNzJqQkFTSnRCQjFUNnRVUVRVdGZpbUNHZ0sxd3hJNzFQcEtiaUtDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788122516),
('QDso4lnBr2rwfaUTYzlE6JxZu3cZQMaEyHpnebBY', NULL, '127.0.0.1', 'curl/8.7.1', 'eyJfdG9rZW4iOiIwT2xjbUlJakJ5bndOSVFBM3o2SmE0RFNWN0djZUVtb0VHZ2VzcmJQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhXC9hc3Nlc3NtZW50LXN1bWF0aWYtYWtoaXItc2VtZXN0ZXItZ2VuYXAtbWktcHJvZ3Jlc2lmLWFsLWh1ZGEta2V0YW5vbi11Wm1kVyIsInJvdXRlIjoiYXJ0aWNsZS5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788116738),
('Qx3itx5pW1oBvj7gTs5tVlGZsCpjSBjLrLkoNYVk', NULL, '127.0.0.1', 'curl/8.7.1', 'eyJfdG9rZW4iOiJLNjNNR21uZTBrZWJnUWJYUmZiZWR0SDZJZ0hTS0xtQ0dua3p1dEhxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhIiwicm91dGUiOiJuZXdzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788109960),
('rx5X5zPPbUfhURhZOx2thlLCD1S5LqsOI0y9aL86', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.3', 'eyJfdG9rZW4iOiJxR1hUVWNQZ0RzUG11SzhRcEtuOGpYNURzV2hrV3E3dzNSU3ZZQmRzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788393362),
('se4OqlOny974JQPaeavrj7LnLNjYM3MAq6qlIxt7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI5bVVoNnEzeFF2RXBxWlVYbmFCSE1HbGduWHdqNWRNNmJxQXJVZmtRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788137323),
('Seh0MCmxaKhNZEr3f8ftFx9wXAovKZCS4vwKXxl7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Viewer/99.9.8853.8', 'eyJfdG9rZW4iOiIxNjlnaVVPOWNQaTdrbUt3V1NGWXU5Ukc3S3RXOTZxTWR2ajltOTh1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhIiwicm91dGUiOiJuZXdzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788152395),
('tyTmUYOT9yjJYTnUDEruykk9zTIiy9ECeBIhgOwv', NULL, '127.0.0.1', 'curl/8.7.1', 'eyJfdG9rZW4iOiJUM0tRbjFzQmw5NXZZb2NEeUg4UG4ydkdObkNrQnBSV0NNa20zbmpjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788116736),
('Uo2n5TPmWnTCmhtNmsBMMVlyILpW0rWH2fZvt99D', NULL, '127.0.0.1', 'curl/8.7.1', 'eyJfdG9rZW4iOiJzZGlmS3VkR2NqOFlXMWZzZEhVc2p6SFRiaUhGS0VUbm5uMmgyWWI0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhIiwicm91dGUiOiJuZXdzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1788116737),
('XcKXSEWcUETv0yimdFHWRxTHsUowaBSFYjSFbjPL', NULL, '127.0.0.1', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'eyJfdG9rZW4iOiJycEoyQnhxdjhlWldhYlhhY05sSnhnZFgyNTQ5Rkp1ZEIycFc2bG45IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788169241),
('XGpZT4MxtXCGPxx38X9RXjScOvEl3DE9p9ULHzHa', NULL, '127.0.0.1', 'python-requests/2.32.5', 'eyJfdG9rZW4iOiJGY0NjUmpZV0xuVHNFYUh2WmxlbFREUGFHS20xeUo3bUcyVlEzVkRUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788156356),
('YJZ9TUNmis7pWpDmIAmyavWbUZodQx5n9AA5EDPS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJpNWVlblc4eUN3NUZuVjg4dXpCMWN6ZVAzejg0MXpndmc3Smc5aklYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788117903),
('yYyFj2UEYFGkUo1h6zkRRgq1mbvUZuO8ac61p3sv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJSSWJFTFpHMGlvdzYzVzdBMG5VUjhkbzZ4NUJpTTJhODVYMDlNVjI1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788162508),
('ZHMofo2rTBHqilwTPKMj5ECMo5ZO1QzvDYFi6NJJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJSWWREdTB4Q3JGWEVaSFg3QU9NMzV4VFhyOWtqR2RiMzJZaXNBY2I5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788118210),
('ZunvgpoMhAhmSy6s9ovIxtMv4RzCWky5ulCskCiM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.3', 'eyJfdG9rZW4iOiJpakZGN0czcFpaRWZCbkZIY0F6dGxpTU9GNVhVOEgyNmpHNFNTUmN4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21pcHJvYWxodWRhLnNjaC5pZFwvYmVyaXRhXC9zZWxhbWF0LWRhbi1zdWtzZXMtcGVyYWloLW5pbGFpLXRlcmJhaWstdGthLW1pLXByb2dyZXNpZi1hbC1odWRhLWtldGFub24tdWZ4SUUiLCJyb3V0ZSI6ImFydGljbGUuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1788393363);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Syarif Ahsani Taqwim', 'syarifat', NULL, '$2y$12$o1DWdN7UuY21C5r4BSolHe5FDUD5qYnXaxHEk54vogA3FQFV4QRVm', NULL, '2026-05-15 22:07:41', '2026-05-25 21:53:46'),
(3, 'MI PROGRESIF AL-HUDA KETANON', 'MIPROALHUDA', NULL, '$2y$12$VcGZreyROAuxptfSPR95U.5XTMqlSppmAxx7ljl.RfZvuvKCLXZ6K', 'tZUd2xdJcigHIdZkmgvU5g9yLBQeFiQr1LDnSOrg6CuIHtQXW1JXY2ZPbmXq', '2026-05-26 04:15:49', '2026-05-26 04:15:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `school_profiles`
--
ALTER TABLE `school_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `school_profiles`
--
ALTER TABLE `school_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;