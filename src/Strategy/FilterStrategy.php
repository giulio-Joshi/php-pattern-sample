<?php

namespace PatternSample\Strategy;

use PatternSample\Result;
use PatternSample\ResultLazyHandler;
use PatternSample\Strategy;

class FilterStrategy implements Strategy {
    use ResultLazyHandler;

    const PRECENT_OF_KEEPING=50;

    public function execute() : Result {
     
        $oldResult = $this->getResult();
        $temp_container = [];
        
        foreach($oldResult->getContent() as $idx => $item){

            if( mt_rand(1,100 ) > self::PRECENT_OF_KEEPING ) {
                continue;
            }
            
            $temp_container[]= [ $item , $oldResult->getClassification($idx)];
        }

        $newResult = new Result();
        foreach( $temp_container as $stuff){
            $newResult->addContent( $stuff[0], $stuff[1]);
        }
        $this->setResult($newResult);

        return $newResult;
    

    }

}