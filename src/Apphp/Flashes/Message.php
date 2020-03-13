<?php

namespace Apphp\Flashes;

use \ArrayAccess;

class Message implements ArrayAccess
{
    /**
     * The title of the message
     * @var string
     */
    public $title;

    /**
     * The body of the message
     * @var string
     */
    public $message;

    /**
     * The message type
     * @var string
     */
    public $level = 'info';

    /**
     * Whether this message should auto hide
     * @var bool
     */
    public $autoHide = false;

    /**
     * Whether the message is an overlay
     * @var bool
     */
    public $overlay = false;

    /**
     * Constructor - create a new message instance
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->update($attributes);
    }

    /**
     * Update message attributes
     * @param  array $attributes
     * @return $this
     */
    public function update($attributes = [])
    {
        $attributes = array_filter($attributes);

        foreach ($attributes as $key => $attribute) {
            $this->$key = $attribute;
        }

        return $this;
    }
}
