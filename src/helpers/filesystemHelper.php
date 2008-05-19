<?php
class filesystemHelper {
    
    public static function getFiles($path='.') {
        $currentDir = opendir($path);
        $files = array();
        while ($files[] = readdir($currentDir));
        closedir($currentDir);
        return $files;
    }
    
    public static function printFileContents($path) {
        $contents = htmlentities(file_get_contents($path));
        //cross-reference included files
        if (preg_match('@(include|include_once|require|require_once)(\s*)\((\s*)(\'+)((.*/)([^\']*))@ui', $contents)){
            $contents = preg_replace('@(include|include_once|require|require_once)(\s*)\((\s*)(\'+)((.*/)([^\']*))@ui', '$1$2($3$4<a href="open.php?dir=$6&file=$7">$5</a>', $contents);
        }
       echo '<pre>' . $contents . '</pre>';
    }
}