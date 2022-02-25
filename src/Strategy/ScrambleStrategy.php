<?php

namespace PatternSample\Strategy;

use PatternSample\ResultLazyHandler;
use PatternSample\Strategy;
use PatternSample\Result;

class ScrambleStrategy implements Strategy {
    use ResultLazyHandler;

    public function execute() : Result {
        $oldResult = $this->getResult();
        $temp_container = [];
        foreach($oldResult->getContent() as $idx => $item){
            $temp_container[]= [ $item , $oldResult->getClassification($idx)];
        }
        shuffle( $temp_container);

        $newResult = new Result();
        foreach( $temp_container as $stuff){
            $newResult->addContent( $stuff[0], $stuff[1]);
        }
        $this->setResult($newResult);

        return $newResult;
    }
}