<?php

use App\Models\Question;
use App\Models\User;

it('should be able to like a question', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    $question = Question::factory()->create();

    $this->actingAs($user);

    // Act :: agir
    $request = $this->post(route('vote.like', $question));

    // Assert :: verificar
    // $request->assertRedirect(back());
    // \Pest\Laravel\assertDatabaseCount('votes', 1);
    \Pest\Laravel\assertDatabaseHas('votes', [
        'user_id' => $user->id,
        'question_id' => $question->id,
        'like' => 1,
        'unlike' => 0,
    ]);
});

it('should not be able to like more than 1 time', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    $question = Question::factory()->create();

    $this->actingAs($user);

    // Act :: agir
    $this->post(route('vote.like', $question));
    $this->post(route('vote.like', $question));
    $this->post(route('vote.like', $question));
    $this->post(route('vote.like', $question));

    // Assert :: verificar
    expect($user->votes()->where('question_id', $question->id)->get())->toHaveCount(1);

});

it('should be able to unline a question', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    $question = Question::factory()->create();

    $this->actingAs($user);

    // Act :: agir
    $request = $this->post(route('vote.unlike', $question));

    // Assert :: verificar
    // $request->assertRedirect(route('dashboard'));
    // \Pest\Laravel\assertDatabaseCount('votes', 1);
    \Pest\Laravel\assertDatabaseHas('votes', [
        'user_id' => $user->id,
        'question_id' => $question->id,
        'like' => 0,
        'unlike' => 1,
    ]);
});

it('should not be able to unlike more than 1 time', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    $question = Question::factory()->create();

    $this->actingAs($user);

    // Act :: agir
    $this->post(route('vote.unlike', $question));
    $this->post(route('vote.unlike', $question));
    $this->post(route('vote.unlike', $question));
    $this->post(route('vote.unlike', $question));

    // Assert :: verificar
    expect($user->votes()->where('question_id', $question->id)->get())->toHaveCount(1);

});
