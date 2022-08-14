<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'name'=> $this->faker->name,
            'email'=> $this->faker->safeEmail,
            'password'=> Hash::make('password'),
            'remember_token'=>Str::random(16),
        ];
    }
}
