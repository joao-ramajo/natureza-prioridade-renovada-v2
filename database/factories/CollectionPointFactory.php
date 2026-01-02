<?php

namespace Database\Factories;

use App\Models\CollectionPoint;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CollectionPoint>
 */
class CollectionPointFactory extends Factory
{
    protected $model = CollectionPoint::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company . ' - Ponto de Coleta',
            'status' => $this->faker->randomElement([
                'pending',
                'approved',
                'rejected',
            ]),
            'category' => $this->faker->randomElement([
                'reciclagem',
                'eletronicos',
                'oleo',
                'vidro',
                'papel',
            ]),
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zip_code' => $this->faker->postcode,
            'description' => $this->faker->optional()->paragraph,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'rejection_reason' => null,
            'approved_at' => null,
            'rejected_at' => null,
        ];
    }

    public function approved(): static
    {
        return $this->state(fn() => [
            'status' => 'approved',
            'approved_at' => now(),
            'rejected_at' => null,
            'rejection_reason' => null,
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn() => [
            'status' => 'rejected',
            'approved_at' => null,
            'rejected_at' => now(),
            'rejection_reason' => $this->faker->sentence,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn() => [
            'status' => 'pending',
            'approved_at' => null,
            'rejected_at' => null,
            'rejection_reason' => null,
        ]);
    }
}
