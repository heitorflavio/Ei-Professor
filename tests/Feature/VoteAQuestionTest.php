<?php

use App\Models\Question;
use App\Models\User;

test('should be able to like a question', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    $question = Question::factory()->create();

    $this->actingAs($user);

    // Act :: agir
    $request = $this->post(route('vote.store', $question));

    // Assert :: verificar
    $request->assertRedirect(route('dashboard'));
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
    $this->post(route('vote.store', $question));
    $this->post(route('vote.store', $question));
    $this->post(route('vote.store', $question));
    $this->post(route('vote.store', $question));

    // Assert :: verificar
    expect($user->votes()->where('question_id', $question->id)->get())->toHaveCount(1);

});
