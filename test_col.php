<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
dump(DB::select("SHOW FULL COLUMNS FROM karyawan LIKE 'email'"));
