<?php

namespace Tests\Feature;

use App\Models\Novel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NovelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the web can create a novel.
     */
    public function test_web_can_create_novel()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user); // No guard needed for web routes

        // Simulate the creation of a novel
        $response = $this->post('/novels', [
            'title' => 'My First Novel',
            'author' => 'Author Name',
            'synopsis' => 'A great novel synopsis',
            'published_at' => now(),
            'user_id' => $user->id,
        ]);

        // Assert that the response status is 302 (redirect to novels.index)
        $response->assertStatus(302);

        // Assert that the novel is in the database with the correct user_id
        $this->assertDatabaseHas('novels', [
            'title' => 'My First Novel',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test the web can update a novel.
     */
    public function test_web_can_update_novel()
    {
        // Create a user and a novel
        $user = User::factory()->create();
        $novel = Novel::factory()->create(['user_id' => $user->id]);

        // Log in the user
        $this->actingAs($user); // No guard needed for web routes

        // Simulate updating the novel
        $response = $this->put("/novels/{$novel->id}", [
            'title' => 'Updated Title',
            'author' => $novel->author,
            'synopsis' => $novel->synopsis,
            'published_at' => $novel->published_at,
            'user_id' => $user->id,
        ]);

        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);

        // Assert that the novel was updated in the database
        $this->assertDatabaseHas('novels', [
            'id' => $novel->id,
            'title' => 'Updated Title',
        ]);
    }

    /**
     * Test the web can delete a novel.
     */
    public function test_web_can_delete_novel()
    {
        // Create a user and a novel
        $user = User::factory()->create();
        $novel = Novel::factory()->create(['user_id' => $user->id]);

        // Log in the user
        $this->actingAs($user); // No guard needed for web routes

        // Simulate deleting the novel
        $response = $this->delete("/novels/{$novel->id}");

        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);

        // Assert that the novel was deleted from the database
        $this->assertDatabaseMissing('novels', [
            'id' => $novel->id,
        ]);
    }

    /**
     * Test the API can create a novel.
     */
    public function test_api_can_create_novel()
{
    // Create a single user and log them in
    $user = User::factory()->create(); // This ensures $user is an instance of User
    $this->actingAs($user, 'api'); // Authenticate with the 'api' guard

    // Simulate the API creation of a novel
    $response = $this->postJson('/api/novels', [
        'title' => 'My First Novel',
        'author' => 'Author Name',
        'synopsis' => 'A great novel synopsis',
        'published_at' => now(),
        'user_id' => $user->id, // Pass the user ID
    ]);

    // Assert that the response status is 201 (created)
    $response->assertStatus(201);

    // Assert that the novel is in the database
    $this->assertDatabaseHas('novels', [
        'title' => 'My First Novel',
        'user_id' => $user->id,
    ]);
}


    /**
     * Test the API can list novels.
     */
    public function test_api_can_list_novels()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user, 'api'); // Authenticate with the 'api' guard

        // Create some novels in the database
        Novel::factory()->count(3)->create(['user_id' => $user->id]);

        // Simulate the API GET request to list novels
        $response = $this->getJson('/api/novels');

        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that there are 3 novels in the response
        $response->assertJsonCount(3);
    }

    /**
     * Test the API can get novel details.
     */
    public function test_api_can_get_novel_details()
    {
        // Create a user and a novel
        $user = User::factory()->create();
        $novel = Novel::factory()->create(['user_id' => $user->id]);

        // Log in the user
        $this->actingAs($user, 'api'); // Authenticate with the 'api' guard

        // Simulate the API GET request to get the novel's details
        $response = $this->getJson("/api/novels/{$novel->id}");

        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that the correct novel data is returned
        $response->assertJson([
            'id' => $novel->id,
            'title' => $novel->title,
        ]);
    }

    /**
     * Test the API can update a novel.
     */
    public function test_api_can_update_novel()
    {
        // Create a user and a novel
        $user = User::factory()->create();
        $novel = Novel::factory()->create(['user_id' => $user->id]);

        // Log in the user
        $this->actingAs($user, 'api'); // Authenticate with the 'api' guard

        // Simulate the API PUT request to update the novel
        $response = $this->putJson("/api/novels/{$novel->id}", [
            'title' => 'Updated Title',
            'author' => $novel->author,
            'synopsis' => $novel->synopsis,
            'published_at' => $novel->published_at,
            'user_id' => $user->id,
        ]);

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the novel was updated in the database
        $this->assertDatabaseHas('novels', [
            'id' => $novel->id,
            'title' => 'Updated Title',
        ]);
    }

    /**
     * Test the API can delete a novel.
     */
    public function test_api_can_delete_novel()
    {
        // Create a user and a novel
        $user = User::factory()->create();
        $novel = Novel::factory()->create(['user_id' => $user->id]);

        // Log in the user
        $this->actingAs($user, 'api'); // Authenticate with the 'api' guard

        // Simulate the API DELETE request to remove the novel
        $response = $this->deleteJson("/api/novels/{$novel->id}");

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the novel was deleted from the database
        $this->assertDatabaseMissing('novels', [
            'id' => $novel->id,
        ]);
    }
}
