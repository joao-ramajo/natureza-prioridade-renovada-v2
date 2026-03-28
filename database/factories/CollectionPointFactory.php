<?php

namespace Database\Factories;

use App\CollectionPoint\Domain\Entity\CollectionPointStatus;
use App\CollectionPoint\Domain\Entity\CollectionPoint;
use App\Auth\Domain\Entity\User;
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
            'status' => $this->faker->randomElement(
                CollectionPointStatus::values()
            ),
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
            'principal_image' => 'https://placehold.co/200x200',
        ];
    }

    public function pending(): static
    {
        return $this->state(fn() => [
            'status' => 'pending',
        ]);
    }
}
