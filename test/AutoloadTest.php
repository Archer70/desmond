<?php
namespace Desmond\test;
use PHPUnit\Framework\TestCase;
use Desmond\Autoload;

class AutoloadTest extends TestCase
{
    use \Desmond\test\helpers\RunnerTrait;

    public function tearDown()
    {
        Autoload::reset();
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists('Desmond\Autoload'));
    }

    public function testRegistersAutoloader()
    {
        $this->resultOf('(autoload (lambda [symbol] nil))');
        $this->assertNotEmpty(Autoload::getLoadFunctions());
    }

    public function testSymbolRunsLoaderFunctions()
    {
        $code = '
            (do
                (autoload (lambda [symbol] (print symbol)))
                my-space/should-print
            )';
        $this->expectOutputString('my-space/should-print');
        $this->resultOf($code);
    }

    public function testAutoloadsFile()
    {
        $code = '
            (do
                (load-file "' . __DIR__ . '/desmond_files/autoload/autoload.dsmnd")
                core/main/my-symbol
            )';
        $this->assertEquals('yeah', $this->valueOf($code));
    }
}
