<?php

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

test('guests can\'t access students page', function () {

    $response = $this
        ->get('/students');

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/login");
});

test('guests can\'t access users page', function () {

    $response = $this
        ->get('/users');

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/login");
});

test('users can access students page', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/students');

    $response->assertOk();
});

test('users can\'t access users page', function () {

    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/users');

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/");
});

test('users can\'t create users', function () {

    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/users', [
            'name' => 'user name',
            'email' => 'user@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'is_admin' => false,
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/");
});

test('users can\'t create students', function () {

    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/students', [
            'name' => 'user name',
            'age' => 20,
            'residence' => 'random place',
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/");
});

test('admins can access users page', function () {

    $admin = User::factory()->make([
        'is_admin' => true,
    ]);

    $response = $this
        ->actingAs($admin)
        ->get('/users');

    $response->assertOk();
});


test('admins can create users', function () {

    $admin = User::factory()->make([
        'is_admin' => true,
    ]);

    $response = $this
        ->actingAs($admin)
        ->post('/users', [
            'name' => 'user name',
            'email' => 'user@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'is_admin' => false,
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/users");
});

test('admins can create admins', function () {

    $admin = User::factory()->make([
        'is_admin' => true,
    ]);

    $response = $this
        ->actingAs($admin)
        ->post('/users', [
            'name' => 'user name',
            'email' => 'user@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'is_admin' => true,
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/users");
});

test('admins can edit users and make them admins', function () {

    $admin = User::factory()->make([
        'is_admin' => true,
    ]);

    $user = User::factory()->create();

    $response = $this
        ->actingAs($admin)
        ->put('/users/'.$user->id, [
            'name' => 'new name',
            'email' => 'new@mail.com',
            'is_admin' => true,
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/users");

    $user->refresh();

    $this->assertSame('new name', $user->name);
    $this->assertSame('new@mail.com', $user->email);
    $this->assertSame(1, $user->is_admin);
});

test('admins can create students', function () {

    $admin = User::factory()->make([
        'is_admin' => true,
    ]);

    $response = $this
        ->actingAs($admin)
        ->post('/students', [
            'name' => 'user name',
            'age' => 20,
            'residence' => 'random place',
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/students");
});

test('admins can edit students', function () {

    $admin = User::factory()->make([
        'is_admin' => true,
    ]);

    $student = Student::factory()->create();

    $response = $this
        ->actingAs($admin)
        ->put('/students/'.$student->id, [
            'name' => 'new name',
            'age' => 22,
            'residence' => 'new res',
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/students");

    $student->refresh();

    $this->assertSame('new name', $student->name);
    $this->assertSame(22, $student->age);
    $this->assertSame('new res', $student->residence);
});


test('admins can delete students', function () {

    $admin = User::factory()->make([
        'is_admin' => true,
    ]);

    $student = Student::factory()->create();

    $response = $this
        ->actingAs($admin)
        ->delete('/students/'.$student->id);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/students");
});

test('admins can delete users', function () {

    $admin = User::factory()->make([
        'is_admin' => true,
    ]);

    $student = User::factory()->create();

    $response = $this
        ->actingAs($admin)
        ->delete('/users/'.$student->id);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect($uri = "/users");
});


