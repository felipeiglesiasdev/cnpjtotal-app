-- BUSCA DE MUNICIPIOS

CREATE INDEX idx_estabelecimentos_municipio_uf ON estabelecimentos(municipio, uf);

-- BUSCA DE CEP
CREATE INDEX idx_estab_cep ON estabelecimentos(cep);
CREATE INDEX idx_estab_situacao_cep ON estabelecimentos(situacao_cadastral, cep);
CREATE INDEX idx_estab_municipio_situacao_cep ON estabelecimentos(municipio,situacao_cadastral, cep);
CREATE INDEX idx_estab_uf_municipio_situacao_cep ON estabelecimentos(uf, municipio, situacao_cadastral, cep);

-- FECHAMENTOS
CREATE INDEX idx_estab_situacao_data_uf ON estabelecimentos(situacao_cadastral, data_situacao_cadastral, uf);

-- ABERTURAS
CREATE INDEX idx_estab_data_inicio ON estabelecimentos(data_inicio_atividade);
CREATE INDEX idx_estab_situacao_cadastral_data_situacao_cadastral ON estabelecimentos (situacao_cadastral, data_situacao_cadastral);

-- TOP 10 CNAES
CREATE INDEX idx_estab_situacao_cnae_principal ON estabelecimentos(situacao_cadastral, cnae_fiscal_principal);

-- TOP 10 CIDADES E ESTADOS
CREATE INDEX idx_estab_situacao ON estabelecimentos(situacao_cadastral);



-- PÁGINA DE UFs
CREATE INDEX idx_estab_uf_situacao ON estabelecimentos(uf, situacao_cadastral);
CREATE INDEX idx_estab_uf_situacao_identificador_matriz_filial ON estabelecimentos(uf, situacao_cadastral, identificador_matriz_filial);
CREATE INDEX idx_estab_uf_data_inicio_atividade ON estabelecimentos (uf, data_inicio_atividade);
CREATE INDEX idx_estab_uf_situacao_cadastral_data_situacao_cadastral ON estabelecimentos (uf, situacao_cadastral, data_situacao_cadastral);
CREATE INDEX idx_estab_uf_situacao_cnae_principal ON estabelecimentos(uf, situacao_cadastral, cnae_fiscal_principal);

-- PÁGINA CNPJ
CREATE INDEX idx_estab_municipio_situacao_cnae_principal_cnpj_basico ON estabelecimentos(municipio, situacao_cadastral, cnae_fiscal_principal, cnpj_basico);
CREATE INDEX idx_estab_uf_situacao_cnae_principal_cnpj_basico ON estabelecimentos(uf, situacao_cadastral, cnae_fiscal_principal, cnpj_basico);


CREATE INDEX idx_estab_situacao_municipio_uf ON estabelecimentos(situacao_cadastral, municipio, uf);

