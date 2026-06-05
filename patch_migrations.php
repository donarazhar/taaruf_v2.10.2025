<?php
$dir = __DIR__ . '/database/migrations';
$files = glob($dir . '/2026_06_03_115521_create_*.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Find the table name
    if (preg_match('/Schema::create\(\'([^\']+)\'/', $content, $matches)) {
        $tableName = $matches[1];
        
        // Wrap Schema::create in if (!Schema::hasTable)
        // Find "public function up()" block
        
        $newContent = preg_replace(
            '/public function up\(\)\s*\{/', 
            "public function up()\n    {\n        if (!Schema::hasTable('$tableName')) {", 
            $content
        );
        
        // Find "public function down()" block and put a closing brace before it.
        // Actually, we can just find the closing brace of the `up()` method.
        // The `up()` method ends before `/**` or `public function down()`.
        
        $newContent = preg_replace(
            '/(\s*)\}\s*\/\*\*/', 
            "$1    }$1}\n\n    /**", 
            $newContent
        );
        
        file_put_contents($file, $newContent);
        echo "Patched: $file\n";
    }
}
echo "Done.\n";
