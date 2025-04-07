-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 06, 2025 lúc 05:57 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webbandienthoai`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `brandId` char(36) NOT NULL,
  `brandName` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`brandId`, `brandName`, `logo`, `isDeleted`) VALUES
('0196094a-3841-7011-82bb-8c31665581b8', 'Iphone', '/storage/images/brand/Iphone.png', 0),
('0196094a-387a-7016-bd8a-9c6761a6bea7', 'SamSung', '/storage/images/brand/SamSung.png', 0),
('0196094a-387b-7002-a05b-197e905da5f6', 'Honor', '/storage/images/brand/Honor.png', 0),
('0196094a-387b-7002-a05b-197e911c6bf0', 'Nokia', '/storage/images/brand/Nokia.png', 0),
('0196094a-387c-71b3-b578-8391278df86b', 'Oppo', '/storage/images/brand/Oppo.png', 0),
('0196094a-387c-71b3-b578-8391286c03a1', 'Realme', '/storage/images/brand/Realme.png', 0),
('0196094a-387d-7377-93cc-c5338816bf77', 'Vivo', '/storage/images/brand/Vivo.png', 0),
('0196094a-387d-7377-93cc-c53388c6f0b1', 'Xiaomi', '/storage/images/brand/Xiaomi.png', 0),
('0196094a-53b4-7023-9985-5e31bac9b550', 'Iphone', '/storage/images/brand/Iphone.png', 0),
('0196094a-53bc-719d-945a-f0e8ec78e766', 'SamSung', '/storage/images/brand/SamSung.png', 0),
('0196094a-53bd-733f-9f06-da2d2aa48531', 'Honor', '/storage/images/brand/Honor.png', 0),
('0196094a-53bd-733f-9f06-da2d2b5fd759', 'Nokia', '/storage/images/brand/Nokia.png', 0),
('0196094a-53be-72a4-acf2-e2707987d7b6', 'Oppo', '/storage/images/brand/Oppo.png', 0),
('0196094a-53be-72a4-acf2-e2707a3d7c9e', 'Realme', '/storage/images/brand/Realme.png', 0),
('0196094a-53bf-70e3-b2b8-d08c6c6f15fe', 'Vivo', '/storage/images/brand/Vivo.png', 0),
('0196094a-53c0-7022-afe0-1aefffbbb8db', 'Xiaomi', '/storage/images/brand/Xiaomi.png', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image_products`
--

