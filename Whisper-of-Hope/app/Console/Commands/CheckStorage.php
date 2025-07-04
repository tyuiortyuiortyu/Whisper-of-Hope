<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CheckStorage extends Command
{
    protected $signature = 'storage:check';
    protected $description = 'Check if storage is properly configured';

    public function handle()
    {
        // Check if public disk is working
        $this->info('Checking storage configuration...');
        
        // Check if storage link exists
        $publicPath = public_path('storage');
        if (is_link($publicPath)) {
            $this->info('✓ Storage link exists');
        } else {
            $this->error('✗ Storage link missing - run: php artisan storage:link');
        }
        
        // Check if profile_images directory exists
        if (Storage::disk('public')->exists('profile_images')) {
            $this->info('✓ profile_images directory exists');
        } else {
            $this->info('Creating profile_images directory...');
            Storage::disk('public')->makeDirectory('profile_images');
            $this->info('✓ profile_images directory created');
        }
        
        // Test file operations
        $testFile = 'profile_images/test.txt';
        try {
            Storage::disk('public')->put($testFile, 'test content');
            if (Storage::disk('public')->exists($testFile)) {
                $this->info('✓ File write/read test passed');
                Storage::disk('public')->delete($testFile);
            }
        } catch (\Exception $e) {
            $this->error('✗ File operations failed: ' . $e->getMessage());
        }
        
        $this->info('Storage check completed!');
    }
}
