<?php


namespace PatternSample\Strategy;

use PatternSample\Command;
use PatternSample\Result;
use PatternSample\ResultLazyHandler;
use PatternSample\Strategy;
use stdClass;

class PopulateStrategy implements Strategy {
    use ResultLazyHandler;

    private Command\Populate $command;

    const validNames= [ "mochi" , "aringa", "superbip","traballa", "est" , "cavatappi" , "serpente", "carotino"];


    public function __construct(Command\Populate $command)
    {
        $this->command = $command;
    }

    public function execute( ) : Result {

        $theResult = $this->getResult();

        for ( $x = $this->command->getActualNumber(); $x--; $x >0 ){

            $vName0 = rand(0, count(self::validNames)-1);
            $vName1 = rand(0, count(self::validNames)-1);

            $stuff = new stdClass();
            $stuff->{'catalog'} = sprintf("%s %s", ucfirst(self::validNames[$vName0]), self::validNames[$vName1]);
            $stuff->{'highness_factor'} = strlen($stuff->{'catalog'}) * 0.66;

            $classification = [ 'origin'=> self::class, 
                'validation' => 'crappy', 
                'serial' => $this->command->rollNumberOnParameter()];

            $theResult->addContent( $stuff, $classification);
        }
    

        return $theResult;
    }
}