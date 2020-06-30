<?php

/**
 * Templates module.
 *
 * This file is part of MadelineProto.
 * MadelineProto is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * MadelineProto is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU General Public License along with MadelineProto.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Daniil Gentili <daniil@daniil.it>
 * @copyright 2016-2020 Daniil Gentili <daniil@daniil.it>
 * @license   https://opensource.org/licenses/AGPL-3.0 AGPLv3
 *
 * @link https://docs.madelineproto.xyz MadelineProto documentation
 */
namespace danog\MadelineProto\Wrappers;

use function Amp\ByteStream\getOutputBufferStream;
trait Templates
{
    /**
     * Echo page to console.
     *
     * @param string $message Error message
     *
     * @return \Generator
     */
    /*
    private function webEcho(string $message = '') : \Generator
    {
        $stdout = getOutputBufferStream();
        switch ($this->authorized) {
            case self::NOT_LOGGED_IN:
                if (isset($_POST['type'])) {
                    if ($_POST['type'] === 'phone') {
                        (yield $stdout->write($this->webEchoTemplate('Enter your phone number<br><b>' . $message . '</b>', '<input type="text" name="phone_number" placeholder="Phone number" required/>')));
                    } else {
                        (yield $stdout->write($this->webEchoTemplate('Enter your bot token<br><b>' . $message . '</b>', '<input type="text" name="token" placeholder="Bot token" required/>')));
                    }
                } else {
                    (yield $stdout->write($this->webEchoTemplate('Do you want to login as user or bot?<br><b>' . $message . '</b>', '<select name="type"><option value="phone">User</option><option value="bot">Bot</option></select>')));
                }
                break;
            case self::WAITING_CODE:
                (yield $stdout->write($this->webEchoTemplate('Enter your code<br><b>' . $message . '</b>', '<input type="text" name="phone_code" placeholder="Phone code" required/>')));
                break;
            case self::WAITING_PASSWORD:
                (yield $stdout->write($this->webEchoTemplate('Enter your password<br><b>' . $message . '</b>', '<input type="password" name="password" placeholder="Hint: ' . $this->authorization['hint'] . '" required/>')));
                break;
            case self::WAITING_SIGNUP:
                (yield $stdout->write($this->webEchoTemplate('Sign up please<br><b>' . $message . '</b>', '<input type="text" name="first_name" placeholder="First name" required/><input type="text" name="last_name" placeholder="Last name"/>')));
                break;
        }
    }
    */
    /**
     * Web template.
     *
     * @var string
     */
    private $web_template = '<!DOCTYPE html><html><head><title>MadelineProto</title></head><body><h1>MadelineProto</h1><form method="POST">%s<button type="submit"/>Go</button></form><p>%s</p></body></html>';
    /**
     * Format message according to template.
     *
     * @param string $message Message
     * @param string $form    Form contents
     *
     * @return string
     */
    private function webEchoTemplate(string $message, string $form) : string
    {
        return \sprintf($this->web_template, $form, $message);
    }
    /**
     * Get web template.
     *
     * @return string
     */
    public function getWebTemplate() : string
    {
        return $this->web_template;
    }
    /**
     * Set web template.
     *
     * @param string $template Template
     *
     * @return void
     */
    public function setWebTemplate(string $template)
    {
        $this->web_template = $template;
    }
    /**
     * Echo page to console.
     *
     * @param string $message Error message
     *
     * @return \Generator
     */
    private function webEcho(string $message = '') : \Generator
    {
        $stdout = getOutputBufferStream();
        switch ($this->authorized) {
            case self::NOT_LOGGED_IN:
                if (isset($_POST['type'])) {
                    if ($_POST['type'] === 'phone') {
                        (yield $stdout->write($this->_web_json_echo(-5,'请输入手机号码！'.$message)));
                    } else {
                        (yield $stdout->write($this->_web_json_echo(-6,'请输入机器人Token！'.$message)));
                    }
                } else {
                    (yield $stdout->write($this->_web_json_echo(-7,'请选择用户还是机器人！'.$message)));
                }
                break;
            case self::WAITING_CODE:
                (yield $stdout->write($this->_web_json_echo(-8,'请输入手机验证码！'.$message)));
                break;
            case self::WAITING_PASSWORD:
                (yield $stdout->write($this->_web_json_echo(-9,'请输入密码！'.$message)));
                break;
            case self::WAITING_SIGNUP:
                (yield $stdout->write($this->_web_json_echo(-10,'您的号码未注册，请输入姓名注册！'.$message)));
                break;
        }
    }

    private function _web_json_echo( $code , $message ,$data = [] )
    {
        return json_encode([
            'code'      => $code,
            'msg'       => $message,
            'data'      => $data
        ]);
    }
}
