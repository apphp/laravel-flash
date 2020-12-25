<?php

namespace Apphp\Flash\Tests;

use Tests\TestCase;
use Apphp\Flash\Flash;


class TestFlashMessage extends TestCase
{

    /**
     * Test wrong level for flash messages
     */
    public function testWrongLevelForFashMessage(): void
    {
        $alert = Flash::wrongLevel('Flash message');
        $this->assertEquals(session('flash_notification'), null);

        $alert = flash('Flash message', 'wrong-level');
        $this->validateFlashMessage('info', '', 'Flash message', false);
    }

    /**
     * Test level for simple message
     */
    public function testLevelForSimpleMessage(): void
    {
        $alert = flash($message = 'Simple message');
        $this->validateFlashMessage('info', '', $message, false);
    }

    /**
     * Test valid message if it was created via global function
     *
     * @dataProvider validFlashMessagesDataProvider
     * @param $level
     * @param $title
     * @param $message
     * @param $important
     */
    public function testValidFlashMessagesAsFunction($level, $title, $message, $important): void
    {
        $alert = flash(
            $title ? [$title, $message] : $message,
            $level,
            $important
        );

        $this->validateFlashMessage($level, $title, $message, $important);
    }

    /**
     * Test valid message if it was created via Facade
     *
     * @dataProvider validFlashMessagesDataProvider
     * @param $level
     * @param $title
     * @param $message
     * @param $important
     */
    public function testValidFlashMessagesAsFacade($level, $title, $message, $important): void
    {
        $alert = Flash::$level($title ? [$title, $message] : $message);
        if ($important) {
            $alert->important();
        }

        $this->validateFlashMessage($level, $title, $message, $important);
    }
    /**
     * Valid flash messages data provider
     * @return array
     */
    public function validFlashMessagesDataProvider()
    {
        // $level, $title, $message, $important
        return [
            ['primary', 'Primary message title', 'Primary message content', true],
            ['primary', 'Primary message title', 'Primary message content', false],
            ['primary', '', 'Primary message content', true],
            ['primary', '', 'Primary message content', false],

            ['secondary', 'Secondary message title', 'Secondary message content', true],
            ['success', 'Success message title', 'Success message content', true],
            ['warning', 'Warning message title', 'Warning message content', true],
            ['validation', 'Validation message title', 'Validation message content', true],
            ['info', 'Info message title', 'Info message content', true],
            ['danger', 'Danger message title', 'Danger message content', true],
            ['error', 'Error message title', 'Error message content', true],
            ['light', 'Light message title', 'Light message content', true],
            ['dark', 'Dark message title', 'Dark message content', true],
        ];
    }

    /**
     * Perform validation of flash message
     * @param $level
     * @param $title
     * @param $message
     * @param $important
     */
    private function validateFlashMessage($level, $title, $message, $important): void
    {
        $actual = session('flash_notification');

        $this->assertEquals($actual[0]->level, ($level == 'error' ? 'danger' : $level));
        $this->assertEquals($actual[0]->title, $title);
        $this->assertEquals($actual[0]->message, $message);
        $this->assertEquals($actual[0]->important, $important);
    }

}
