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
  
  __I have four tabs on homepage, showing:__
  1. __Show Database__ – show all current rows from database
  2. __Show XML file paths__ – show full paths to all XML files inside scanned directory in multiple level deep.
    - Button to import XML data into database
    - If XML <name> element exist in database, script will update current row’s data and update value for date_created timestamp.
  3. __Show XML file contents__ – show all structured data from XML files.
  4. __Show directory tree__ – show all files and subfolders inside $dir_path.
    - Created test files (test.txt) to ensure script escapes not XML files.

  * On the top of the page you can search for animals in database by animal’s name.
  
  * Filtered XSS validation.


Installation:
-------------
  1. Download project ZIP file or clone it via GIT with command:
  
  ```
  git clone https://github.com/krasimir-kostadinov/XML-Parser.git
  ```
  
  2. Create MySQL database at your setup.
  3. Import "animals.sql" file from projec root folder. This is initial database with just a few records. 
  4. Configure virtualhost and set execute permission to project root folder (if Linux based).
  5. Please setup your project settings in ./config.php file.
    !important config settings:
    - HOST_PATH - host path (also URL) to your local project. It is used also for loading resource files.
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
