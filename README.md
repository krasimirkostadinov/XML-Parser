# XML Directory Parser

This is test task, which i made by custom reqruimenents. 

Requirements:
-------------
  1. Script should parse folders and sub-folders to look for XML files.
  2. Show folders structure and files with WEB UI for user.
  3. Parse/get content of all XML files and option to insert them to database.
  4. Review all current database content.
  5. Search *animal* with parameter "name". Search should be valid for atleast 3 languages: Bulgarian, Korean, Japaneese


My solution:
------------
  In folder "animals" i created XML files with data objects, reffered to animals. They contain:
  <animal>
    <category></category>
    <name></name>
    <description></description>
    <eat></eat>
  </animal>
  
  Created custom PHP API, using Bootstrap 3.0, jQuery, Ajax and PHP:PDO for secure database connection. Escape dangerous tags and possible XSS attack. 


Installation:
-------------
  1. Please set your local setting in ./config.php file.
    !important config settings:
    - HOST_PATH - this is host path (also URL) to your local project
    - DB_USER - user for database connection
    - DB_PASS - user's password for database connection
    - $dir_path to parse (default /animals)
  2. Configure virtualhost and set execute permission to root flder (if Linux based)
