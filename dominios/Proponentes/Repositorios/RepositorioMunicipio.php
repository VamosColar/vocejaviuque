<?php
namespace Vjvq\Proponentes\Repositorios;

use Vjvq\Proponentes\Models\MunicipioModel;

class RepositorioMunicipio
{
    protected $fields = [
        'nome',
        'cod_siconv',
        'href',
        'proponentes',
        'uf',
        'id'
    ];

    protected $municipios;

    public function __construct(MunicipioModel $municipioModel)
    {
        $this->municipios = $municipioModel;
    }

    public function save(array $input)
    {
        $this->municipios = new MunicipioModel();

        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->municipios->$field = $input[$field];
            }
            $this->municipios->save();
        }

        return true;
    }
}
