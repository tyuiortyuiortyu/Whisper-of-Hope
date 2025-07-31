<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\HairRequest;

$req = HairRequest::first();
if ($req) {
    print_r($req->toArray());
} else {
    echo "No records found\n";
}
