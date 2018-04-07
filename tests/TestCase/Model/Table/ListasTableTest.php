<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ListasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ListasTable Test Case
 */
class ListasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ListasTable
     */
    public $Listas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.listas',
        'app.items',
        'app.items_listas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Listas') ? [] : ['className' => ListasTable::class];
        $this->Listas = TableRegistry::get('Listas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Listas);

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
}
