<?php
namespace Vjvq\Convenios\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ConvenioModel extends Model
{
    protected $collection = 'convenio';

    public function getValorGlobalBrAttribute()
    {
        return number_format($this->attributes['valor_global'], 2, ',', '');
    }

    public function getValorContrapartidaBrAttribute()
    {
        return number_format($this->attributes['valor_contra_partida'], 2, ',', '');
    }

    public function getValorRepasseBrAttribute()
    {
        return number_format($this->attributes['valor_repasse'], 2, ',', '');
    }
}
