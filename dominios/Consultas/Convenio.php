<?php
namespace Vjvq\Consultas;

use Vjvq\Importacao\Convenios\Models\ConvenioModel;
use Vjvq\Importacao\Convenios\Repositorios\RepositorioConvenios;

class Convenio
{
    protected $rConvenio;

    public function __construct()
    {
        $this->rConvenio = new RepositorioConvenios(new ConvenioModel());
    }

    public function all(array $input)
    {
        $convenios = $this->rConvenio->getWhere($input);

        if (count($convenios) == 0) {
            throw new \Exception('Não existem convênios cadastrados para os filtros informados');
        }

        $dados = [
            'itens' => [],
            'total' => count($convenios)
        ];

        foreach ($convenios as $c) {
            $dados['itens'][] = $this->tratarCampos($c);
        }

        if (isset($input['pagination'])) {
            $dados['total'] = $convenios->total();
        }

        return $dados;
    }

    protected function tratarCampos(ConvenioModel $c)
    {
        return [
            'id' => $c->_id,
            'idConvenio' => $c->id,
            'idOrgaoConcedente' => $c->orgao_concedente,
            'idProponente' => $c->proponente,
            'idSituacao' => $c->situacao,
            'href' => $c->href,
            'dataAssinatura' => (!is_null($c->data_assinatura) && $c->data_assinatura != '') ? date('d/m/Y', strtotime($c->data_assinatura)) : null,
            'dataPublicacao' => (!is_null($c->data_publicacao) && $c->data_publicacao != '') ? date('d/m/Y', strtotime($c->data_publicacao)) : null,
            'dataInicioVigencia' => (!is_null($c->data_inicio_vigencia) && $c->data_inicio_vigencia != '') ? date('d/m/Y', strtotime($c->data_inicio_vigencia)) : null,
            'dataFimVigencia' => (!is_null($c->data_fim_vigencia) && $c->data_fim_vigencia != '') ? date('d/m/Y', strtotime($c->data_fim_vigencia)) : null,
            'valorGlobal' => $c->valor_global,
            'valorGlobalBr' => $c->valor_global_br,
            'valorContrapartida' => $c->valor_contra_partida,
            'valorContrapartidaBr' => $c->valor_contra_partida_br,
            'valorRepasse' => $c->valor_repasse,
            'valorRepasseBr' => $c->valor_repasse_br,
            'modalidade' => $c->modalidade,
            'objetoResumidp' => $c->objeto_resumido,
            'justificativaResumida' => $c->justificativa_resumida,
            'criadoEm' => $c->criadoEm,
            'atualizadoEm' => $c->atualizadoEm
        ];
    }
}
