<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Intis Telecom
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Intis\Test;

require  '../../../vendor/autoload.php';

use Intis\SDK\IntisClient;


class CheckStopListTest extends \PHPUnit_Framework_TestCase {
    private $login = 'your api login';
    private $apiKey = 'your api key here';
    private $apiHost = 'http://api.host.com/get/';

    public function test_checkStopList(){
        $connector = new LocalApiConnector($this->getData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);

        $phone = '442073238000';

        $stopList = $client->checkStopList($phone);
        $stopList->getId();
        $stopList->getDescription();
        $stopList->getTimeAddedAt();

        $this->assertInstanceOf('Intis\SDK\Entity\StopList',$stopList);
    }

    /**
     * @expectedException Intis\SDK\Exception\StopListException
     */
    public function test_checkStopListException(){
        $connector = new LocalApiConnector($this->getErrorData());

        $client = new IntisClient($this->login, $this->apiKey, $this->apiHost, $connector);
        $phone = '442073238000';
        $client->checkStopList($phone);
    }

    private function getData(){
        $result = '{"4494794":{"time_in":"2015-07-31 22:55:00","description":"test"}}';
        return json_decode($result);
    }

    private function getErrorData(){
        $result = '{"error":4}';
        return json_decode($result);
    }
}
