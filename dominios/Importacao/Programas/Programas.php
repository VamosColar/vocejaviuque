<?php
declare(strict_types = 1);
namespace Vjvq\Importacao\Programas;

use Vjvq\Importacao\Programas\Models\ProgramasModel;
use Vjvq\Importacao\Programas\Repositorios\RepositorioProgramas;

class Programas
{
    protected $rProgramas;

    public function __construct()
    {
        $this->rProgramas = new RepositorioProgramas(new ProgramasModel());
    }

    public function save()
    {
        $totalRegistros = 0;
        $offset = 0;
        ProgramasModel::query()->delete();

        do {
            $programas = self::getJson($offset);
            if (!$programas) {
                continue;
            }
            if ($totalRegistros == 0) {
                $totalRegistros = $programas->metadados->total_registros;
            }
            foreach ($programas as $programa) {
                $this->rProgramas->save((array)$programa);
            }
            $offset = 500;
        } while ($totalRegistros > $offset);

        return true;
    }

    protected function getJson(int $offset)
    {
        $url = 'http://api.convenios.gov.br/siconv/v1/consulta/programas.json?offset=' . $offset;
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
}
