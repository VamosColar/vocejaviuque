<?php
namespace Vjvq\Importacao\Programas\Repositorios;

use Vjvq\Importacao\Programas\Models\ProgramasModel;

class RepositorioProgramas
{
    protected $fields = [
        'cod_programa_siconv',
        'data_fim_emenda_parlamentar',
        'href',
        'data_inicio_recebimento_propostas',
        'acao_orcamentaria',
        'id',
        'data_inicio_emenda_parlamentar',
        'nome',
        'convenios',
        'data_inicio_beneficiario_especifico',
        'data_publicacao_dou',
        'descricao',
        'atende_a',
        'ufs_habilitadas',
        'data_fim_beneficiario_especifico',
        'situacao',
        'data_disponibilizacao',
        'propostas',
        'aceita_emenda_parlamentar',
        'orgao_mandatario',
        'orgao_executor',
        'emendas',
        'obriga_plano_trabalho',
        'data_fim_recebimento_propostas',
        'orgao_vinculado',
        'orgao_superior'
    ];

    protected $programas;

    public function __construct(ProgramasModel $model)
    {
        $this->programas = $model;
    }

    public function save(array $input)
    {
        $this->programas = new ProgramasModel();
        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->programas->$field = $input[$field];
            }
        }
        $this->programas->save();
        return $this->programas;
    }
}
