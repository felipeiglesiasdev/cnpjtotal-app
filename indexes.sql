CREATE INDEX idx_estab_uf_municipio_situacao_cep ON estabelecimentos(uf, municipio, situacao_cadastral, cep);
CREATE INDEX idx_estab_cep_uf_municipio_situacao ON estabelecimentos(cep, uf, municipio, situacao_cadastral);
CREATE INDEX idx_empresas_cnpj_basico_natureza_juridica ON empresas (cnpj_basico, natureza_juridica);
CREATE INDEX idx_estab_uf_situacao_municipio ON estabelecimentos(uf, situacao_cadastral, municipio);
CREATE INDEX idx_estab_uf_situacao_cadastral_cnpj ON estabelecimentos (uf, situacao_cadastral, cnpj_basico);

-- CRIANDO ÍNDICES
CREATE INDEX idx_estab_uf_situacao_data_situacao ON estabelecimentos (uf, situacao_cadastral, data_situacao_cadastral);
SELECT 
    SUM(situacao_cadastral = 2) AS total_ativas,
    SUM(situacao_cadastral = 2 AND identificador_matriz_filial = 1) AS total_matrizes,
    SUM(situacao_cadastral = 2 AND identificador_matriz_filial = 2) AS total_filiais,
    SUM(data_inicio_atividade BETWEEN '2025-01-01' AND '2025-12-31') AS abertas_2025_parcial,
    SUM(situacao_cadastral != 2 AND data_situacao_cadastral BETWEEN '2025-01-01' AND '2025-12-31') AS fechadas_2025_parcial
FROM estabelecimentos
WHERE uf = 'SEU_UF_AQUI';

-- PASOU NO TESTE
SELECT 
    estabelecimentos.cnae_fiscal_principal as codigo,
    cnaes.descricao,
    COUNT(*) as total_estabelecimentos
FROM estabelecimentos 
INNER JOIN cnaes ON estabelecimentos.cnae_fiscal_principal = cnaes.codigo
WHERE estabelecimentos.uf = 'SP' 
    AND estabelecimentos.situacao_cadastral = 2
GROUP BY estabelecimentos.cnae_fiscal_principal, cnaes.descricao
ORDER BY total_estabelecimentos DESC
LIMIT 7;


