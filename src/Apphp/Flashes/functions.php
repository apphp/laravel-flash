<?php

if (!function_exists('flashes')) {

    /**
     * Arrange for a flashes messages
     *
     * @param string|null $message
     * @param string $level
     * @return \Apphp\Flashes\FlashesNotifier
     */
    function flashes($message = null, $level = 'info')
    {
        $notifier = app('flashes');

        if (!is_null($message)) {
            return $notifier->message($message, $level);
        }

        return $notifier;
    }

}
