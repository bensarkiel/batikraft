-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 02:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deactived_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon_url` varchar(255) NOT NULL,
  `fee_flat` int(255) NOT NULL,
  `fee_percent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `group`, `code`, `name`, `deactived_at`, `created_at`, `updated_at`, `icon_url`, `fee_flat`, `fee_percent`) VALUES
(1, 'Virtual Account', 'MYBVA', 'Maybank Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(2, 'Virtual Account', 'PERMATAVA', 'Permata Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(3, 'Virtual Account', 'BNIVA', 'BNI Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(4, 'Virtual Account', 'BRIVA', 'BRI Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(5, 'Virtual Account', 'MANDIRIVA', 'Mandiri Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(6, 'Virtual Account', 'BCAVA', 'BCA Virtual Account', NULL, NULL, NULL, '-', 5500, '0.00'),
(7, 'Virtual Account', 'SMSVA', 'Sinarmas Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(8, 'Virtual Account', 'MUAMALATVA', 'Muamalat Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(9, 'Virtual Account', 'CIMBVA', 'CIMB Niaga Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(10, 'Virtual Account', 'BSIVA', 'BSI Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(11, 'Virtual Account', 'BSIVAOP', 'BSI Virtual Account (Open Payment)', NULL, NULL, NULL, '-', 3333, '0.00'),
(12, 'Virtual Account', 'OCBCVA', 'OCBC NISP Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(13, 'Virtual Account', 'DANAMONVA', 'Danamon Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(14, 'Virtual Account', 'BNCVA', 'BNC Virtual Account', NULL, NULL, NULL, '-', 4250, '0.00'),
(15, 'Convenience Store', 'ALFAMART', 'Alfamart', NULL, NULL, NULL, '-', 3500, '0.00'),
(16, 'Convenience Store', 'INDOMARET', 'Indomaret', NULL, NULL, NULL, '-', 3500, '0.00'),
(17, 'Convenience Store', 'ALFAMIDI', 'Alfamidi', NULL, NULL, NULL, '-', 3500, '0.00'),
(18, 'E-Wallet', 'OVO', 'OVO', NULL, NULL, NULL, '-', 0, '3.00'),
(19, 'E-Wallet', 'QRIS', 'QRIS by ShopeePay', NULL, NULL, NULL, '-', 750, '0.70'),
(20, 'E-Wallet', 'QRISC', 'QRIS (Customizable)', NULL, NULL, NULL, '-', 800, '0.70'),
(21, 'E-Wallet', 'QRIS2', 'QRIS', NULL, NULL, NULL, '-', 750, '0.70'),
(22, 'E-Wallet', 'SHOPEEPAY', 'ShopeePay', NULL, NULL, NULL, '-', 0, '3.00'),
(24, 'COD', 'COD', 'COD - Cash On Delivery', NULL, NULL, NULL, 'https://png.pngtree.com/png-clipart/20210530/original/pngtree-cash-on-delivery-of-cod-icon-png-image_6364045.jpg', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_name`, `username`, `password`, `admin_telp`, `admin_email`, `admin_address`) VALUES
(1, 'BeuatySkinAdmin', 'seller', 'lupapass', '08122612181612', 'beautyskin@gmail.com', 'Jl. Soekarno Hatta No. 9, Semarang, Jawa Tengah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`) VALUES
(9, 'Phone Strap'),
(10, 'Kalung'),
(11, 'Gelang'),
(13, 'Cincin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_alamat` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kode_pos` varchar(255) NOT NULL,
  `detail_alamat` text DEFAULT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_pelanggan`, `nama_lengkap`, `email`, `password`, `no_hp`, `id_alamat`, `provinsi`, `kota`, `kelurahan`, `kecamatan`, `kode_pos`, `detail_alamat`, `token`) VALUES
(1, 'eko', 'bagas@smkwikrama1jepara.sch.id', '77', '123456789', 'IDNP10IDNC393IDND4704IDZ50133', 'Jawa Tengah', 'Semarang', 'Semarang Tengah', '', '50133', 'yudistira', 'eca9074b39f479b74d2df675c80740a0'),
(2, 'gita', 'pratiwi@gmail.com', '1234', '085798765', 'IDNP14IDNC201IDND1702IDZ74181', 'Kalimantan Tengah', 'Kotawaringin Barat', 'Kumai', '', '74181', 'pangeran', NULL),
(3, 'Ika Risma', 'ika@gmail.com', '1234', '087987', 'IDNP10IDNC393IDND4704IDZ50132', 'Jawa Tengah', 'Semarang', 'Semarang Tengah', '', '50132', 'jalan nakula raya', NULL),
(4, 'gita', 'gita@gmail.com', '123', '123-45-678', 'IDNP14IDNC161IDND1098IDZ73555', 'Kalimantan Tengah', 'Kapuas', 'Kapuas Tengah', '', '73555', 'jl. soekarno', NULL),
(8, 'Nabilla', 'nabillanef123@gmail.com', 'Nabilla_123', '098765654312', 'IDNP10IDNC348IDND4066IDZ52311', 'Jawa Tengah', 'Pemalang', 'Pemalang', '', '52311', 'jl. moh hatta', '58e55a804408a027544f91cdac528c14'),
(9, 'Ika ', 'ika@gmail.com', 'Ika_123', '08678756789', 'IDNP10IDNC341IDND3955IDZ59111', 'Jawa Tengah', 'Pati', 'Pati', '', '59111', 'Jalan raya no, 12', NULL),
(10, 'diana', 'diana@gmail.com', '12345', '085333444555', 'IDNP10IDNC393IDND4705IDZ50122', 'Jawa Tengah', 'Semarang', '', '', '50122', 'Semarang Timur,Semarang, Jawa Tengah 50122', '6e096412d8c89020aa76653da8866816'),
(11, 'diana', 'diana@gmail.com', 'Diana12345678', '085333444555', 'IDNP10IDNC393IDND4705IDZ50122', 'Jawa Tengah', 'Semarang', '', '', '50122', 'Semarang Timur,Semarang, Jawa Tengah 50122', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(120) NOT NULL,
  `event_price` int(50) NOT NULL,
  `event_image` varchar(50) NOT NULL,
  `even_capacity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_event`
--

INSERT INTO `tb_event` (`event_id`, `event_name`, `event_price`, `event_image`, `even_capacity`) VALUES
(1, 'workshop 1 ', 55000, '1.png', 50),
(3, 'workshop 2', 65000, '2.png', 50),
(4, 'workshop 3', 50000, '3.png', 50),
(5, 'workshop 4', 55000, '4.png', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_status`, `date_created`, `stock`) VALUES
(53, 10, 'Star Choker Beaded', 20000, 'Batiste Fruity & Cheeky Cherry Dry Shampoo menyerap minyak berlebih di akar rambut dengan formula ‘Natural White Starch’, cara tercepat untuk membersihkan sekaligus menata rambut di manapun anda berada dan memberikan volume seketika pada rambut yang kotor dan lepek sehingga rambut mudah ditata dan tampak segar alami. Aroma cherry yang kuat akan menghidupkan pesona anda.', 'produk1705055285.jpeg', 1, '2022-12-24 14:36:20', 7),
(54, 10, 'soft blue and light pearl', 20000, 'Batiste Light & Breezy Fresh Dry Shampoo menyerap minyak berlebih di akar rambut dengan formula ‘Natural White Starch’, cara tercepat untuk membersihkan sekaligus menata rambut di manapun anda berada dan memberikan volume seketika pada rambut yang kotor dan lepek sehingga rambut mudah ditata dan tampak segar alami. Cara ideal untuk membersihkan dan menyegarkan rambut secara instant serta membuat rambut terasa tebal.', 'produk1705055267.jpeg', 1, '2022-12-24 14:37:54', 9),
(55, 10, 'pink sugared love', 20000, 'CBD Color Shield Conditioner. Perawatan intensif khusus untuk rambut yang diwarnai. Memperbaiki batang rambut yang rapuh dan melembutkan rambut\r\n> 3x lebih lembut\r\n> Melindungi warna rambut hingga 10 minggu\r\n> Melembabkan rambut\r\n> Fruity fragrance tahan lama\r\n> Dengan extrak pomegranate & ProVit B5\r\n> Mempertahankan kilau rambut\r\n> Diformulasikan khusus untuk rambut yang diwarnai\r\n> Mempertahankan warna rambut sampai 8x pencucian\r\n> Mudah menyerap ke batang rambut', 'produk1705055252.jpeg', 1, '2022-12-24 14:39:47', 10),
(56, 10, 'mismatched y2k', 20000, 'Batiste Floral & Flirty Blush Dry Shampoo menyerap minyak berlebih di akar rambut dengan formula ‘Natural White Starch’, cara tercepat untuk membersihkan sekaligus menata rambut di manapun anda berada dan memberikan volume seketika pada rambut yang kotor dan lepek sehingga rambut mudah ditata dan tampak segar alami. Kombinasi aroma bunga yang menyenangkan dan menyegarkan.', 'produk1705055235.jpeg', 1, '2022-12-24 14:40:25', 9),
(57, 10, 'Fairy Star, Heart', 20000, 'Batiste Divine Dark Dry Shampoo menyerap minyak berlebih di akar rambut dengan formula ‘Natural White Starch’, cara tercepat untuk membersihkan sekaligus menata rambut di manapun anda berada dan memberikan volume seketika pada rambut yang kotor dan lepek sehingga rambut mudah ditata dan tampak segar alami. Batiste Divine Dark diperuntukkan untuk kalian yang memiliki warna rambut gelap – baik dicat ataupun warna rambut alami. Batiste Divine Dark juga membantu untuk menyamarkan rambut putih.', 'produk1705055209.jpeg', 1, '2022-12-24 14:41:24', 17),
(58, 10, 'Colourful Pearl', 20000, 'Batiste Pretty & Opulent Oriental Dry Shampoo menyerap minyak berlebih di akar rambut dengan formula ‘Natural White Starch’, cara tercepat untuk membersihkan sekaligus menata rambut di manapun anda berada dan memberikan volume seketika pada rambut yang kotor dan lepek sehingga rambut mudah ditata dan tampak segar alami.', 'produk1705055192.jpeg', 1, '2022-12-24 14:42:16', 9),
(59, 9, 'phone strap 4', 18000, 'Dengan pemakaian teratur, kombinasi formula yg dapat meratakan kecerahan kulitmu dan melindungi nya agar tidak kembali kusam sekaligus melembabkan dan menghaluskan kulitmu sehingga terasa nyaman sepanjang hari setiap hari. Dengan kandungan 40x Vitamin C dari Ekstrak Camu-camu Berry mampu meratakan kecerahan kulitmu, dan double UV Filters dapat melindungi sehingga mencegah kulit tidak kembali menghitam dan penuaan dini akibat sinar UVA UVB serta Hydra IQ melembabkan dan menghaluskan kulitmu.', 'produk1705055153.jpg', 1, '2022-12-24 14:46:35', 16),
(60, 9, 'phone strap 3', 18000, 'Body Sun Serum dengan perlindungan tinggi untuk penggunaan sehari-hari. Formula yang tidak lengket dan mudah menyerap. Melindungi kulit dari efek bluelight, UVA, UVB, dan anti-polusi. Formula ekstrak mawar dari Hokkaido dengan 36x kekuatan anti-oksidan*. Kulit kusam menjadi tampak cerah beraura *36x kekuatan anti-oksidan apabila dibandingkan dengan Grapefruit.', 'produk1705055114.jpg', 1, '2022-12-24 14:47:36', 17),
(61, 9, 'phone strap 2', 18000, 'Mencerahkan, menjaga kuli tetap cerah serta merawat dari 10 tanda kulit kusan dan rusak, sekaligus melembabkan dan menghaluskan.', 'produk1705055070.jpg', 1, '2022-12-24 14:48:27', 15),
(65, 9, 'phone strap 1', 18000, 'Aroma : Floral - Amber - Musky\r\nOrange Mandarin - Jasmine - Musk - Amber - Vanilla\r\n\r\nManfaat:\r\n• Membantu menutrisi kulit\r\n• Membantu mencerahkan kulit', 'produk1705055048.jpg', 1, '2022-12-24 14:53:14', 9),
(72, 9, 'White and Soft Pink', 18000, 'Grape Seed & Avocado Oil untuk melembabkan secara intensive dan merawat kulit. \r\n\r\nVitamin E dan formula baru yang tidak lengket dikulit, merawat kulit kering & kulit pecah-pecah menjadi lebih lembut dan halus. \r\n\r\nMenjaga kelembaban kulit selama lebih dari 48 jam ', 'produk1705055026.jpg', 1, '2022-12-24 15:09:24', 9),
(73, 9, 'White and Red Cherry', 18000, 'Body moisturiser dengan tekstur mudah meresap, tidak lengket, dan ringan serta menggunakan fine fragrance yang tahan lama dan mewah. .Diformulasikan dengan bahan Melazero yang tidak hanya mencerahkan namun menghambat produksi hingga menghapus melanin. Galactomyces dapat digunakan sebagai antioksidan hingga menyamarkan garis halus. Tranexamid Acid yang dapat mencerahkan sekaligus memudarkan noda hitam.', 'produk1705054989.jpg', 1, '2022-12-24 15:10:43', 15),
(82, 9, 'Light Pearl and Butterfly', 18000, 'Body serum dengan Waterburst Technology yang mudah menyerap dan memberikan efek menyegarkan ketika dipakai dengan perpaduan Tuberose dan Jasmine serta kelembutan Musk dan Sandalwood, menciptakan keharuman floral yang hangat tahan hingga 10 jam.\r\n\r\nMencerahkan:  4% Niacinamide yang bermanfaat meratakan  warna kulit, memudarkan bekas jerawat dan kehitaman.\r\nMelindungi: 3 Ceramide memperbaiki skin barrier, dan menjaga kulit dari iritan.\r\nMelembapkan: 4D Hyaluronic Acid adalah gabungan 4 jenis HA yang mampu melembapkan kulit hingga ke lapisan kulit terdalam, mengunci hidrasi kulit.\r\n\r\nJenis kulit: Semua jenis kulit\r\n\r\nHero Ingredients:\r\n4% Niacinamide\r\n4D Hyaluronic Acid\r\n3 Ceramide Complex\r\n\r\nScent: Tuberose, Jasmine, Musk, Sandalwood\r\n\r\nUnique Selling  Points:\r\n✅Non-Greasy.\r\n✅Zero Residue.\r\n\r\n*Aman digunakan ibu hamil dan menyusui\r\n*Dapat digunakan dari usia 9 tahun', 'produk1705054973.jpg', 1, '2022-12-24 15:24:42', 12),
(84, 9, 'Black Heart and White', 18000, 'Sabun mandi yang paling baik adalah yang membuat kulitmu terasa bersih dan ternutrisi setelah mandi. Dengan sabun mandi Dove, kamu bisa mengubah salah satu ritual harianmu menjadi suatu bentuk perawatan untuk menjaga kulitmu tetap cantik dan lembap.', 'produk1705054956.jpg', 1, '2022-12-24 15:56:13', 10),
(87, 11, 'Pink and White Bracelet', 10000, 'Parfum elegnat dengan aroma  spices dan Woody yang membuat kita merasakan ke utuhan sebuah kemaskulinan, dipadukan dengan aroma sedikit manis dan amber untuk mempertegas aroma sexy dari seorang pria dan sangat cocok untuk digunakan di moment romantis .', 'produk1705054906.jpeg', 1, '2022-12-24 16:00:46', 5),
(88, 11, 'purple & white flower bracelet', 10000, 'Parfum elegant dengan aroma Fresh Aquatik yang membawa anda untuk merasakan damainya suasana pantai dengan kesegaran yang khas, yang dapat menciptakan perasaan nyaman, relax dan berkarakter.', 'produk1705054884.jpeg', 1, '2022-12-24 16:01:49', 5),
(91, 11, 'purple & white heart bracelet', 10000, 'Membuat parfum dengan sifat adiktif. Adalah challenge di balik project ini. Dalam perjalanannya, kita mencari ratusan tanaman. Mengekstraknya satu per satu. Hingga menemukan satu formulasi yang saat disemprotkan, akan mengeluarkan aroma fruity dari berry. Lalu secara misterius berubah menjadi rempah coffee yang membuat nyaman. Lalu ia menutup pertunjukkannya dengan kehangatan dari amber & tonka bean. Sebuah karya yang kita sebut dengan. HMNS Addict\r\n\r\nPerforma\r\nKetahanan: 6 hours\r\nDaya jejak: sedang\r\nProteksi: 2 meter', 'produk1705053365.jpeg', 1, '2022-12-24 16:06:31', 8),
(92, 11, 'Pearl and Blue Light Bracelet', 10000, 'Alpha, memiliki karakter segar & menenangkan. Merupakan varian pertama HMNS. Memiliki top notes Citrus & Grass. Serta middle & base notes Cedarwood & Green Tea. Type: Unisex Longevity: Up to 6 hours Sillage: Medium - strong Projection: 2 - 3 meters .', 'produk1705054846.jpeg', 1, '2022-12-24 16:07:28', 7),
(96, 13, 'Stretchy Pearl Ring,Real Freshwater Pearl ', 5000, 'Maybelline Fit Me! Loose Finishing Powder adalah bedak dari Maybelline dengan hasil matte yang sesuai dengan warna kulit. Bedak tabur inovasi terbaru ini diciptakan khusus untuk jenis kulit normal cenderung berminyak. Maybelline Fit Me! Loose Finishing Powder diklaim dapat meratakan warna kulit, sehingga hasil akhir atau finishing-nya terlihat lebih natural, kulit tampak tidak berpori, lebih tahan lama, dan bebas kilap hingga 12 jam.\r\n\r\nBedak yang pelengkap complexion usai mengaplikasikan foundation/ concealer mengandung mineral dengan formula yang ringan ini bertujuan untuk mengontrol kadar minyak pada wajah dan menjadikan kulit terlihat lebih halus dan flawless. \r\nCara Pemakaian:\r\nAmbil produk menggunakan kuas bedak, kemudian ketukan kuas terlebih dahulu secara perlahan supaya tidak ada bubuk yang terlalu banyak. Lalu sapukan secara lembut ke seluruh kulit wajah beserta leher Anda agar terlihat membaur dengan warna kulit.', 'produk1705054781.jpeg', 1, '2022-12-26 03:35:28', 13),
(97, 13, 'Smile face beaded ring happy face colorful ', 5000, 'LASH LIFT EFFECT IN A MINUTE! Mudah, cepat, dan ga mahal!\r\nMaskara Waterproof dengan lash lift effect yang tahan hingga 16 jam. All Day Formula infused with fiber yang akan membuat bulu mata terlihat lebih panjang dan tebal. Bulu mata terlihat lentik dengan double curved lifting brush yang dapat menjangkau seluruh bulu matamu. Mata terlihat lebih fresh dengan lash lift effect.', 'produk1705054751.jpeg', 1, '2022-12-26 03:36:15', 17),
(99, 13, 'Rings Gemini Jewels', 5000, 'Warna-warni Bronzer dari Esqa sangat menawan dengan daya tutup yang buildable. Tingkatkan rona pipimu dengan bronzer ini. Bronzer ini Vegan, Halal dan terbuat tanpa bahan kimia berbahaya. Ukurannya sangat cocok untuk travelling\r\nCara Penggunaan:\r\nPulaskan bronzer menggunakan kuas lembut ukuran medium pada tulang pipimu untuk hasil akhir yang lembut alami.\r\nKomposisi:\r\nMica, Talc, Dimethicone, Cyclopentasiloxane, Pentaerythrityl, Tetraisostearate, Barium Sulfate, Triethoxycaprylylsilane, Magnesium Myristate, Dimethiconol, Ethylhexyl Methoxycinnamate, Benzophenone-3, BHT, Sorbitan Laurate, DMDM Hydantoin, Iodopropynyl Butylcarbamate, Water, CI 77491, CI 77492, CI 77499.', 'produk1705054734.jpeg', 1, '2022-12-26 03:37:52', 10),
(100, 13, 'Cute Jewelry Summer Ring Flower', 5000, 'Lip cream terbaik dari Maybelline yang semakin memperkuat karaktermu dengan tekstur cair dan ink formula yang melembabkan serta memberikan hasil warna intens dan tahan lama.\r\nLip cream matte dengan ink formula yang menghasilkan warna-warna intens. Tahan lama sampai 16 jam.\r\nManfaat:\r\n- Aplikator liquid lipstick berbentuk arrow yang unik.\r\n- Ink formula untuk hasil warna matte lip cream intens.\r\n- Tahan lama hingga 16 jam.\r\nCara pemakaian:\r\nLangkah 1. Aplikasikan di bagian tengah bibir bagian atas lalu ikuti kontur bibir.\r\nLangkah 2. Pulas Super Stay Matte Ink di seluruh bagian bibir bawah.', 'produk1705054699.jpeg', 1, '2022-12-26 10:09:13', 11),
(101, 13, 'Beaded Rings Seed Bead Rings ', 5000, 'Maybelline Sensational Liquid Matte tergolong liquid matte dengan konsistensi yang cenderung cair, namun tetap mudah diratakan dan tidak patchy. Konsistensi yang cair dan lembut ini membuat produk sangat mudah dipulaskan dan terasa breathable. Walaupun cair, lipstik akan langsung matte dalam hitungan detik.', 'produk1705054683.jpeg', 1, '2022-12-26 10:09:57', 76),
(102, 13, 'Butterfly Glass Beads Ring', 5000, 'Komposisi : \r\nwater, isododecane, cyclopentasiloxane, ethylhexyl palmitate, propylene glycol, dimethicone, silica, butylene glycol, octyldodecanol, mineral oil, caprylic/capric triglyceride, hydrogenated polydecene, sorbitan sesquioleate, steareth-21, chlorphenesin, bht, fragrance, iodopropynyl butylcarbamate.', 'produk1705054665.jpeg', 1, '2022-12-26 10:11:30', 5),
(103, 13, 'cincin warna warni', 5000, 'Lip Gloss ini mempunyai full coverage dengan hasil yang mengkilap.\r\nLip Gloss ini memberikan kelembaban yang bertahan lama. Gloss ini vegan dan diperkaya dengan Vitamin E untuk menjaga bibir tetap terhidrasi\r\nIngredients :\r\nHydrogenated Polyisobutene, Polyisobutene, Phenyl Trimethicone, Caprylic/Capric Triglyceride, Ceresin, Dextrin Palmitate/Ethylhexanoate, Tridecyl Trimellitate, Phenoxyethanol, Butyrospermum Parkii (Shea) Butter, Flavour, Ethylhexyl Methoxycinnamate, Tocopheryl Acetate, BHT, Bisabolol, Water. ', 'produk1705054638.jpeg', 1, '2022-12-26 10:12:55', 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `pembayaran` varchar(255) NOT NULL,
  `payment_method_code` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `merchant_ref` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `pay_code` varchar(255) NOT NULL,
  `checkout_url` varchar(255) NOT NULL,
  `paid_at` varchar(255) DEFAULT NULL,
  `expired_at` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT current_timestamp(),
  `updated_at` varchar(255) DEFAULT current_timestamp(),
  `courier_name` varchar(255) NOT NULL,
  `shipment_description` varchar(255) NOT NULL,
  `shipment_duration` varchar(255) NOT NULL,
  `shipment_price` varchar(255) NOT NULL,
  `total_pembayaran` int(255) NOT NULL,
  `status_pesanan` varchar(255) NOT NULL DEFAULT 'Pesanan Masuk',
  `no_resi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pelanggan`, `total_harga`, `pembayaran`, `payment_method_code`, `reference`, `merchant_ref`, `amount`, `pay_code`, `checkout_url`, `paid_at`, `expired_at`, `status`, `created_at`, `updated_at`, `courier_name`, `shipment_description`, `shipment_duration`, `shipment_price`, `total_pembayaran`, `status_pesanan`, `no_resi`) VALUES
(1, 1, 374400, 'COD - Cash On Delivery', 'COD', '', '', '374400', '', '', NULL, '2023-06-18 23:04:10', 'PAID', '2023-06-19 23:04:10', NULL, 'JNE', 'Layanan reguler', '1 - 2 days', '9000', 383400, 'Penerimaan', 'asd1223123123'),
(2, 1, 159400, 'BCA Virtual Account', 'BCAVA', 'DEV-T320297501NRUBT', 'INV-PIYQ-2852', '159400', '212673214699441', 'https://tripay.co.id/checkout/DEV-T320297501NRUBT', NULL, '2023-06-18 23:43:29', 'UNPAID', '2023-06-19 23:43:29', NULL, 'JNE', 'Layanan reguler', '1 - 2 days', '9000', 168400, 'Penerimaan', 'sdf hjk,asdk,gbhjdf,ASBJK'),
(3, 1, 84000, 'COD - Cash On Delivery', 'COD', '', '', '84000', '', '', NULL, '2023-06-18 23:55:00', 'UNPAID', '2023-06-19 23:55:00', NULL, 'JNE', 'Layanan reguler', '1 - 2 days', '9000', 93000, 'Penerimaan', 'wdlahjkfasdghjklasdefhjk'),
(4, 11, 84000, 'Maybank Virtual Account', 'MYBVA', 'DEV-T3202133418A7BRR', 'INV-XNPY-5704', '84000', '365597930162574', 'https://tripay.co.id/checkout/DEV-T3202133418A7BRR', NULL, '2023-12-01 11:16:42', 'UNPAID', '2023-12-02 11:16:42', NULL, 'JNE', 'Layanan reguler', '1 - 2 days', '9000', 93000, 'Penerimaan', '123');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_barang`
--

CREATE TABLE `transaksi_barang` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_barang`
--

INSERT INTO `transaksi_barang` (`id`, `transaksi_id`, `product_id`, `jumlah`) VALUES
(1, 1, 100, 1),
(2, 1, 101, 1),
(3, 1, 95, 1),
(4, 2, 95, 1),
(5, 3, 99, 1),
(6, 4, 99, 1);

--
-- Triggers `transaksi_barang`
--
DELIMITER $$
CREATE TRIGGER `update_stok_barang_dari_transaksi_barang` AFTER INSERT ON `transaksi_barang` FOR EACH ROW UPDATE tb_product
     SET stock = stock - NEW.jumlah
   WHERE tb_product.product_id = NEW.product_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_lawas`
--

CREATE TABLE `transaksi_lawas` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pemesanan` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `total_harga` varchar(255) NOT NULL,
  `pembayaran` varchar(255) NOT NULL,
  `courier_name` varchar(255) NOT NULL,
  `shipment_description` text NOT NULL,
  `shipment_duration` varchar(255) NOT NULL,
  `shipment_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_lawas`
--

INSERT INTO `transaksi_lawas` (`id`, `id_pelanggan`, `tanggal_pemesanan`, `total_harga`, `pembayaran`, `courier_name`, `shipment_description`, `shipment_duration`, `shipment_price`) VALUES
(5, 6, '2022-12-24 16:10:10', '7500', 'bca', '0', '0', '0', 0),
(17, 9, '2022-12-24 19:42:21', '750000', 'bca', '0', '0', '0', 0),
(18, 9, '2022-12-24 19:51:25', '250000', 'bca', '0', '0', '0', 0),
(31, 8, '2022-12-26 11:12:00', '195000', 'bni', '0', '0', '0', 0),
(32, 15, '2023-04-05 15:15:25', '93549', 'bca', '0', '0', '0', 0),
(33, 16, '2023-05-18 16:46:28', '279549', 'bca', '0', '0', '0', 0),
(34, 16, '2023-05-18 16:47:44', '93549', 'bca', '0', '0', '0', 0),
(35, 16, '2023-05-18 16:49:04', '93549', 'bca', '0', '0', '0', 0),
(36, 16, '2023-05-18 17:01:23', '93549', 'bca', '0', '0', '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_lawas`
--
ALTER TABLE `transaksi_lawas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi_lawas`
--
ALTER TABLE `transaksi_lawas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD CONSTRAINT `tb_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tb_category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
