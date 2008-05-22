<?php
class FilesystemHelper {
    
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
    
    public static function openFileUrl($file, $dir){
        return "open.php?file=$file&dir=$dir";
    }
    
    public static function getCurrentDir($path) {
        return str_replace('apps/', '', realpath($path));
    }
    
    //on centralized networks, some directories are symlinks for /apps/socialnetworkmain/something this folders are read-only
    public static function isDirWritable($dir) {
        return (strpos(realpath($dir),'/apps/socialnetworkmain') === false);
    }
    
    public static function getAppRoot() {
        //how far from the root is the site editor installed (appname/site-editor = 1, appname/something/site-editor = 2, etc...)
        $installDepth = (count(explode('/',getcwd()))-3);
        return str_repeat('../', $installDepth);
    }
    
    public static function buildPath($subdomain, $dir, $filename) {
        $path = str_replace(getcwd(), '.', realpath($dir.'/'.$filename));
        //when back to the root from a symlinked dir (socialnetworkmain), replace it with the proper app root
        if ($path == '/apps/socialnetworkmain') {
            $path = self::getAppRoot();
        }
        return $path;
    }
}