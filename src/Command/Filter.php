<?php

namespace PatternSample\Command;

use PatternSample\Command;
use PatternSample\Strategy\FilterStrategy;

class Filter implements Command {


    public function getStrategy()
    {
        return FilterStrategy::class;
    }
}