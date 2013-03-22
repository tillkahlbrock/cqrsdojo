<?php

namespace spec\Dojo;

use PHPSpec2\ObjectBehavior;

class DatabaseAdapter extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Dojo\DatabaseAdapter');
    }
}
