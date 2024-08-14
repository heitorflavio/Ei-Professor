<?php

use App\Models\User;

it('should be able to create a new question bigger than 255 characters', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    $this->actingAs($user);

    // Act :: agir
    $request = $this->post(route('question.store'), [
        'question' => str_repeat('*', 260).'?',
    ]);

    // Assert :: verificar
    $request->assertRedirect(route('question.index'));
    \Pest\Laravel\assertDatabaseCount('questions', 1);
    \Pest\Laravel\assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260).'?',
    ]);
});

it('should have at least 10 characters', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    $this->actingAs($user);

    // Act :: agir
    $request = $this->post(route('question.store'), [
        'question' => str_repeat('*', 8).'?',
    ]);

    // Assert :: verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['attribute' => 'question', 'min' => 10])]);
    \Pest\Laravel\assertDatabaseCount('questions', 0);
});