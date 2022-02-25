<?php

namespace PatternSample;


trait ResultLazyHandler {

    private Result $result;

    public function getResult() : Result {
        $this->result = $this->result?? new Result();
        return $this->result;
    }

    public function setResult(Result $result) : static {
        $this->result = $result;
        return $this;
    }

}