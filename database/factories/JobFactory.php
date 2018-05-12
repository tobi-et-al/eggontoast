<?php

use Faker\Generator as Faker;

$categories = (config('jobs.categories'));
$categoriesList =   explode(',', $categories);

$_sampleDescription = "<strong>Responsibilities</strong></p><ul><li>Collaborating with senior team members on internal controls audits carried out by external auditors.</li><li>Liaising with external auditors and internal teams on proper documentation of controls, testing of controls, and results of testing.</li><li>Maintaining the Sharepoint site dedicated to internal controls audits.<span></span></li></ul><p><strong>Requirements</strong>&nbsp;</p><ul><li>Associate level relevant experience.</li><li>Controls audit expertise – ISAE 3402, SAS 70 or Internal Audit.</li><li>Drafting of controls, control maintenance, evidence collection.</li><li>Knowledge of regulatory and legal topics related to the fund management industry.</li><li>Excellent project management skills.</li><li>Advanced knowledge of Excel.</li><li>Strong numerical skills, thorough understanding of derivative instruments.</li></ul>";


$factory->define(\App\Model\Job::class, function (Faker $faker) use ($categoriesList, $_sampleDescription) {
    $randomCategoryKey = rand(0,count($categoriesList)-1);
    return [
        'title' => $faker->jobTitle,
        'category' => $categoriesList[$randomCategoryKey],
        "description"=> $_sampleDescription,
        "location" => $faker->city

    ];
});
