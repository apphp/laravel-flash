<?php

namespace Apphp\Flash;

use Apphp\Flash\SessionFlashStore;
use Illuminate\Support\Traits\Macroable;


class FlashNotifier
{
    use Macroable;

    /**
     * Store data in session
     *
     * @var SessionFlashStore
     */
    protected $session;

    /**
     * Collection of messages
     *
     * @var \Illuminate\Support\Collection
     */
    public $messages;

    /**
     * Constructor - creates a new instance
     *
     * @param  SessionFlashStore  $session
     */
    function __construct(SessionFlashStore $session)
    {
        $this->session  = $session;
        $this->messages = collect();
    }

    /**
     * Return a primary message
     *
     * @param  string|null  $message
     * @return $this
     */
    public function primary($message = null)
    {
        return $this->message($message, 'primary');
    }

    /**
     * Return a secondary message
     *
     * @param  string|null  $message
     * @return $this
     */
    public function secondary($message = null)
    {
        return $this->message($message, 'secondary');
    }

    /**
     * Return a success message
     *
     * @param  string|null  $message
     * @return $this
     */
    public function success($message = null)
    {
        return $this->message($message, 'success');
    }

    /**
     * Return an error message
     *
     * @param  string|null  $message
     * @return $this
     */
    public function error($message = null)
    {
        return $this->danger($message);
    }

    /**
     * Return an error message
     * Alias to error()
     *
     * @param  string|null  $message
     * @return $this
     */
    public function danger($message = null)
    {
        return $this->message($message, 'danger');
    }

    /**
     * Return a warning message
     *
     * @param  string|null  $message
     * @return $this
     */
    public function warning($message = null)
    {
        return $this->message($message, 'warning');
    }

    /**
     * Return an information message
     *
     * @param  string|null  $message
     * @return $this
     */
    public function info($message = null)
    {
        return $this->message($message, 'info');
    }


    /**
     * Save a message
     *
     * @param  string|null  $message
     * @param  string|null  $level
     * @param  bool  $button
     * @return $this
     */
    public function message($message = null, $level = null, $button = false)
    {
        if ( ! $message instanceof Message) {
            $message = new Message(compact('message', 'level'));
        }

        $this->messages->push($message);

        if ($button) {
            $this->button();
        }

        return $this->flash();
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
     *
     * @return $this
     */
    public function hide()
    {
        return $this->updateLastMessage(['hide' => true]);
    }

    /**
     * Clear all messages
     *
     * @return $this
     */
    public function clear()
    {
        $this->messages = collect();

        return $this;
    }

    /**
     * Modify the last added message with attributes
     *
     * @param  array  $overrides
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
    protected function flash()
    {
        $this->session->flash('flash_notification', $this->messages);

        return $this;
    }
}
