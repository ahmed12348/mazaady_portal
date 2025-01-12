<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Folder;
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $faker->sentence,
            'type' => $faker->randomElement(['text', 'pdf']),
            'body' => $faker->paragraph,
            'pdf_url' => $faker->url,
            'is_shared' => $faker->boolean,
            'folder_id' => Folder::factory(), // Create a folder when creating a note
        ];
    }
}
