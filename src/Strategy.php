<?php

namespace PatternSample;

interface Strategy {
    function setResult(Result $result) : static;
    function execute() : Result;
}