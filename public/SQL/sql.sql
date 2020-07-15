INSERT INTO `access` (`id`, `access`, `active`, `created_at`, `updated_at`) VALUES
(NULL, 'ADMINISTRADOR', 'Y', '2020-07-11 22:09:46', '2020-07-11 22:09:46'),
(NULL, 'TATUADOR', 'Y', '2020-07-11 22:09:46', '2020-07-11 22:09:46'),
(NULL, 'ATENDENTE', 'Y', '2020-07-11 22:09:46', '2020-07-11 22:09:46');

INSERT INTO `type_phones` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES 
(NULL, 'Principal', 'Y', '2020-07-14 22:18:59', '2020-07-14 22:18:59'), 
(NULL, 'Contato', 'Y', '2020-07-14 22:18:59', '2020-07-14 22:18:59');

INSERT INTO `offices` (`id`, `access_id`, `description`, `active`, `created_at`, `updated_at`) VALUES 
(NULL, '1', 'Administrador', 'Y', '2020-07-15 00:00:39', '2020-07-15 00:00:39'), 
(NULL, '2', 'Tatuador', 'Y', '2020-07-15 00:00:39', '2020-07-15 00:00:39');