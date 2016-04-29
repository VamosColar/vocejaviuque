<?php
declare(strict_types = 1);
namespace Vjvq\Importacao\Proponentes;

use Vjvq\Importacao\Proponentes\Models\ProponentesModel;
use Vjvq\Importacao\Proponentes\Repositorios\RepositorioProponente;

class Proponentes
{
    protected $rProponentes;

    public function __construct()
    {
        $this->rProponentes = new RepositorioProponente(new ProponentesModel());
    }

    public function save(int $municipio)
    {
        $totalRegistros = 0;
        $offset = 0;

        do {

            $proponentes = self::getJson($municipio, $offset);
            if (!$proponentes) {
                return false;
            }
            if (isset($proponentes->metadados->total_registros) && $totalRegistros == 0) {
                $totalRegistros = $proponentes->metadados->total_registros;
            }
            if (!is_null($proponentes)) {
                foreach ($proponentes->proponentes as $proponente) {
                    $this->rProponentes->save((array)$proponente);
                }
            }
            $offset = 500;

        } while ($totalRegistros > $offset);

        return true;
    }

    protected function getJson(int $municipio, int $offset)
    {
        $ch = curl_init();
        $url = 'http://api.convenios.gov.br/siconv/v1/consulta/proponentes.json?id_municipio=' . $municipio . '&offset=' . $offset;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $proponentes = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($info['http_code'] == 0) {
            return false;
        }
        return json_decode($proponentes);
    }
}
