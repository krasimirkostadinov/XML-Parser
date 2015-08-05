<?php

namespace models;

/**
 * Parser class has methods for folder manipulation. Used methods, which
 * crawls folders in multiple level deep and parse files structure.
 * @author Krasimir Kostadinov
 */
class Parser {

    /**
     * Contain all files|folders which should not be searched for XML files
     * @var array
     */
    private $_ignore_files = array(
        '.',
        '..',
        'index.php',
        'config.php',
        'nbproject',
        'documentation.pdf',
        'views',
        'public',
        'models',
        'ajax',
        'animals.sql',
        '.git',
        '.gitignore',
        '.idea/'
    );

    /**
     * Contain information for current Parser instanse is in valid folder
     * @var bool true|false
     */
    private $_is_directory = false;

    /**
     * Contain full path for current directory for scanning
     * @var string
     */
    private $_dir_path = false;

    /**
     * Expect full path of folder which will be parse
     * @param string $dir_path
     */
    public function __construct($dir_path = '.') {
        $dir_path = \models\Database::validateData($dir_path, 'string');

        if (!empty($dir_path) && is_dir($dir_path)) {
            $this->_dir_path = $dir_path;
            $this->_is_directory = true;
        }
        else {
            echo 'Given $dir_path [' . $dir_path . '] for \models\Parser instance is not directory!';
        }
    }

    /**
     * Check is directory given path for instance
     * @return bool
     */
    public function isDerectory() {
        return ($this->_is_directory === true) ? true : false;
    }

    /**
     * Return folder full path
     * @return string
     */
    public function getDirectoryPath() {
        return $this->_dir_path;
    }

    /**
     * List directory tree with folders, all subfolders and files inside
     * @param string $dir_path
     */
    public static function showDirTree($dir_path) {
        if (is_dir($dir_path)) {
            $files = scandir($dir_path);
            echo '<ul>';
            foreach ($files as $file) {
                $full_path = $dir_path . '/' . $file;
                $file_extension = pathinfo($full_path, PATHINFO_EXTENSION);
                if ($file != '.' && $file != '..') {
                    if (is_dir($full_path)) {
                        echo '<li class="folder">';
                    }
                    elseif ($file_extension === 'xml') {
                        echo '<li class="xml-file">';
                    }
                    else {
                        echo '<li class="other-file">';
                    }
                    echo $file;
                    if (is_dir($full_path)) {
                        self::showDirTree($dir_path . '/' . $file);
                    }
                    echo '</li>';
                }
            }
            echo '</ul>';
        }
    }

    /**
     * Collect XML files path in searched directory
     * @param string directory $path for scanning
     * @return array $xml_paths with all xml file paths
     */
    public function getXMLPaths($dir_path) {
        //array will contain all xml files path
        $xml_paths = array();
        $dirTreeTemp = array();
        $dh = @opendir($dir_path);
        while (false !== ($file = readdir($dh))) {
            if (!in_array($file, $this->_ignore_files)) {
                $file_path = $dir_path . '/' . $file;
                if (!is_dir($file_path)) {
                    if (!empty($file_path) && is_file($file_path) && is_readable($file_path)) {
                        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                        //get path of only XML files
                        if ($file_extension === 'xml') {
                            $xml_paths[] = $file_path;
                        }
                    }
                }
                else {
                    $dirTreeTemp = $this->getXMLPaths($file_path, $this->_ignore_files);
                    if (is_array($dirTreeTemp)) {
                        $xml_paths = array_merge($xml_paths, $dirTreeTemp);
                    }
                }
            }
        }
        closedir($dh);
        return $xml_paths;
    }

    /**
     * Get XML content from files
     * @return array with all XML content
     */
    public function getXMLContent() {
        $xmls_full_content = array();
        if ($this->isDerectory()) {
            $dirTree = $this->getXMLPaths($this->_dir_path);
            foreach ($dirTree as $value) {
                $xml_content = simplexml_load_file($value);
                $xmls_full_content[] = $xml_content;
            }
        }
        return $xmls_full_content;
    }

    /**
     * White information from XML files to database 
     */
    public function writeXMLInDB() {
        if ($this->isDerectory()) {
            $dirTree = $this->getXMLPaths($this->_dir_path);
            foreach ($dirTree as $value) {
                $xml_content = simplexml_load_file($value);
                foreach ($xml_content as $key => $value) {
                    $is_exist = \models\Animal::getAnimals(array('name' => $value->name));
                    if ($is_exist) {
                        //update
                        $animal_id = key($is_exist);
                        $animal = new \models\Animal($animal_id);
                        $animal->setCategory($value->category);
                        $animal->setSubcategory($value->subcategory);
                        $animal->setName($value->name);
                        $animal->setDescription($value->description);
                        $animal->setEat($value->eat);
                        $animal->save();
                    }
                    else {
                        //new animal
                        $animal = new \models\Animal();
                        $animal->setCategory($value->category);
                        $animal->setSubcategory($value->subcategory);
                        $animal->setName($value->name);
                        $animal->setDescription($value->description);
                        $animal->setEat($value->eat);
                        $animal->save();
                    }
                }
            }
        }
    }

    /**
     * Add files for ignore
     * @param array $ignore_files with new ignore files.
     * Example: array('new_file_name')
     */
    public function setIgnoreFiles($ignore_files) {
        if (!empty($ignore_files) && is_array($ignore_files)) {
            $this->_ignore_files = array_merge($this->_ignore_files, $ignore_files);
        }
    }

    /**
     * Get folder name for current scanned folder
     * @return string
     */
    public function getFolderName() {
        $folder_name = '';
        if ($this->_is_directory) {
            $folder_name = \basename($this->_dir_path);
        }
        return $folder_name;
    }

}
