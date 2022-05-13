<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

class BankBasicTest extends TestCase
{
    /**
     * @return void
     */
    public function testDecidesToHitPositive()
    {
        $bank = new Bank(0, 15);
        $this->assertInstanceOf("\App\Card\Player", $bank);
        $this->assertInstanceOf("\App\Card\Bank", $bank);

        $res = $bank->decidesToHit();
        $this->assertTrue($res);
    }

    /**
     * @return void
     */
    public function testDecidesToHitNegative()
    {
        $bank = new Bank(0, 18);
        $this->assertInstanceOf("\App\Card\Player", $bank);
        $this->assertInstanceOf("\App\Card\Bank", $bank);

        $res = $bank->decidesToHit();
        $this->assertFalse($res);
    }
}
