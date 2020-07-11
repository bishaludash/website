<?php

namespace Tests\Unit;

use App\Logic\Resume\ResumeBuilder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResumeTest extends TestCase
{
    /** @test */
    public function ResumeGenerator()
    {
        $input = json_decode('{"_token":"0pG2ULjfKoqpWKrzG9mfL6DqDhVqSKbGJwzkb0dZ","first_name":null,"last_name":null,"city":null,"state_province":null,"zip":null,"phone":null,"email":null,"job":{"title":[null],"employer":[null],"city":[null],"start_date":[null],"end_date":[null],"job_details":[null]},"education":{"school_name":[null],"school_location":[null],"degree":[null],"field_of_stydy":[null],"start_year":[null],"end_year":[null],"achievements":[null]},"skills":null,"user_summary":null}', true);

        $obj = new ResumeBuilder();

        $errors = $obj->validateInput($input);
        dd($errors);
        $result = $obj->buildResume($input);

        $this->assertEquals('hello', $result);
    }
}
