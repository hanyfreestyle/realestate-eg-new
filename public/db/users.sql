SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `sales`, `team_leader`, `user_team`, `user_follow`, `is_active`, `is_archived`, `avatar_url`, `theme`, `theme_color`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Hany Darwish', 'admin@admin.com', '01221563252', '2025-03-10 22:56:48', '$2y$12$kIJN/fQOvCb8P5.fhYbsj.fnZ/3oXNqoD/076p8IhBpWZDDaR2P8S', '0', '0', NULL, NULL, '1', '0', 'admin-profile/jTiVutJFHKTRxZHC3vcyLTfF8pkXtyfCLSC5BXzJ.webp', 'default', NULL, NULL, '2025-03-05 01:56:49', '2025-03-10 14:12:38'),
('2', 'Eslam Darwish', 'eslam@eslam.com', '012 21563253', NULL, '$2y$12$KEhnXlGGXO6kFDhnfTcOIuiCZpHvqwMS0Sls/xeHYYycVU6.BeAZu', '0', '0', NULL, NULL, '1', '0', NULL, 'default', NULL, 'extJPZHpQKCc8h9AzjNEUl6HaQn7gZrfRBC7ZjukObtMaiNwONtt66BKxGDc', '2025-03-10 20:48:46', '2025-03-10 21:13:21');
COMMIT;
