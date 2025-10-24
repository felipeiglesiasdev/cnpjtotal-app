CREATE INDEX idx_estab_uf_municipio_situacao_cep ON estabelecimentos(uf, municipio, situacao_cadastral, cep);
CREATE INDEX idx_estab_cep_uf_municipio_situacao ON estabelecimentos(cep, uf, municipio, situacao_cadastral);
CREATE INDEX idx_empresas_cnpj_basico_natureza_juridica ON empresas (cnpj_basico, natureza_juridica);
CREATE INDEX idx_estab_uf_situacao_municipio ON estabelecimentos(uf, situacao_cadastral, municipio);
CREATE INDEX idx_estab_uf_situacao_cadastral_cnpj ON estabelecimentos (uf, situacao_cadastral, cnpj_basico);


CREATE INDEX idx_estab_situacao_cadastral_municipio ON estabelecimentos (situacao_cadastral, municipio);
CREATE INDEX idx_estab_situacao_cadastral_data_situacao_cadastral ON estabelecimentos (situacao_cadastral, data_situacao_cadastral);



