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
        $input = json_decode('{"first_name":"Bishal ","last_name":"Udash","_token":"e8U4i23iVV4K3ky1NYeLANRi4YorwDRVGV4B66Uh","city":"Lalitpur","email":"test@test.com","skills":"<p>drawing, coding</p>","state_province":"3","user_summary":"<p>I am a tall guy.</p>","zip":"44600","job":{"city":["lalitpur"],"employer":["IT company"],"end_date":["2020-07-18"],"job_details":["bugs fixes"],"start_date":["2019-02-18"],"title":["Dev"]},"phone":"9845612420","school":{"achievements":["some score"],"degree":["Bachelor"],"end_year":["2017-11"],"field_of_study":["BSc.CSIT"],"location":["Gwarkhoo"],"name":["Academia"],"start_year":["2013-11"]}}', true);

        $obj = new ResumeBuilder();
        // $input = $this->generateInputWithFaker();
        $errors = $obj->validateInput($input);
        if (!is_null($errors)) {
            dd($errors);
        }
        $result = $obj->buildResume($input);
        $this->assertEquals(true, $result);
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
            "skills" =>  $this->faker->sentence(),
            "user_summary" =>  $this->faker->paragraph($nbSentences = 5, $variableNbSentences = true),
            "job" => [
                "title" => [$this->faker->jobTitle(), $this->faker->jobTitle(), $this->faker->jobTitle()],
                "employer" =>  [$this->faker->company(), $this->faker->company(), $this->faker->company()],
                "city" =>  [$this->faker->city(), null, $this->faker->city()],
                "start_date" =>  [
                    date('Y-m-d'),
                    date('Y-m-d'),
                    null
                ],
                "end_date" =>  [null, $this->faker->dateTime($max = 'now', $timezone = null), null],
                "job_details" =>  [
                    $this->faker->text($maxNbChars = 200),
                    $this->faker->text($maxNbChars = 200),
                    $this->faker->text($maxNbChars = 200)
                ],
            ],
            "school" =>  [
                "name" =>  [
                    $this->faker->company(),
                    $this->faker->company()
                ],
                "location" =>  [
                    $this->faker->streetName(),
                    $this->faker->streetName()
                ],
                "degree" =>  [
                    $this->faker->word(),
                    $this->faker->word()
                ],
                "field_of_study" =>  [
                    $this->faker->jobTitle(),
                    $this->faker->jobTitle()
                ],
                "start_year" =>  [
                    date('Y-m'),
                    date('Y-m')
                ],
                "end_year" =>  [
                    date('Y-m'),
                    date('Y-m'),
                ],
                "achievements" =>  [
                    $this->faker->paragraph($nbSentences = 5, $variableNbSentences = true),
                    $this->faker->paragraph($nbSentences = 5, $variableNbSentences = true)
                ]
            ]
        ];
    }
}
