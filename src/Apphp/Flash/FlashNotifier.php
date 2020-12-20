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
     * Collection of allowed methods
     * @var array
     */
    protected $allowedMethods = ['primary', 'secondary', 'success', 'warning', 'info', 'error', 'danger', 'light', 'dark'];


    /**
     * Constructor - creates a new instance
     *
     * @param  SessionFlashStore  $session
     */
    public function __construct(SessionFlashStore $session)
    {
        $this->session  = $session;
        $this->messages = collect();
    }

    /**
     * Magic method implementing methods overloading
     *
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name = '', $arguments = [])
    {
        if (in_array($name, $this->allowedMethods)) {

            // Return the same object without changes if no argument passed
            if (empty($arguments)) {
                return $this;
            }

            if (count($arguments) > 1) {
                return $this->$name($arguments[0], $arguments[1]);
            } else {
                return $this->$name($arguments[0]);
            }
        }
    }

    /**
     * Save a message
     *
     * @param  array|string|null  $messageContent
     * @param  string|null  $level
     * @param  bool  $important
     * @return $this
     */
    public function message($messageContent = null, $level = null, $important = false)
    {
        if ( ! $messageContent instanceof Message) {
            $title = '';
            $message = $messageContent;
            if (is_array($messageContent)) {
                $title = $messageContent[0] ?? '';
                $message = $messageContent[1] ?? '';
            }
            $messageContent = new Message(compact('title', 'message', 'level'));
        }

        $this->messages->push($messageContent);

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
     * Return a primary message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    protected function primary($message = null, $important = false)
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
    protected function secondary($message = null, $important = false)
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
    protected function success($message = null, $important = false)
    {
        return $this->message($message, 'success', $important);
    }

    /**
     * Return a warning message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    protected function warning($message = null, $important = false)
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
    protected function info($message = null, $important = false)
    {
        return $this->message($message, 'info', $important);
    }

    /**
     * Return an error message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    protected function error($message = null, $important = false)
    {
        return $this->danger($message, $important);
    }

    /**
     * Return a danger message
     * Alias to error()
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    protected function danger($message = null, $important = false)
    {
        return $this->message($message, 'danger', $important);
    }

    /**
     * Return a simple light message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    protected function light($message = null, $important = false)
    {
        return $this->message($message, 'light', $important);
    }

    /**
     * Return a simple dark message
     *
     * @param  string|null  $message
     * @param  bool  $important
     * @return $this
     */
    protected function dark($message = null, $important = false)
    {
        return $this->message($message, 'light', $important);
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
