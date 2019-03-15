<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SiDatosBasicosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SiDatosBasicosTable Test Case
 */
class SiDatosBasicosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SiDatosBasicosTable
     */
    public $SiDatosBasicos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.si_datos_basicos',
        'app.statuses',
        'app.creators',
        'app.modifiers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SiDatosBasicos') ? [] : ['className' => SiDatosBasicosTable::class];
        $this->SiDatosBasicos = TableRegistry::get('SiDatosBasicos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SiDatosBasicos);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
