<?php

namespace Apphp\Flashes;

use Apphp\Flashes\SessionFlashesStore;
use Illuminate\Support\Traits\Macroable;


class FlashesNotifier
{
    use Macroable;

    /**
     * Store data in session
     * @var SessionFlashesStore
     */
    protected $session;

    /**
     * Collection of messages
     * @var \Illuminate\Support\Collection
     */
    public $messages;

    /**
     * Constructor - creates a new instance
     * @param SessionFlashesStore $session
     */
    function __construct(SessionFlashesStore $session)
    {
        $this->session = $session;
        $this->messages = collect();
    }

    /**
     * Return an information message
     * @param  string|null $message
     * @return $this
     */
    public function info($message = null)
    {
        return $this->message($message, 'info');
    }

    /**
     * Return a success message
     * @param  string|null $message
     * @return $this
     */
    public function success($message = null)
    {
        return $this->message($message, 'success');
    }

    /**
     * Return an error message
     * @param  string|null $message
     * @return $this
     */
    public function error($message = null)
    {
        return $this->message($message, 'error');
    }

    /**
     * Return a warning message
     * @param  string|null $message
     * @return $this
     */
    public function warning($message = null)
    {
        return $this->message($message, 'warning');
    }

    /**
     * Save a message
     * @param  string|null $message
     * @param  string|null $type
     * @return $this
     */
    public function message($message = null, $type = null)
    {
        if (! $message instanceof Message) {
            $message = new Message(compact('message', 'type'));
        }

        $this->messages->push($message);

        return $this->flashes();
    }

    /**
     * Add flash with a button
     *
     * @return $this
     */
    public function button()
    {
        return $this->updateLastMessage(['button' => true]);
    }

    /**
     * Add an attribute "hide" to the session
     * @return $this
     */
    public function hide()
    {
        return $this->updateLastMessage(['hide' => true]);
    }

    /**
     * Clear all messages
     * @return $this
     */
    public function clear()
    {
        $this->messages = collect();

        return $this;
    }

    /**
     * Modify the last added message with attributes
     * @param  array $overrides
     * @return $this
     */
    protected function updateLastMessage($overrides = [])
    {
        $this->messages->last()->update($overrides);

        return $this;
    }

    /**
     * Flashes all messages to the session
     */
    protected function flashes()
    {
        $this->session->flashes('flashes_notification', $this->messages);

        return $this;
    }
}
