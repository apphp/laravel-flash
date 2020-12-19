<?php

if ( ! function_exists('flash')) {
    /**
     * Arrange for a flash messages
     *
     * @param  string|null  $message
     * @param  string  $level
     * @param  bool  $important
     * @return \Apphp\Flash\FlashNotifier
     */
    function flash($message = null, $level = 'info', $important = false)
    {
        $notifier = app('flash');

        if ($level === 'error') {
            $level = 'danger';
        }

        if ( ! is_null($message)) {
            return $notifier->message($message, $level, $important);
        }

        return $notifier;
    }
}
