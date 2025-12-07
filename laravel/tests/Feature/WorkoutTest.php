<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\TipVezbe;
use App\Models\Planner;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_workout(): void
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post('/workouts/store', [
            'Dan' => now()->toDateString(),
            'max_tezina' => 100,
            'ponavljanja' => 10,
            'tip_vezbe' => 'Bench Press',
            'muscle_group' => 'Chest',
        ]);



        $response->assertRedirect();
        $this->assertDatabaseHas('gym_progress', [
            'user_id' => $user->id,
            'max_tezina' => 100,
            'ponavljanja' => 10,
        ]);
    }


    public function test_user_can_view_workouts_page(): void {
            // Arrange: Create user and workout
            $user = User::factory()->create();
            
            $this->actingAs($user)->post('/workouts/store', [
                'Dan' => now()->toDateString(),
                'max_tezina' => 150,
                'ponavljanja' => 8,
                'tip_vezbe' => 'Squat',
                'muscle_group' => 'Legs',
            ]);

            // Act: Visit the workouts page
            $response = $this->actingAs($user)->get('/workouts');

            // Assert: Page loads successfully
            $response->assertStatus(200);
            
            // Also verify the workout exists in database for this user
            $this->assertDatabaseHas('gym_progress', [
                'user_id' => $user->id,
                'max_tezina' => 150,
                'ponavljanja' => 8,
            ]);
        }


        public function test_guest_cannot_access_workouts(): void {
            // Act: Try to access workouts WITHOUT logging in (no actingAs())
            $response = $this->get('/workouts');

            // Assert: Should redirect to login page
            $response->assertRedirect('/login');
        }

        public function test_creating_workout_marks_planner_as_completed(): void
            {
                // Arrange: Create user and exercise type
                $user = User::factory()->create();
                
                $tipVezbe = TipVezbe::create([
                    'naziv' => 'Overhead Press',
                    'muscle_group' => 'Shoulders'
                ]);


                // Create a pending plan for this exercise
                $plan = Planner::create([
                    'user_id' => $user->id,
                    'tip_vezbe_id' => $tipVezbe->id,
                    'planned_date' => now()->toDateString(),
                    'goal_weight' => 60,
                    'goal_reps' => 10,
                    'status' => 'pending',
                ]);

                // Act: User completes the workout
                $this->actingAs($user)->post('/workouts/store', [
                    'Dan' => now()->toDateString(),
                    'max_tezina' => 60,
                    'ponavljanja' => 10,
                    'tip_vezbe' => 'Overhead Press',  // Same exercise
                    'muscle_group' => 'Shoulders',
                ]);

                // Assert: Plan status should be updated to 'completed'
                $this->assertDatabaseHas('planner', [
                    'id' => $plan->id,
                    'status' => 'completed',
                ]);
            }


            public function test_validation_fails_without_required_fields(): void
            {
                // Arrange: Create and login user
                $user = User::factory()->create();
                
                // Act: Try to submit empty form
                $response = $this->actingAs($user)->post('/workouts/store', [
                    // Empty - no fields sent
                ]);

                // Assert: Should have validation errors for all required fields
                $response->assertSessionHasErrors([
                    'Dan',
                    'max_tezina',
                    'ponavljanja',
                    'tip_vezbe',
                    'muscle_group'
                ]);
            }



            public function test_user_can_delete_workout(): void
                    {
                        // Arrange: Create user and workout
                        $user = User::factory()->create();
                        
                        $this->actingAs($user)->post('/workouts/store', [
                            'Dan' => now()->toDateString(),
                            'max_tezina' => 80,
                            'ponavljanja' => 12,
                            'tip_vezbe' => 'Barbell Row',
                            'muscle_group' => 'Back',
                        ]);

                        // Get the created workout
                        $workout = $user->gymProgress()->first();

                        // Act: Delete the workout
                        $response = $this->actingAs($user)->delete("/gym-progress/{$workout->id}");

                        // Assert: Should redirect and workout should be gone
                        $response->assertRedirect();
                        $this->assertDatabaseMissing('gym_progress', [
                            'id' => $workout->id,
                        ]);
                    }
 
                    
                    public function test_user_cannot_see_other_users_workouts(): void
                        {
                            // Arrange: Create two separate users
                            $user1 = User::factory()->create();
                            $user2 = User::factory()->create();

                            // User 1 creates a workout
                            $this->actingAs($user1)->post('/workouts/store', [
                                'Dan' => now()->toDateString(),
                                'max_tezina' => 200,
                                'ponavljanja' => 5,
                                'tip_vezbe' => 'Deadlift',
                                'muscle_group' => 'Back',
                            ]);

                            // Act & Assert: User 2 should have zero workouts
                            $this->assertEquals(0, $user2->gymProgress()->count());
                            
                            // Also verify in database
                            $this->assertDatabaseMissing('gym_progress', [
                                'user_id' => $user2->id,
                                'max_tezina' => 200,  // User 2 didn't create this
                            ]);
                        }
}