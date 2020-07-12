<?php

namespace Tests\Unit;

use App\Logic\Resume\ResumeBuilder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResumeTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function ResumeGenerator()
    {
        // when json is passed
        // $input = json_decode('{"_token":"0pG2ULjfKoqpWKrzG9mfL6DqDhVqSKbGJwzkb0dZ","first_name":null,"last_name":null,"city":null,"state_province":null,"zip":null,"phone":null,"email":null,"job":{"title":[null],"employer":[null],"city":[null],"start_date":[null],"end_date":[null],"job_details":[null]},"education":{"school_name":[null],"school_location":[null],"degree":[null],"field_of_stydy":[null],"start_year":[null],"end_year":[null],"achievements":[null]},"skills":null,"user_summary":null}', true);

        $obj = new ResumeBuilder();
        $input = $this->generateInputWithFaker();
        $errors = $obj->validateInput($input);
        if (!is_null($errors)) {
            dd($errors);
        }
        $result = $obj->buildResume($input);
        // dd($result);
        $this->assertEquals('hello', $result);
    }

    public function generateInputWithFaker()
    {
        return $input = [
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "city" => $this->faker->city(),
            "state_province" =>  $this->faker->state(),
            "zip" =>  $this->faker->postcode(),
            "phone" =>  $this->faker->phoneNumber(),
            "email" =>  $this->faker->safeEmail(),
            "skills" =>  $this->faker->randomLetter(),
            "user_summary" =>  $this->faker->paragraph($nbSentences = 5, $variableNbSentences = true),
            "job" => [
                "title" => [$this->faker->jobTitle(), $this->faker->jobTitle(), $this->faker->jobTitle()],
                "employer" =>  [$this->faker->company(), $this->faker->company(), $this->faker->company()],
                "city" =>  [$this->faker->city(), null, $this->faker->city()],
                "start_date" =>  [
                    $this->faker->dateTime($max = 'now', $timezone = null),
                    $this->faker->dateTime($max = 'now', $timezone = null),
                    null
                ],
                "end_date" =>  [null, null, null],
                "job_details" =>  [
                    $this->faker->text($maxNbChars = 200),
                    $this->faker->text($maxNbChars = 200),
                    $this->faker->text($maxNbChars = 200)
                ],
            ],
            "education" =>  [
                "school_name" =>  [$this->faker->company()],
                "school_location" =>  [$this->faker->streetName()],
                "degree" =>  [$this->faker->word()],
                "field_of_stydy" =>  [$this->faker->jobTitle()],
                "start_year" =>  [$this->faker->dateTime($max = 'now', $timezone = null)],
                "end_year" =>  [$this->faker->dateTime($max = 'now', $timezone = null)],
                "achievements" =>  [$this->faker->paragraphs($nb = 3, $asText = false)],
            ]
        ];
    }
}
