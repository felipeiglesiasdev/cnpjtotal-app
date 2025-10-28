-- PORTAL --------------------------------------------------------------------------------
-- TOP 10 CIDADES 
CREATE INDEX idx_estab_sit_mun_uf ON estabelecimentos (situacao_cadastral, municipio, uf);

-- TOP 10 ESTADOS
CREATE INDEX idx_estab_sit_uf ON estabelecimentos (situacao_cadastral, uf);

-- FECHAMENTOS PORTAL
CREATE INDEX idx_estab_sit_data_uf ON estabelecimentos (situacao_cadastral, data_situacao_cadastral, uf);


-- TOP 10 ATIVIDADES
CREATE INDEX idx_estab_sit_cnae_fiscal_principal ON estabelecimentos (situacao_cadastral, cnae_fiscal_principal);


-- STATS ABERTAS E FECHADAS
CREATE INDEX idx_estab_sit_data ON estabelecimentos (situacao_cadastral, data_situacao_cadastral);
CREATE INDEX idx_estab_data_inicio ON estabelecimentos (data_inicio_atividade);
-----------------------------------------------------------------------------------------


-- KPIs por UF e situacao
CREATE INDEX idx_estab_uf_sit ON estabelecimentos(uf, situacao_cadastral);

CREATE INDEX idx_estab_uf_sit_identificador_matriz_filial ON estabelecimentos(uf, situacao_cadastral, identificador_matriz_filial);

-- Datas
CREATE INDEX idx_estab_uf_data_inicio ON estabelecimentos(uf, data_inicio_atividade);


CREATE INDEX idx_estab_uf_sit_data ON estabelecimentos(uf, situacao_cadastral, data_situacao_cadastral);
CREATE INDEX idx_estab_uf_sit_cnae ON estabelecimentos(uf, situacao_cadastral, cnae_fiscal_principal);
CREATE INDEX idx_estab_uf_sit_municipio ON estabelecimentos(uf, situacao_cadastral, municipio);


CREATE INDEX idx_estab_uf_sit_mun_cep ON estabelecimentos(uf, situacao_cadastral, municipio, cep);


-----------------------------------------------------------------------------------------
CREATE INDEX idx_estab_municipio_uf ON estabelecimentos(municipio, uf);


CREATE INDEX idx_estab_cep_sit ON estabelecimentos(cep, situacao_cadastral);
