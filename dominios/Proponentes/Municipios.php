<?php
declare(strict_types = 1);
namespace Vjvq\Proponentes;

use Vjvq\Proponentes\Models\MunicipioModel;
use Vjvq\Proponentes\Models\ProponentesModel;
use Vjvq\Proponentes\Repositorios\RepositorioMunicipio;

class Municipios
{
    protected $rMunicipios;

    public function __construct()
    {
        $this->rMunicipios = new RepositorioMunicipio(new MunicipioModel());
    }

    public function save()
    {
        $offset = 0;
        $totalRegistros = 0;
        $municipios = new MunicipioModel();
        $municipios->query()->delete();
        $proponentes = new ProponentesModel();
        $proponentes->query()->delete();

        do {

            $municipios = self::getJson($offset);
            if($totalRegistros == 0){
                $totalRegistros = $municipios->metadados->total_registros;
            }
            foreach ($municipios->municipios as $municipio) {
                $proponentes = new Proponentes();
                $resultProponentes = $proponentes->save($municipio->id);
                if(!$resultProponentes){
                    continue;
                }
                $this->rMunicipios->save((array)$municipio);
            }
            $offset = 500;

        } while($totalRegistros > $offset);

        return true;
    }

    protected function getJson(int $offset)
    {
        $ch = curl_init();
        $url = 'http://api.convenios.gov.br/siconv/v1/consulta/municipios.json?offset=' . $offset;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $municipios = curl_exec($ch);
        return json_decode($municipios);
    }

}
