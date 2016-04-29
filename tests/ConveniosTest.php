<?php
namespace tests;

use Vjvq\Consultas\Convenio;
use Vjvq\Importacao\Convenios\Convenios;

class ConveniosTest extends \TestCase
{
    /**
     * @group Convenios
     */
    public function testObterCoveniosComPaginacao()
    {
        $nConvenios = new Convenio();
        $convenios = $nConvenios->all(['pagination' => 10]);
        
        $this->assertCount(10, $convenios['itens']);
    }

    /**
     * @group Convenios
     */
    public function testObterConveniosSemPaginacao()
    {
        $nConvenios = new Convenio();
        $convenios = $nConvenios->all([]);

        $this->assertCount($convenios['total'], $convenios['itens']);
    }

    /**
     * @group Convenios
     * @expectedException \Exception
     * @expectedExceptionMessage Deve ser informado um valor para a paginação
     */
    public function testObterConveniosComPaginacaoVazia()
    {
        $nConvenios = new Convenio();
        $nConvenios->all(['pagination' => '']);
    }
}
