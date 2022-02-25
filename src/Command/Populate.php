<?php


namespace PatternSample\Command;

use InvalidArgumentException;
use PatternSample\Command;
use PatternSample\Strategy\PopulateStrategy;

class Populate implements Command {

    const POP_MIN = 1;
    const POP_MAX= 100;

    private int $number;

    private function __construct() { }

    public static function create(int $contentNumber = 5) : Populate {

        if( $contentNumber < self::POP_MIN || $contentNumber > self::POP_MAX ) {
            throw new InvalidArgumentException(
                sprintf("%d is not acceptable argument, number must be between %d and %d",$contentNumber, self::POP_MIN, self::POP_MAX));
        }

        $popCommand = new self();
        $popCommand->number= $contentNumber;
        return $popCommand;
    }

    public function getActualNumber( ) : int{
        return $this->number;
    }

    public function rollNumberOnParameter() : int {
        return rand( 1, $this->number);
    }

    public function getStrategy( ) {
        return PopulateStrategy::class;
    }
}