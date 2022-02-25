<?php

namespace PatternSample;

use PatternSample\ResultLazyHandler;

class Factory {
    use ResultLazyHandler;

    public function craftFromCommand(Command $command) : Strategy {

        $strategyName = $command->getStrategy();

        /** @var Strategy $strategy */
        $strategy = new $strategyName($command);
        $strategy->setResult($this->getResult());
        return $strategy;
    }

}