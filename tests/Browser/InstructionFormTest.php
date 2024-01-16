<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InstructionFormTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
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
        ->assertSee('Faculty Activity Analysis Form')

        ->press('click_to_enter_data')
        ->waitForText('Regular Workload')
        ->assertSee('Regular Workload')

        ->type('act_unit_cnt[420178_14777]', '10')
	->press('SaveTeachingAssignmentsButton')
	->waitForText('Regular Workload')
        ->assertSee('Regular Workload')

        ->logout();
        //$browser->dump();
        });
	
	}
}
