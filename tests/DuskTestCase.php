<?php

namespace Tests;

use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Symfony\Component\Process\Process;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        //static::startChromeDriver();

        $process = new Process('/usr/bin/phantomjs --webdriver=127.0.0.1:4444',null,['DISPLAY' => ':0'],null,null);
        $process->start();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
	$options = (new ChromeOptions)->addArguments([
    '--window-size=1920,1920',
    '--disable-gpu',
    '--headless'
	]);

	$caps = DesiredCapabilities::phantomjs();
        $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $caps);
        return $driver;
    }
}
