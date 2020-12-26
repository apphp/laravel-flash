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

    /**
     * Remove last message from the session.
     *
     * @param  string  $name
     */
    public function remove(string $name)
    {
        $this->session->remove($name);
    }

    /**
     * Forget all message in the session.
     *
     * @param  string  $name
     */
    public function forget(string $name)
    {
        $this->session->forget($name);
    }
}
