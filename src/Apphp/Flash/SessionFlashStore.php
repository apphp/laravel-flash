<?php

namespace Apphp\Flash;

use Illuminate\Session\Store;


class SessionFlashStore
{
    /**
     * @var Store
     */
    private $session;

    /**
     * Create a new session store instance.
     *
     * @param  Store  $session
     */
    function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Flashes a message to the session.
     *
     * @param  string  $name
     * @param  array|object  $data
     */
    public function flash(string $name, $data)
    {
        $this->session->flash($name, $data);
    }
}
