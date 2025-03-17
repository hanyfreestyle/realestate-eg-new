SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `sales`, `team_leader`, `user_team`, `user_follow`, `is_active`, `is_archived`, `avatar_url`, `theme`, `theme_color`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Hany Darwish', 'admin@admin.com', NULL, '2025-03-17 20:00:16', '$2y$12$o52HGey88oq8O9D4azoUwOClsPf6GT1.T8VYlK2ET4X9buVYGSBfa', '0', '0', NULL, NULL, '1', '0', NULL, 'default', NULL, 'USuEbBpW8U', '2025-03-17 20:00:17', '2025-03-17 20:00:17');
COMMIT;
