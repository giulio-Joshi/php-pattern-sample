<?php

namespace PatternSample;

use Traversable;

class Result {

    private ?string $name;
    private array $content =[];
    private array $classification=[];
    private mixed $synt;

    public function _constructor(){
        $this->synt=null;
    }

    public function setName(string $name) : static {
        $this->name=$name;
        return $this;
    }

    public function addContent(mixed $stuff, array $classification)  : static {
        array_push($this->content, $stuff);
        $this->classification[array_key_last($this->content)] = $classification;
        return $this;
    }

    public function getContent() : iterable {
        return $this->content;
    }

    public function getClassification($index) : mixed {
        return $this->classification[$index] ?? null;
    }

    public function display() : string
    {
        //return sprintf( "%s" );
        $buffer="";
        foreach( $this->getContent() as $idx => $item){
            $buffer.=sprintf( "%s - serial#%d".PHP_EOL,
                     strtr( var_export($item, true),["\n"=>"", "\r"=> "" ]), 
                    $this->getClassification($idx)['serial']??'None');
        }
        return $buffer;
    }

}

