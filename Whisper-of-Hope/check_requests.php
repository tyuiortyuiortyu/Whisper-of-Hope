<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\HairRequest;

echo "Hair Requests Count: " . HairRequest::count() . "\n";
echo "Hair Requests Data:\n";

HairRequest::all()->each(function($req) {
    echo "ID: {$req->id} - Recipient: {$req->recipient_full_name} - Status: {$req->status}\n";
});
