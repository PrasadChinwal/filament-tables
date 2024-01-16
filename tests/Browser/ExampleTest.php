<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
	//maximixe needed otehrwise it does not get everything on the page
	$this->browse(function (Browser $browser) {
        $browser->pause(5000)
	->maximize()    
	->visit('/')
        ->waitForText('IDP node:')
        ->type('j_username', 'btarr1')
        ->type('j_password', 'P@ssw0rd1')
        ->press('_eventId_proceed')
        ->waitForLink('Basil Tarragon', 2)
	->assertSeeLink('Basil Tarragon')
	
	->clickLink('Impersonate')
        ->waitForText('Please select a user to impersonate')
	->select('id', '5')
	->press('ImpersonateButton')
	->waitForText('Faculty Activity Analysis Form', 2)
        ->assertSee('Faculty Activity Analysis Form');
	//->logout();
        //$browser->dump();
        });


    }
}
