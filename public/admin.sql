-- INSERIR O USUÁRIO ADMINISTRADOR DO SISTEMA

INSERT INTO `users` (`id`, `name`, `role`, `permission`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, 'Administrador do Sistema', 'Gerente', 'admin', 'admin@portalbnw.com', '$2y$10$6wBiocY5gAE4f1umz6kVsO1hL/SfaYXvLI1BnCF6SO230FEMd01Iq', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);