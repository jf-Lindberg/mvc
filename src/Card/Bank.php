<?php

namespace App\Card;

class Bank extends Player
{
    /** Integer representing the score of the bank.
     *
     * @var int
     */
    private int $score;

    /** Makes a decision on whether to hit or not.
     * Returns true if the current score is 17 or above.
     *
     * @return bool
     */
    public function decidesToHit(): bool
    {
        if ($this->score >= 17)
        {
            return false;
        }
        return true;
    }
}
