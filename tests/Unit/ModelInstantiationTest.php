<?php
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
// Import your base model if you have one

it('can instantiate all models', function () {
    // Define the directory where models are located
    $modelPath = app_path('Models');

    // Get all PHP files in the model directory
    $modelFiles = File::allFiles($modelPath);

    foreach ($modelFiles as $file) {
        // Get the class name with the full namespace
        $namespace = 'App\Models\\' . Str::replaceLast('.php', '', $file->getFilename());

        // Ensure the class exists and is instantiable
        expect(class_exists($namespace))->toBeTrue();
        expect(new $namespace())->toBeInstanceOf($namespace);
    }
});
