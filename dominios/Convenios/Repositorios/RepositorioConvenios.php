<?php
namespace Vjvq\Convenios\Repositorios;

use Vjvq\Convenios\Models\ConvenioModel;

class RepositorioConvenios
{
    protected $fields = [
        'valor_contra_partida',
        'valor_repasse',
        'data_assinatura',
        'data_fim_vigencia',
        'orgao_concedente',
        'href',
        'valor_global',
        'proponente',
        'data_inicio_vigencia',
        'situacao',
        'data_publicacao',
        'modalidade',
        'objeto_resumido',
        'id',
        'justificativa_resumida'
    ];

    protected $convenio;

    public function __construct(ConvenioModel $convenioModel)
    {
        $this->convenio = $convenioModel;
    }

    public function save(array $input)
    {
        $this->convenio = new ConvenioModel();

        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->convenio->$field = $input[$field];
            }
        }

        $this->convenio->save();
        return $this->convenio;
    }
}