<?php
declare(strict_types = 1);
namespace Vjvq\Importacao\Convenios;

use Vjvq\Importacao\Convenios\Models\ConvenioModel;
use Vjvq\Importacao\Convenios\Repositorios\RepositorioConvenios;

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
        $url = 'http://api.convenios.gov.br/siconv/v1/consulta/convenios.json?offset=' . $offset;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $programas = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($info['http_code'] == 0) {
            return false;
        }
        return json_decode($programas);
    }

    public function save()
    {
        $totalRegistros = 0;
        $offset = 0;
        $mConvenio = new ConvenioModel();
        $mConvenio = $mConvenio->query();
        $mConvenio->delete();

        do {

            $convenios = $this->getJson($offset);
            if (count($convenios->convenios) != 0) {
                if ($totalRegistros == 0) {
                    $totalRegistros = $convenios->metadados->total_registros;
                }
                foreach ($convenios->convenios as $c) {
                    $this->rConvenios->save(self::tratarVariaveis($c));
                }
                $offset = 500;
            }


        } while ($totalRegistros > $offset);

        return true;
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
