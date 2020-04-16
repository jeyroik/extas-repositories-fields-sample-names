<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use extas\components\plugins\repositories\PluginFieldSampleName;
use tests\TestEntity;

/**
 * Class PluginFieldSampleNameTest
 *
 * @author jeyroik <jeyroik@gmail.com>
 */
class PluginFieldSampleNameTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testEmpty()
    {
        $test = new TestEntity([
            TestEntity::FIELD__NAME => '',
            TestEntity::FIELD__SAMPLE_NAME => 'test'
        ]);
        $plugin = new PluginFieldSampleName();
        $plugin($test);

        $this->assertEquals('test', $test->getName());
    }

    public function testSomeString()
    {
        $test = new TestEntity([
            TestEntity::FIELD__NAME => '@sample(unknown)',
            TestEntity::FIELD__SAMPLE_NAME => 'test'
        ]);
        $plugin = new PluginFieldSampleName();
        $plugin($test);

        $this->assertEquals('test_unknown', $test->getName());
    }

    public function testUuid()
    {
        $test = new TestEntity([
            TestEntity::FIELD__NAME => '@sample(uuid6)',
            TestEntity::FIELD__SAMPLE_NAME => 'test'
        ]);
        $plugin = new PluginFieldSampleName();
        $plugin($test);

        $this->assertNotEquals('@sample(uuid6)', $test->getName());
        $nameParts = explode('_', $test->getName());
        $this->assertTrue(strlen($nameParts[1]) == 36);
    }

    public function testSha1()
    {
        $test = new TestEntity([
            TestEntity::FIELD__NAME => '@sample(sha1(test))',
            TestEntity::FIELD__SAMPLE_NAME => 'test'
        ]);
        $plugin = new PluginFieldSampleName();
        $plugin($test);

        $this->assertEquals('test_a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', $test->getName());
    }
}
