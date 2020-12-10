<?php

namespace Apphp\Flashes;

use Illuminate\Session\Store;


class SessionFlashesStore
{
    /**
     * @var Store
     */
    private $session;

    /**
     * Create a new session store instance.
     *
     * @param Store $session
     */
    function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Flashes a message to the session.
     *
     * @param string $name
     * @param array  $data
     */
    public function flashes($name, $data)
    {
        $this->session->flash($name, $data);
    }
}
