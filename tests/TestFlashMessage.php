<?php

namespace Apphp\Flash\Test;

use Apphp\Flash\Flash;


class TestFlashMessage extends TestCase
{
    public function testNew(): void
    {
        $this->assertEquals(1, 1);
        $this->assertNotEquals('aaa', 'bbb');
    }

    /** @test */
    public function has_a_levels_method(): void
    {
        $alert = Flash::info('asdfasfd');

        $this->assertEquals($alert->messages[0]->level, 'info');
        $this->assertEquals($alert->messages[0]->message, 'asdfasfd');
    }

}
