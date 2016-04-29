<?php
namespace Vjvq\Proponentes\Repositorios;

use Vjvq\Proponentes\Models\ProponentesModel;

class RepositorioProponente
{
    protected $fields = [
        'cnpj',
        'fax',
        'convenios',
        'cpf_responsavel',
        'empenhos',
        'nome',
        'inscricao_estadual',
        'esfera_administrativa',
        'inscricao_municipal',
        'propostas',
        'habilitacoes',
        'href',
        'nome_responsavel',
        'natureza_juridica',
        'telefone',
        'cep',
        'endereco',
        'pessoa_responsavel',
        'id',
        'municipio'
    ];
    protected $proponentes;

    public function __construct(ProponentesModel $proponentesModel)
    {
        $this->proponentes = $proponentesModel;
    }

    public function save(array $input)
    {
        $this->proponentes = new ProponentesModel();
        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->proponentes->$field = $input[$field];
            }
        }
        $this->proponentes->save();
        return $this->proponentes;
    }
}