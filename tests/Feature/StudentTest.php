<?php

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

test('only admin users can make other users admin', function () {

    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($admin)
        ->put(route('users.update', $user), ['is_admin' => 1]);

    $response->assertRedirect(route('users.index'));
    $this->assertTrue((boolean) $user->fresh()->is_admin);

    $response = $this->actingAs($user)
        ->put(route('users.update', $admin), ['is_admin' => 0]);

    $response->assertRedirect(route('home'));
    $this->assertTrue((boolean) $admin->fresh()->is_admin);
});

test('only admin users can edit, add, delete students', function () {

    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);
    $student = Student::factory()->create();

    $response = $this->actingAs($admin)
        ->post(route('students.store'), [
            'name' => 'New Student',
            'age' => 20,
            'residence' => 'Someplace'
        ]);

    $response->assertRedirect(route('students.index'));
    $this->assertDatabaseHas('students', ['name' => 'New Student']);

    $response = $this->actingAs($user)
        ->post(route('students.store'), [
            'name' => 'Another Student',
            'age' => 21,
            'residence' => 'Another place'
        ]);

    $response->assertRedirect(route('home'));

    // Edit Student
    $response = $this->actingAs($admin)
        ->put(route('students.update', $student), [
            'name' => 'Updated Student',
            'age' => 22,
            'residence' => 'Updated place'
        ]);

    $response->assertRedirect(route('students.index'));
    $this->assertDatabaseHas('students', ['name' => 'Updated Student']);

    $response = $this->actingAs($user)
        ->put(route('students.update', $student), [
            'name' => 'Attempt Update',
            'age' => 23,
            'residence' => 'Attempt place'
        ]);

    $response->assertRedirect(route('home'));

    // Delete Student
    $response = $this->actingAs($user)
        ->delete(route('students.destroy', $student));

    $response->assertRedirect(route('home'));

    $response = $this->actingAs($admin)
        ->delete(route('students.destroy', $student));

    $response->assertRedirect(route('students.index'));
    $this->assertDatabaseMissing('students', ['id' => $student->id]);
});

test('only authenticated users can list students', function () {

    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->get(route('students.index'));
    $response->assertRedirect(route('login'));

    $response = $this->actingAs($admin)->get(route('students.index'));
    $response->assertStatus(200);

    $response = $this->actingAs($user)->get(route('students.index'));
    $response->assertStatus(200);
});

test('students have id, name, age, and residence location', function () {

    $student = Student::factory()->create([
        'name' => 'Test Student',
        'age' => 20,
        'residence' => 'Test Location'
    ]);

    $this->assertNotNull($student->id);
    $this->assertEquals('Test Student', $student->name);
    $this->assertEquals(20, $student->age);
    $this->assertEquals('Test Location', $student->residence);
});

test('only admin users can list users', function () {

    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->get(route('users.index'));
    $response->assertRedirect(route('login'));

    $response = $this->actingAs($admin)->get(route('users.index'));
    $response->assertStatus(200);

    $response = $this->actingAs($user)->get(route('users.index'));
    $response->assertRedirect(route('home'));
});

test('only admin users can edit users', function () {

    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);
    $userToEdit = User::factory()->create();

    // Admin can edit user
    $response = $this->actingAs($admin)
        ->put(route('users.update', $userToEdit), [
            'name' => 'Updated User',
            'email' => 'updated@example.com'
        ]);

    $response->assertRedirect(route('users.index'));
    $this->assertDatabaseHas('users', ['name' => 'Updated User', 'email' => 'updated@example.com']);

    // Non-admin user cannot edit user
    $response = $this->actingAs($user)
        ->put(route('users.update', $userToEdit), [
            'name' => 'Attempt Update',
            'email' => 'attempt@example.com'
        ]);

    $response->assertRedirect(route('home'));
    $this->assertDatabaseMissing('users', ['name' => 'Attempt Update', 'email' => 'attempt@example.com']);
});

test('only admin users can add users', function () {

    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);

    // Admin can add user
    $response = $this->actingAs($admin)
        ->post(route('users.store'), [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

    $response->assertRedirect(route('users.index'));
    $this->assertDatabaseHas('users', ['name' => 'New User', 'email' => 'newuser@example.com']);

    // Non-admin user cannot add user
    $response = $this->actingAs($user)
        ->post(route('users.store'), [
            'name' => 'Another User',
            'email' => 'another@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

    $response->assertRedirect(route('home'));
    $this->assertDatabaseMissing('users', ['name' => 'Another User', 'email' => 'another@example.com']);
});

