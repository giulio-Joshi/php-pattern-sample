<?php

namespace PatternSample\Command;

use PatternSample\Command;
use PatternSample\Strategy\ScrambleStrategy;

class Scramble implements Command {

    public function getStrategy() {
        return ScrambleStrategy::class;
    }
}