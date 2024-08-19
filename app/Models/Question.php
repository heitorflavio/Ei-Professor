<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory;

    /**
     * Get the questions for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Vote>
     */
    public function votes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * @return Attribute<Question, never>
     */
    public function likes(): Attribute
    {
        return new Attribute(fn () => $this->votes()->sum('like'));
    }

     /**
     * @return Attribute<Question, never>
     */
    public function unlikes(): Attribute
    {
        return new Attribute(fn () => $this->votes()->sum('unlike'));
    }
}
