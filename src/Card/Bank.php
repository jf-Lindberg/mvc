<?php

namespace App\Card;

class Bank extends Player
{
    /** Makes a decision on whether to hit or not.
     * Returns true if the current score is 17 or above.
     *
     * @return bool
     */
    public function decidesToHit(): bool
    {
        if ($this->getHandValue() >= 17)
        {
            return false;
        }
        return true;
    }
}
