<?php

function calculateMagicNumber(float $price, float $lastDividend): int
{
    return $price / $lastDividend;
}
