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

        $input = null;
        // when json is passed
        $input = json_decode('{"first_name":"Bishal","last_name":"Udash","_token":"upQc4zjrbrPCpCQXrowjaXdGFIpkVvRyRkA4r6L8","city":"Patan","state_province":"province 3","phone":"9814781809","zip":"44660","email":"chief.bishal@gmail.com","skills":"<p>Used to linux based OS, fluent in Sql,GIT, PL/pgSQL, able to create virtual hosts in VPS using nginx web server, generate SSL certificate using certbot.</p>\n<p>My hobbies include Futsal, Hiking, voluntering activities, cycling.</p>","user_summary":"<p>Seeking for a challenging position in an organization that offers me generous opportunities to explore and outshine in the field while accomplishing personal, professional as well as organizational goals. I am dynamic, creative, result-driven and possess positive attitude to&nbsp;bring changes in the work.</p>","job":{"title":["Associate software Engineer (Python)","Backend Developer (PHP, Laravel Framework)"],"employer":["Tekvortex Pvt. Ltd.","Chaudhary Group, Sanepa"],"city":["Patan","Lalitpur"],"start_date":["2019-05-22","2018-03-23"],"end_date":["","2019-05-23"],"job_details":["<ul>\n<li>Work with team of 40 plus people as a backend developer. The project is based on&nbsp;cloud migration.</li>\n<li>Worked in python(v3.6+) language, flask framework which handled the data&nbsp;extraction, transformation and complex calculation part of the project.</li>\n<li>Worked with python library pandas for data manipulation and analysis.</li>\n<li>Worked with complex SQL queries and stored procedure created in PL/pgSQL</li>\n<li>Tasks were assigned through Jira ticketing system, slack and skype was used fo&nbsp;communication.</li>\n<li>Reviewboard was user as a tool for peer reviewing the code and GIT was used as&nbsp;version control system .</li>\n</ul>",""]},"school":{"name":["Academia International College","Little Angels\' College"],"location":["Gwarko, lalitpur","Hattiban Lalitpur"],"degree":["Bachelors","High School"],"field_of_study":["Computer Science and Information Technology (BscCSIT)","Physics"],"start_year":["2013-06","2011-01"],"end_year":["2017-08","2012-12"],"achievements":["<p>Activities and societies:</p>\n<ul>\n<li>&nbsp;Won college Futsal Tournament in second year and top 8 in inter college Futsal tournament.</li>\n<li>College freshers event management.</li>\n<li>Participation in web development contest.</li>\n</ul>",""]}}', true);

        $obj = new ResumeBuilder();
        if (is_null($input)) {
            $input = $this->generateInputWithFaker();
        }
        $errors = $obj->validateInput($input);
        if (!is_null($errors)) {
            dd($errors);
        }
        $result = $obj->buildResume($input);

        $this->assertEquals(gettype('string'), gettype($result));
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
