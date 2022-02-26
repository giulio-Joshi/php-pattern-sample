<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use PatternSample\Command\Populate;
use PatternSample\Command\Scramble;
use PatternSample\Factory;
use PHPUnit\Framework\TestCase;

final class CommandTest extends TestCase
{
    const POP_NUMBER= 3;

    private Factory $factory;

    protected function setUp() : void
    {
        parent::setUp();
        $this->factory = new Factory();

    }


    public function testScrambleStrategy(): void
    {
        $command = new Scramble();
        $strategy = $this->factory->craftFromCommand( $command);
        $this->assertInstanceOf( $command->getStrategy(), $strategy );
    }


    public function testPopulativeCommand() : void 
    {
        $command = Populate::create( self::POP_NUMBER );
        $strategy = $this->factory->craftFromCommand($command);
        $this->assertEquals( self::POP_NUMBER,  $command->getActualNumber() );
        $result = $strategy->execute();
        $this->assertCount( self::POP_NUMBER , $result->getContent() );
    }

    public function testExcessiveNumber() : void 
    {
        $this->expectException(InvalidArgumentException::class);
        Populate::create( Populate::POP_MAX +1);
    }

    public function testUnderflowNumber() : void 
    {
        $this->expectException(InvalidArgumentException::class);
        Populate::create( Populate::POP_MIN -1);
    }
}
