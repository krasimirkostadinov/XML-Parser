# XML Directory Parser

This is test task, i made by custom reqruimenents. 

Task requirements:
-------------
  1. Script should parse folders and sub-folders to look for XML files.
  2. Show folders structure and files with WEB UI for user.
  3. Parse/get content of all XML files and option to insert them to database.
  4. Review all current database data.
  5. Search *animal* with parameter "name". Search should be valid for atleast 3 languages: Bulgarian, Korean, Japaneese.


My solution:
------------
  In folder "animals" i created XML files with data objects, reffered to animals. 
  __Object structure:__
  ```
  <animal>
    <category></category>
    <name></name>
    <description></description>
    <eat></eat>
  </animal>
  ```
  
  I build custom PHP API, using Bootstrap 3.0, jQuery, Ajax and PHP-PDO for secure database connection. Escape dangerous tags and possible XSS attack.
  
  __On project home page there’s four tabs, showing:__
  1. Show Database – show all current rows from database
  2. Show XML file paths – show full paths to all XML files inside scanned directory in multiple level deep.
    a. Button to import XML data into database
    b. If XML <name> element exist in database, script will update current row’s data and new value for date_created.
  3. Show XML file contents – show all structured data from XML files.
  4. Show directory tree – show all files and subfolders inside $dir_path
    a. Created test files (test.txt) to ensure script escapes not XML files.

  On the top of the page you can search for animals in database by animal’s name.
  Filtered XSS validation.


Installation:
-------------
  1. Create MySQL database at your setup.
  2. Configure virtualhost and set execute permission to project root flder (if Linux based)
  3. Please setup your project settings in ./config.php file.
    !important config settings:
    - HOST_PATH - this is host path (also URL) to your local project
    - DB_USER - user for database connection
    - DB_PASS - user's password for database connection
    - $dir_path - folder to parse (default /animals)
  


Project preview:
----------------
  1. Screen with user interface, showing directory structure
  ![alt tag](/docs/git-images/directory-structure.png?raw=true "Directory structure")

  2. XML file's location
  ![alt tag](/docs/git-images/xml-files-location.png?raw=true "XML files location")

  3. XML file's contenct with each object data
  ![alt tag](/docs/git-images/xml-file-content.png?raw=true "XML files content")
  
  4. Primary search result set
  ![alt tag](/docs/git-images/search-results.png?raw=true "Primary search result")
