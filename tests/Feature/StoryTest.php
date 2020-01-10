<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Story;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoryTest extends TestCase
{
    use RefreshDatabase;
    
    public function setup():void {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function subject_is_required()
    {
        $response = $this->post(
            route('stories.store'),
            array_merge($this->data(), array('subject' => ''))
        );        

        $response->assertSessionHasErrors([
            'subject' => 'Please enter subject'
        ]);
        $this->assertCount(0, Story::all());
    }

    /** @test */
    public function subject_min_length()
    {
        $response = $this->post(
            route('stories.store'),
            array_merge($this->data(), array('subject' => 'Small'))
        );

        $response->assertSessionHasErrors([
            'subject' => 'The subject must be at least 10 characters.'
        ]);
        $this->assertCount(0, Story::all());
    }

    /** @test */
    public function subject_max_length()
    {
        $response = $this->post(
            route('stories.store'),
            array_merge($this->data(), array('subject' => Str::random(250)))
        );

        $response->assertSessionHasErrors([
            'subject' => 'The subject may not be greater than 200 characters.'
        ]);
        $this->assertCount(0, Story::all());
    }

    /** @test */
    public function subject_dummy_subject()
    {
        $response = $this->post(
            route('stories.store'),
            array_merge($this->data(), array('subject' => 'Dummy Subject'))
        );

        $response->assertSessionHasErrors([
            'subject' => 'subject is invalid.'
        ]);
        $this->assertCount(0, Story::all());
    }

    /** @test */
    public function story_can_be_added()
    {
        $response = $this->post(
            route('stories.store'),
            $this->data()
        );

        $this->assertCount(1, Story::all()); //Checking that records is inserted to DB
        $response->assertRedirect(route('stories.index')); //Checking Redirect to index page
        $response->assertSessionHas(['status' => 'Story created']); //Checking the Status Message
        $this->assertEquals( $this->user->id, Story::first()->user_id); //Making sure user_id is same as Authenticated User
    }

    /** @test */
    public function story_can_be_updated()
    {
        $this->post(
            route('stories.store'),
            $this->data()
        );

        $story = Story::first();

        $updateData = $this->data();

        $response = $this->patch( 
            route('stories.update', [$story]),
            $updateData
        );

        $story = Story::first(); //Get the story again.

        $this->assertCount(1, Story::all()); //Checking that there is still only 1 record in DB.
        $response->assertRedirect(route('stories.index')); //Checking Redirect to index page
        $response->assertSessionHas(['status' => 'Story updated']); //Checking the Status Message

        //Check all the Fiels are same as updateData
        $this->assertEquals( $updateData['subject'], $story->subject);
        $this->assertEquals( $updateData['body'], $story->body);
        $this->assertEquals( $updateData['type'], $story->type);
        $this->assertEquals( $updateData['active'], $story->active);

        $this->assertEquals( $this->user->id, $story->user_id); //Making sure user_id is same as Authenticated User

    }

    /** @test */
    public function story_of_other_user_can_not_be_updated()
    {
        $this->post(
            route('stories.store'),
            $this->data()
        );

        Auth::logout();
        $user = factory(User::class)->create();

        
        $this->actingAs($user);

        $story = Story::first();
        $response = $this->patch( 
            route('stories.update', [$story]),
            $this->data()
        );

        $response->assertStatus(403);




        
    }

    private function data() {

        return [
            'subject' => Str::random(15),
            'body' => Str::random(70),
            'type' => 'short',
            'active' => 1,
        ];
    }
}
