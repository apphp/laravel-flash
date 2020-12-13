<?php

if ( ! function_exists('flash')) {
    /**
     * Arrange for a flash messages
     *
     * @param  string|null  $message
     * @param  string  $level
     * @param  bool  $button
     * @return \Apphp\Flash\FlashNotifier
     */
    function flash($message = null, $level = 'info', $button = false)
    {
        $notifier = app('flash');

        if ( ! is_null($message)) {
            return $notifier->message($message, $level, $button);
        }

        return $notifier;
    }
}
