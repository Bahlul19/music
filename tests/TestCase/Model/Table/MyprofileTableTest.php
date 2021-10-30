<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MyprofileTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MyprofileTable Test Case
 */
class MyprofileTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MyprofileTable
     */
    public $Myprofile;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Myprofile',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Myprofile') ? [] : ['className' => MyprofileTable::class];
        $this->Myprofile = TableRegistry::getTableLocator()->get('Myprofile', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Myprofile);

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
