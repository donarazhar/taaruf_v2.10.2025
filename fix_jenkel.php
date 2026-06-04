<?php
$dir = new RecursiveDirectoryIterator('d:/3-File App/taaruf/resources/views');
$ite = new RecursiveIteratorIterator($dir);
foreach($ite as $file) {
    if ($file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        $original = $content;
        
        // Fix comparisons
        $content = str_replace("jenkel === 'L'", "jenkel === 'pria'", $content);
        $content = str_replace("jenkel == 'L'", "jenkel == 'pria'", $content);
        
        $content = str_replace("jenkel === 'P'", "jenkel === 'wanita'", $content);
        $content = str_replace("jenkel == 'P'", "jenkel == 'wanita'", $content);
        
        // Specifically in dashboard/taaruf/index.blade.php
        $content = str_replace("jenkel == 'pria' ? 'P' : 'L'", "jenkel == 'pria' ? 'wanita' : 'pria'", $content);
        
        if ($content !== $original) {
            file_put_contents($path, $content);
            echo "Updated $path\n";
        }
    }
}
echo "Done.\n";
