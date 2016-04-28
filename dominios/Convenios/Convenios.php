<?php
declare(strict_types = 1);
namespace Vjvq\Convenios;

use Vjvq\Convenios\Models\ConvenioModel;
use Vjvq\Convenios\Repositorios\RepositorioConvenios;

class Convenios
{
    protected $rConvenios;

    public function __construct()
    {
        $convenios = new ConvenioModel();
        $this->rConvenios = new RepositorioConvenios($convenios);
    }

    protected function getJson(int $offset)
    {
        if ($offset == 0) {
            $convenios = file_get_contents('http://api.convenios.gov.br/siconv/v1/consulta/convenios.json');
        } else {
            $convenios = file_get_contents('http://api.convenios.gov.br/siconv/v1/consulta/convenios.json?offset=' . $offset);
        }

        return json_decode($convenios);
    }

    public function save()
    {
        $totalRegistros = 500;
        $offset = 0;
        $mConvenio = new ConvenioModel();
        $mConvenio = $mConvenio->query();
        $mConvenio->delete();

        do {

            $convenios = $this->getJson($offset);
            if (count($convenios->convenios) != 0) {
                if ($totalRegistros == 0) {
                    $totalRegistros = $convenios->metadados->totalRegistros;
                }
                foreach ($convenios->convenios as $c) {
                    $convenio = $this->rConvenios->save(self::tratarVariaveis($c));
                }
                $offset = 500;
            }


        } while ($totalRegistros > $offset);
        
        return $convenio;
    }

    protected function tratarVariaveis($convenio)
    {
        return [
            'valor_contra_partida' => $convenio->valor_contra_partida,
            'valor_repasse' => $convenio->valor_repasse,
            'data_assinatura' => $convenio->data_assinatura,
            'data_fim_vigencia' => $convenio->data_fim_vigencia,
            'orgao_concedente' => $convenio->orgao_concedente->Orgao->id,
            'href' => $convenio->href,
            'valor_global' => $convenio->valor_global,
            'proponente' => $convenio->proponente->Proponente->id,
            'data_inicio_vigencia' => $convenio->data_inicio_vigencia,
            'situacao' => $convenio->situacao->SituacaoConvenio->id,
            'data_publicacao' => $convenio->data_publicacao,
            'modalidade' => $convenio->modalidade,
            'objeto_resumido' => $convenio->objeto_resumido,
            'id' => $convenio->id,
            'justificativa_resumida' => $convenio->justificativa_resumida
        ];
    }
}