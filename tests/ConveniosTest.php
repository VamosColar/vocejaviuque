<?php
namespace tests;

use Vjvq\Convenios\Convenios;

class ConveniosTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @group Convenios
     */
    public function testJson()
    {
        $convenios = new Convenios();
        $jsonConvenios = $convenios->showValoresJson();
        $this->assertCount(3, $jsonConvenios);
    }
}