CREATE TABLE `image_products` (
  `imageId` char(36) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `productId` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `image_products`
--

INSERT INTO `image_products` (`imageId`, `imagePath`, `productId`) VALUES
('01960961-7070-7284-9cf9-5034eabe401e', '/storage/images/products/8UUu7QzQ4AH4icMWgUTk1KVEpqxKamuNfKEP1g69.jpg', '01960961-6c2a-7157-8ca8-bb9378b51332'),
('01960961-707a-715b-bcb3-722d7a89da49', '/storage/images/products/Tn5Nmdc7QS9txnxfOMg5RP60uPdyS5fGqJ15iI0M.jpg', '01960961-6c2a-7157-8ca8-bb9378b51332'),
('01960961-7084-71f3-8b28-aa6d4512ee7b', '/storage/images/products/EVUc0EFxZE97SgEKskYvFMswdzwvaOTSAZFebfWy.jpg', '01960961-6c2a-7157-8ca8-bb9378b51332'),
('01960961-708b-7156-a4d9-17f2bd556e7e', '/storage/images/products/VOu01rh2NdCa5cqDBiqQHb2OCvRyxZyZpD9W0m59.jpg', '01960961-6c2a-7157-8ca8-bb9378b51332'),
('01960961-708f-712d-b10f-0fe161864f73', '/storage/images/products/IjhyhUxbMDj4Xo4xzXLwGG3w0fle67nvqBGCzhwP.jpg', '01960961-6c2a-7157-8ca8-bb9378b51332'),
('01960961-7094-7323-87c7-278c9e4a24cb', '/storage/images/products/eoPyRCvPgAYebEL2bec4cM1lSyDTiWwkkCE1yO4C.jpg', '01960961-6c2a-7157-8ca8-bb9378b51332'),
('01960961-8a27-7048-b2f8-72ea1026153e', '/storage/images/products/RJmgwWUvDVW01snDvDO2tf0CSvaqNOXlVWGAT9ix.jpg', '01960961-8a01-7161-ac5b-70843cd4fb43'),
('01960961-8a2e-700d-a93d-ef75765175e6', '/storage/images/products/T59maBkvGfZxFCKiCAhpZ5UwgorI6TkmIoSa3xZ6.jpg', '01960961-8a01-7161-ac5b-70843cd4fb43'),
('01960961-8a32-725a-bb50-66ada97d59af', '/storage/images/products/9HPMmCWcNxWMThBTc5wWFJfyAlTpxPcl9rKQiE8G.jpg', '01960961-8a01-7161-ac5b-70843cd4fb43'),
('01960961-8a38-70ee-8107-adc6bac2d6a6', '/storage/images/products/HbcOHLUTVnihC7K4d3D5n98GJPh8uAtqtLgNloEB.jpg', '01960961-8a01-7161-ac5b-70843cd4fb43'),
('01960961-8a3f-7262-bac4-cde0c48a95bf', '/storage/images/products/3dfO5wvCQNQP6xVXaBVvvmk4xEt62g4ICxJmlEK2.jpg', '01960961-8a01-7161-ac5b-70843cd4fb43'),
('01960961-8a48-732b-8c6f-81a0874c3056', '/storage/images/products/lnIL7O1fXw2J1vdyE8bk55eORMsxb65Ic1pp3k8k.jpg', '01960961-8a01-7161-ac5b-70843cd4fb43'),
('01960961-a54a-722c-89f6-a0705ccafa4b', '/storage/images/products/waCdu6DPS4jAeGC8GMPOqRFaLgPOeSggpFpUa7VO.jpg', '01960961-a538-72ff-84dd-bf75c4486986'),
('01960961-a54e-73b3-9cfd-f4e5d0d2683c', '/storage/images/products/beZtAGyyEHf5FaQUuuxURoyUEg4LH2F5Jg7Il46G.jpg', '01960961-a538-72ff-84dd-bf75c4486986'),
('01960961-a556-700c-b52f-69db838e916d', '/storage/images/products/T6e1Y60w15Eok2RhqGSiUBcnSARfnisAG2n0zMAw.jpg', '01960961-a538-72ff-84dd-bf75c4486986'),
('01960961-a55d-724e-ba47-33d9602195f5', '/storage/images/products/9iBdc6rpwzpwEUKSSLo60fNuGAKVAyxJnaMDSmSn.jpg', '01960961-a538-72ff-84dd-bf75c4486986'),
('01960961-a563-7248-bdcb-69b46717dedd', '/storage/images/products/l3rY2FzMZO21FP0ZNY1vZfLVspqJXJFgXJTEX4Dq.jpg', '01960961-a538-72ff-84dd-bf75c4486986'),
('01960961-a569-71b4-bdc2-a6388578af91', '/storage/images/products/VosHj2eiLQDMVeetjbf8O66kN5vKMO1GpA0Um9lV.jpg', '01960961-a538-72ff-84dd-bf75c4486986'),
('01960961-b8f0-724d-917f-7d3d5d992cc2', '/storage/images/products/JKggbVhlzug3QVIq8QZp4g1WGyLn6HXnuFv557fL.jpg', '01960961-b8db-7313-a695-cf76a3272473'),
('01960961-b8f3-7224-8898-cb6737ef1047', '/storage/images/products/hqHGrj8RdXGP020NEK68ZmzMUaHlIB0sSB49hdwk.jpg', '01960961-b8db-7313-a695-cf76a3272473'),
('01960961-b8f8-720e-87c0-cf7d8b5eedbe', '/storage/images/products/uHu81tymMYVNcv2hF2dKJXFFOuK1Z0RU5jlESz0H.jpg', '01960961-b8db-7313-a695-cf76a3272473'),
('01960961-b8fe-7085-97de-79f5a021a280', '/storage/images/products/HZ36uHCrKp8c3ZqXxu2Mjvn72K6Ct5hTFgTrPaO3.jpg', '01960961-b8db-7313-a695-cf76a3272473'),
('01960961-b905-7180-b32e-f4f81d59d9f7', '/storage/images/products/Vdr53JelIpqgJnMIbeoyvRJ5q03e81tP7U7oA9y3.jpg', '01960961-b8db-7313-a695-cf76a3272473'),
('01960961-b90d-719b-9310-77d260bf5b14', '/storage/images/products/KcKogaan5Eq3JVdpgZYTuJLp9LyWNfAhAAlRHUzt.jpg', '01960961-b8db-7313-a695-cf76a3272473'),
('01960a34-49ed-70d4-98a9-0a84345fd9a5', '/storage/images/products/tmRZFjPh3uPMXDfeD2iE6tn6kcDHsJYfvzSNINaR.png', '01960a34-49d2-701b-9a27-329968503870'),
('01960a34-49f0-72b1-b2be-346e24e70a55', '/storage/images/products/G0nZyaKtbpOxDCn8VfOmmXqB8dMevqTlbKkd15uP.png', '01960a34-49d2-701b-9a27-329968503870'),
('01960a34-49f3-7342-8dfc-9ea937e4e8ae', '/storage/images/products/ZfwOnCziAQrGSPcJVvjlmr6m4wLLNSZxc8feQnwq.png', '01960a34-49d2-701b-9a27-329968503870'),
('01960a34-49f6-72d3-8d46-1b391abd3a0f', '/storage/images/products/yVrx7hKhzEZosRaxYBhmPwUjqDG5JmQMhpgMy9CT.png', '01960a34-49d2-701b-9a27-329968503870'),
('01960a34-9e4d-71b4-8a91-7a5b68ca145f', '/storage/images/products/uLMSRa9hhvhRmi8wjNQiPIJhFOLh8wVhvcFhkIkj.png', '01960a34-9e42-716f-baec-6380a70d2ab6'),
('01960a34-9e51-70c8-bf8e-0269d3f939c1', '/storage/images/products/nj9iW9HCJAgtstKI7Gz50Cc7okjHCS4S5IueixhU.png', '01960a34-9e42-716f-baec-6380a70d2ab6'),
('01960a34-9e54-71a4-b997-67e6e529db36', '/storage/images/products/qwCwfxq95BTvZzwegaWa4JprV9NyrDc5iVMvFOV5.png', '01960a34-9e42-716f-baec-6380a70d2ab6'),
('01960a34-9e57-72e7-b00c-a7d66d9cd2d2', '/storage/images/products/rm0Vk7WHmL9q9SjosdhQruIswcrM7lEVhHpBMuKx.png', '01960a34-9e42-716f-baec-6380a70d2ab6'),
('01960a34-df26-7264-a021-b425c69d81e3', '/storage/images/products/RSdL2WthSsJbUti1SthY3YH6zxwstGrFmzp3r3g4.png', '01960a34-df1a-73df-8713-b522bc0ec107'),
('01960a34-df2a-714a-a574-80c1acb5d89a', '/storage/images/products/OBToArDTGSs5w5Svr8iHfCE9bAjX5kTEldmLR7KG.png', '01960a34-df1a-73df-8713-b522bc0ec107'),
('01960a34-df2c-705a-a924-ea5df30f9a6e', '/storage/images/products/l0WtGUqFizqAUUiQBNnjOA6NUrEIpQPIDlzShpbo.png', '01960a34-df1a-73df-8713-b522bc0ec107'),
('01960a34-df30-701e-8fb8-e7caa0cbe1a6', '/storage/images/products/n0u8FmT3qI5WBOZAxeK9BS4lH13KQbsqFbYpCqsn.png', '01960a34-df1a-73df-8713-b522bc0ec107'),
('01960a3a-89a5-70b9-b8ea-9008aff31fac', '/storage/images/products/5QiQWswPhNskLTjoqS5IvHUkTQ3ZDOAu3JP1A5SS.png', '01960a3a-8998-706e-9ff1-fae060ec83a2'),
('01960a3a-89a7-7207-96c7-119f5cf80350', '/storage/images/products/Z8t15QNt7bODFviz0bs92NjHn7iV78wFsKrbD459.png', '01960a3a-8998-706e-9ff1-fae060ec83a2'),
('01960a3a-89aa-70a1-8b1f-7b4b64add766', '/storage/images/products/FCubVz1Y5PxozNRNiePt1q8LZ41QD2rEt0wrwDQc.png', '01960a3a-8998-706e-9ff1-fae060ec83a2'),
('01960a3a-89ad-71be-b8ae-f858c2b7219c', '/storage/images/products/imwWJIQKCzIgsqcWZ2q7Ag844rHn6Wqlz8KXgoe6.png', '01960a3a-8998-706e-9ff1-fae060ec83a2'),
('01960a3a-e382-722a-a954-6f85672baf0f', '/storage/images/products/OkSccVekMVvj0QQY2JYY2qhuX6Gi5agw6YNhXtf2.png', '01960a3a-e377-73e3-84e8-f0928488e494'),
('01960a3a-e385-72bd-a287-fc90ba34d26a', '/storage/images/products/xEExfPVCGcjHs0ZQQgTo53uK7OW6Ikad4aXORvlo.png', '01960a3a-e377-73e3-84e8-f0928488e494'),
('01960a3a-e388-714f-82d5-80408961e70b', '/storage/images/products/YTPHCSv5V3iIFSpWt55P4FzPPh0Wt9rzVuCfwRnP.png', '01960a3a-e377-73e3-84e8-f0928488e494'),
('01960a3a-e38c-7157-944c-d91e04df747e', '/storage/images/products/X95ExpQ19rOtQxVXRvPSh9TxFmL5aha1TiB4fD2Z.png', '01960a3a-e377-73e3-84e8-f0928488e494'),
('01960a3b-94b6-72aa-a639-682e91fb57ce', '/storage/images/products/PRbwq0mvEAKHe3IuiQLvRAOF9Yu8eLm0WeDfm3uI.png', '01960a3b-94a8-730d-a998-bddac8798fc7'),
('01960a3b-94ba-72d0-898f-37f90649fe04', '/storage/images/products/KJqI4I9yr2F92gUyRDlhhw6xWYKiYUuIjfHO7J8I.png', '01960a3b-94a8-730d-a998-bddac8798fc7'),
('01960a3b-94bd-73ff-bb63-f2307e63d9c8', '/storage/images/products/8C2BHhOSBE8FBJOwYrZwkNOtV7jL1mNRMLFEu0qK.png', '01960a3b-94a8-730d-a998-bddac8798fc7'),
('01960a3b-94c2-73d3-a636-8fd9d7a06ad4', '/storage/images/products/DtoodF0d1oQJnYNqtY8Cn2Nq5ACSBIiA9y1C3nHP.png', '01960a3b-94a8-730d-a998-bddac8798fc7'),
('01960a3c-6bd5-70cb-a7e1-196efc308ec3', '/storage/images/products/RGKFZ5iTinZc2KS36s5QWE1SPNBjsLhqPPIPp3Cj.png', '01960a3c-6bc7-739d-8331-e614d2a66f0f'),
('01960a3c-6bd8-72af-92d5-f7491dbadab0', '/storage/images/products/s3UPFrryZnhyqmj57aWdCzG9hCR4o2c8rmtck2VO.png', '01960a3c-6bc7-739d-8331-e614d2a66f0f'),
('01960a3c-6bdb-7059-aa14-34e01474c953', '/storage/images/products/r0w89Gj0MKpchUoeYt6baRKujWHJA6Ln6shnH3x1.png', '01960a3c-6bc7-739d-8331-e614d2a66f0f'),
('01960a3c-6bdf-7167-81d7-928cfefb502b', '/storage/images/products/smQwwGKxbyKShnX6nrdxdjL94DBT8SGY8iZuVIgL.png', '01960a3c-6bc7-739d-8331-e614d2a66f0f'),
('01960a3d-1bd2-70b5-863b-03646c68580e', '/storage/images/products/K0pQyvOAOKoHHug9eAPWoulkOxvF6egIFsynZEHG.png', '01960a3d-1bc8-7219-819f-ccbfbf6d0818'),
('01960a3d-1bd6-70f7-a9a6-7270c407a57c', '/storage/images/products/uTXi1EOs3c9vPMjKrLJqBtN43c6LcSa3hErBC23j.png', '01960a3d-1bc8-7219-819f-ccbfbf6d0818'),
('01960a3d-1bd9-73dc-97b5-8f89ea3894fd', '/storage/images/products/KBKZJdPi6c36lKgMQxLx2fIoeiNl6thkGgwkSqOC.png', '01960a3d-1bc8-7219-819f-ccbfbf6d0818'),
('01960a3d-1bdc-73b7-a503-d7ebd625123f', '/storage/images/products/KTIyiwnAtUq4Wyfp3VWbwYHydP5e9KIFn6ilwvRx.png', '01960a3d-1bc8-7219-819f-ccbfbf6d0818'),
('01960a3e-333e-72ff-875b-3db6b024df1d', '/storage/images/products/rHdCZEjAAGtvBselZdt5YdNulCOhjBfA5aSdR4gU.png', '01960a3e-3331-70dd-a6ee-689218e77454'),
('01960a3e-3341-7301-9eeb-8089e662b5fc', '/storage/images/products/NWcIerWe4pJzmVeXvdjz7tRlAwbdWDjRcGushBLN.png', '01960a3e-3331-70dd-a6ee-689218e77454'),
('01960a3e-3344-739b-b934-30e7f60fccde', '/storage/images/products/fpFuaWQpkGHzSdSJWx2nNCnGHuKa7AX4zK6RH3tA.png', '01960a3e-3331-70dd-a6ee-689218e77454'),
('01960a3e-3348-72b6-b3be-3a0b7bbecdc9', '/storage/images/products/OJTdXWRYH0TONicJRCLD6if3OJhltCGa0nR052tE.png', '01960a3e-3331-70dd-a6ee-689218e77454'),
('01960a3e-4026-7390-b835-a6081e76266f', '/storage/images/products/hszyyeepHXeZcEUji4DVpmcKstbf8n7K9075CdMT.png', '01960a3e-401b-71b4-b34f-5c148e3129ff'),
('01960a3e-4029-73bc-82d2-f9e462e2881b', '/storage/images/products/ySkvwLnPbr5270wLaJWZQx0rPqTS205Q8siITqOI.png', '01960a3e-401b-71b4-b34f-5c148e3129ff'),
('01960a3e-402c-72e4-b40f-8cc55e73e269', '/storage/images/products/m0p4VUZeGnixRsoMDkngGHNK8xBgGIMc6V1VIBZV.png', '01960a3e-401b-71b4-b34f-5c148e3129ff'),
('01960a3e-402f-73ae-a5fa-98b2627f659d', '/storage/images/products/3aTbxoxvW7hVEFQOYkVwarAH25aIiaaTbAY30QWi.png', '01960a3e-401b-71b4-b34f-5c148e3129ff'),
('01960a3e-6352-71cb-b825-b0066b93dfa0', '/storage/images/products/rv8tdmBrYjyCHehdLUxN6DG7ldCqf3XnuUDLJldW.png', '01960a3e-6345-7263-b8b4-99447c31b84a'),
('01960a3e-6355-7314-ae94-9ec8bbeb6b6d', '/storage/images/products/EOOmUAtKllfPIACgV0h9Sc1u32p6rMvHLSmfvtiN.png', '01960a3e-6345-7263-b8b4-99447c31b84a'),
('01960a3e-6358-71c6-bdd5-bada81e07c63', '/storage/images/products/mxezqNic59g9p9ZMBgp0WJPrVxq2zmHDkZJUf1EA.png', '01960a3e-6345-7263-b8b4-99447c31b84a'),
('01960a3e-635c-73b7-a9e6-45119dc0f1ba', '/storage/images/products/by5OWAQvDia4n2euhGTzdUJYMWw2olUmfQobsXHC.png', '01960a3e-6345-7263-b8b4-99447c31b84a'),
('01960a3e-a46a-7254-be08-c032a2fec6dd', '/storage/images/products/fgAmbq1hnMXSCUFFb0GNkXxR8iT23zhn82IRNxin.png', '01960a3e-a45f-7242-aa96-f50d6627b03a'),
('01960a3e-a46d-71a7-813f-c5ae91b9dd47', '/storage/images/products/ckcomm9ghSBBs6gi9WUqMIb0PsZ2FGWWQujQR22r.png', '01960a3e-a45f-7242-aa96-f50d6627b03a'),
('01960a3e-a470-734a-bab7-903b758f2357', '/storage/images/products/8vwc3QFkCDcs50ZD3WBCdorQZPzBF6jvrv9rTv6g.png', '01960a3e-a45f-7242-aa96-f50d6627b03a'),
('01960a3e-a474-7012-a804-8f555b3f59f0', '/storage/images/products/jxIPTloGRzwANyYUR2YBaZnxrzO1k05cfXWmUmZx.png', '01960a3e-a45f-7242-aa96-f50d6627b03a');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `like_list`
--

CREATE TABLE `like_list` (
  `userId` char(36) NOT NULL,
  `productId` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_03_24_171058_create_roles_table', 1),
(2, '2025_03_24_171425_create_users_table', 1),
(3, '2025_03_24_171500_create_brands_table', 1),
(4, '2025_03_24_171517_create_products_table', 1),
(5, '2025_03_24_171621_create_reviews_table', 1),
(6, '2025_03_24_173654_create_image_products_table', 1),
(7, '2025_03_24_174009_create_orders_table', 1),
(8, '2025_03_24_174446_create_like_list_table', 1),
(9, '2025_03_24_174617_create_order_details_table', 1),
(10, '2025_03_30_072955_create_previews_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `orderId` char(36) NOT NULL,
  `totalPrice` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userId` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `orderId` char(36) NOT NULL,
  `productId` char(36) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `previews`
--

CREATE TABLE `previews` (
  `previewId` char(36) NOT NULL,
  `content` text NOT NULL,
  `userId` char(36) NOT NULL,
  `productId` char(36) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `productId` char(36) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` decimal(15,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `CPU` varchar(255) NOT NULL,
  `RAM` int(11) NOT NULL,
  `storage` varchar(255) NOT NULL,
  `display` varchar(255) NOT NULL,
  `battery` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `brandId` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`productId`, `productName`, `productPrice`, `description`, `CPU`, `RAM`, `storage`, `display`, `battery`, `isDeleted`, `brandId`) VALUES
('01960961-6c2a-7157-8ca8-bb9378b51332', 'Iphone 15', 20000000.00, 'Là iphone 15', 'A15', 8, '512GB', 'OLED', 5000, 1, '0196094a-3841-7011-82bb-8c31665581b8'),
('01960961-8a01-7161-ac5b-70843cd4fb43', 'Iphone 14', 20000000.00, 'Là iphone 15', 'A15', 8, '512GB', 'OLED', 5000, 0, '0196094a-3841-7011-82bb-8c31665581b8'),
('01960961-a538-72ff-84dd-bf75c4486986', 'Iphone 13', 20000000.00, 'Là iphone 13', 'A15', 8, '512GB', 'OLED', 5000, 0, '0196094a-3841-7011-82bb-8c31665581b8'),
('01960961-b8db-7313-a695-cf76a3272473', 'Iphone 12', 20000000.00, 'Là iphone 12', 'A15', 8, '512GB', 'OLED', 5000, 0, '0196094a-3841-7011-82bb-8c31665581b8'),
('01960a34-49d2-701b-9a27-329968503870', 'SamSung', 28738732.00, 'dsvsdvsdv', 'a15', 16, '512GB', '15.6', 5000, 1, '0196094a-53bc-719d-945a-f0e8ec78e766'),
('01960a34-9e42-716f-baec-6380a70d2ab6', 'SamSung s102', 28738732.00, 'dsvsdvsdv', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53bc-719d-945a-f0e8ec78e766'),
('01960a34-df1a-73df-8713-b522bc0ec107', 'SamSung s103383', 28738732.00, 'dsvsdvsdv', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53bc-719d-945a-f0e8ec78e766'),
('01960a3a-8998-706e-9ff1-fae060ec83a2', 'SamSungdvsvsd', 3202.00, 'dvdsv', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53be-72a4-acf2-e2707a3d7c9e'),
('01960a3a-e377-73e3-84e8-f0928488e494', 'SamSungdvsvsd', 3202.00, 'dvdsv', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53be-72a4-acf2-e2707a3d7c9e'),
('01960a3b-94a8-730d-a998-bddac8798fc7', 'SamSungdvsvsd', 3298.00, 'vdlvlknfdb', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53bf-70e3-b2b8-d08c6c6f15fe'),
('01960a3c-6bc7-739d-8331-e614d2a66f0f', 'SamSungdvsvsd', 2.00, 'dsvsdvds', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53bf-70e3-b2b8-d08c6c6f15fe'),
('01960a3d-1bc8-7219-819f-ccbfbf6d0818', 'SamSungdvsvsd', 2.00, 'dsvdsv', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53bf-70e3-b2b8-d08c6c6f15fe'),
('01960a3e-3331-70dd-a6ee-689218e77454', 'SamSungdvsvsd', 2.00, 'sdvsdv', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53bf-70e3-b2b8-d08c6c6f15fe'),
('01960a3e-401b-71b4-b34f-5c148e3129ff', 'SamSungdvsvsd', 2.00, 'sdvsdv', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53bf-70e3-b2b8-d08c6c6f15fe'),
('01960a3e-6345-7263-b8b4-99447c31b84a', 'SamSungdvsvsd', 2.00, 'sdvsdv', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53bf-70e3-b2b8-d08c6c6f15fe'),
('01960a3e-a45f-7242-aa96-f50d6627b03a', 'SamSungdvsvsd', 2.00, 'sdvsdv', 'a15', 16, '512GB', '15.6', 5000, 0, '0196094a-53bf-70e3-b2b8-d08c6c6f15fe'),
('38670b2d-129e-11f0-af78-088fc301590c', 'iPhone 15 Pro Max', 1299.99, 'Flagship iPhone with top features', 'A17 Pro', 8, '256GB', '6.7-inch OLED', 4323, 0, '0196094a-3841-7011-82bb-8c31665581b8');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` char(36) NOT NULL,
  `content` varchar(255) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `userId` char(36) NOT NULL,
  `productId` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `roleId` char(36) NOT NULL,
  `roleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
('0195e076-78d9-70c5-8397-7f782fafbb45', 'Admin'),
('0195e076-78e1-73e2-a9cb-fb3e57bda97d', 'User');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `userId` char(36) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `roleId` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`userId`, `userName`, `email`, `password`, `phoneNumber`, `address`, `isDeleted`, `roleId`) VALUES
('0195e076-79b1-73c0-a404-2fa8d164d35f', 'admin', 'admin@gmail.com', '$2y$12$ir2RgKZAVMbV0OkUGPuUMOvAGEnVh3yZL9yUQRbagrATreZ6.WhjS', '0999999999', '', 0, '0195e076-78d9-70c5-8397-7f782fafbb45'),
('01960973-d5a2-7290-a4d9-bd390ae20146', 'User3', 'user3@gmail.com', '$2y$12$G6bCA5Mf8vrN0me841mf..5Rew/00gKWBTUwVZ5jtu.4sNTkRQhd2', '0123456889', '', 0, '0195e076-78e1-73e2-a9cb-fb3e57bda97d'),
('01960978-8fce-727b-a523-4fedf56f2d02', 'User0101', 'User0101@gmail.com', '$2y$12$EocKbJwSwBDAuT28rAHHLuSkQBIYfozu4En8if5OzcAtucTDIUKwe', '0912120099', '', 0, '0195e076-78e1-73e2-a9cb-fb3e57bda97d'),
('01960979-2666-7224-bcb9-349b228c39d8', 'User0101983832', 'User0101983832@gmail.com', '$2y$12$1qxT1WpeElwTm6PMgwey7eBfzxPqyz1.LmI5s0gOTDBHFNaFIdYDa', '0935200403', '', 0, '0195e076-78e1-73e2-a9cb-fb3e57bda97d'),
('019609e2-3a10-716f-858a-ff6828f9abf2', 'User05', 'User05@gmail.com', '$2y$12$kjQWOeciaL7urBLv41n/we5WbFodWaqjJOkbqQo3DNOFk6LHeW6LW', '0987654321', '', 0, '0195e076-78e1-73e2-a9cb-fb3e57bda97d');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandId`);

--
-- Chỉ mục cho bảng `image_products`
--
ALTER TABLE `image_products`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `image_products_productid_foreign` (`productId`);

--
-- Chỉ mục cho bảng `like_list`
--
ALTER TABLE `like_list`
  ADD PRIMARY KEY (`userId`,`productId`),
  ADD KEY `like_list_productid_foreign` (`productId`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `orders_userid_foreign` (`userId`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orderId`,`productId`),
  ADD KEY `order_details_productid_foreign` (`productId`);

--
-- Chỉ mục cho bảng `previews`
--
ALTER TABLE `previews`
  ADD PRIMARY KEY (`previewId`),
  ADD KEY `previews_userid_foreign` (`userId`),
  ADD KEY `previews_productid_foreign` (`productId`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `products_brandid_foreign` (`brandId`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `reviews_userid_foreign` (`userId`),
  ADD KEY `reviews_productid_foreign` (`productId`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `users_username_unique` (`userName`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`phoneNumber`),
  ADD KEY `users_roleid_foreign` (`roleId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `image_products`
--
ALTER TABLE `image_products`
  ADD CONSTRAINT `image_products_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `like_list`
--
ALTER TABLE `like_list`
  ADD CONSTRAINT `like_list_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_list_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_orderid_foreign` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `previews`
--
ALTER TABLE `previews`
  ADD CONSTRAINT `previews_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`),
  ADD CONSTRAINT `previews_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brandid_foreign` FOREIGN KEY (`brandId`) REFERENCES `brands` (`brandId`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roleid_foreign` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
