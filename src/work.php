<?php

require_once __DIR__.'/../vendor/autoload.php';

use PatternSample\Command\Filter;
use PatternSample\Command\Populate;
use PatternSample\Command\Scramble;
use PatternSample\Factory;

$arguments  = getopt('p:sf:',['help']);

if ( isset($arguments['help'])){
    echo <<<EOD
    php work.php [-pN] [-s] [-fN]

    -pN Populate result with N elements semi-random elements. optional.
            takes 16 elements as default if not specified

    -s Scramble: they get mixed togheter 

    -fN Filtered: a questionable method will chop off part of the result.

EOD;
    exit();
}

try {

    $worker = new Factory();
    /** @var Command[] $commandStack */
    $commandStack= [];
    $commandStack[] = Populate::create( $arguments['p'] ?? 16 );

    if(isset( $arguments['s'] )) {
        $commandStack[]=new Scramble();
    }

    if( isset($arguments['f'])) {
        $commandStack[]=new Filter();
    }

    $ccounter =0 ;
    foreach ( $commandStack as $cmd) {

        printf("Step %d, command %s".PHP_EOL, ++$ccounter,   $cmd::class   );

        $result = $worker->craftFromCommand($cmd)
                    ->execute();


        printf("Results items %d ".PHP_EOL, count( $result->getContent()) );
        echo $result->display();

        // override former results
        $worker->setResult($result);

    }
}
catch( Exception $e ){
    printf("Something went wrong : %s".PHP_EOL, $e->getMessage() );
}

echo "Finished".PHP_EOL;