<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'resto_id' => $this->faker->randomElement([1,2,3]),
            'user_id' => 1,
            'amount' => $this->faker->numberBetween(99, 500),
            'isComplete' => $this->faker->randomElement([1,0]),
            'completed_at' => $this->faker->date('Y-m-d h:m:s'),
            'order_details' => [
                'items' => [1,2,3],
                'customer_name' => $this->faker->name,
                'customer_phone' => $this->faker->phoneNumber,
                'customer_address' => $this->faker->address,
                'customer_email' => $this->faker->email,
            ]
        ];
    }
}
