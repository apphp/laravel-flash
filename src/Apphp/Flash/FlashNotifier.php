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
     * @param  bool  $important
     * @return $this
     */
    public function primary($message = null, $important = false)
    {
        return $this->message($message, 'primary', $important);
    }

    /**
     * Return a secondary message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    public function secondary($message = null, $important = false)
    {
        return $this->message($message, 'secondary', $important);
    }

    /**
     * Return a success message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    public function success($message = null, $important = false)
    {
        return $this->message($message, 'success', $important);
    }

    /**
     * Return an error message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    public function error($message = null, $important = false)
    {
        return $this->danger($message, $important);
    }

    /**
     * Return an error message
     * Alias to error()
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    public function danger($message = null, $important = false)
    {
        return $this->message($message, 'danger', $important);
    }

    /**
     * Return a warning message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    public function warning($message = null, $important = false)
    {
        return $this->message($message, 'warning', $important);
    }

    /**
     * Return an information message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    public function info($message = null, $important = false)
    {
        return $this->message($message, 'info', $important);
    }

    /**
     * Return a simple light message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    public function light($message = null, $important = false)
    {
        return $this->message($message, 'light', $important);
    }

    /**
     * Save a message
     *
     * @param  string|null  $message
     * @param  string|null  $level
     * @param  bool  $important
     * @return $this
     */
    public function message($message = null, $level = null, $important = false)
    {
        if ( ! $message instanceof Message) {
            $message = new Message(compact('message', 'level'));
        }

        $this->messages->push($message);

        if ($important) {
            $this->important();
        }

        return $this->flash();
    }

    /**
     * Change flash to be important
     *
     * @return $this
     */
    public function important()
    {
        return $this->updateLastMessage(['important' => true]);
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
