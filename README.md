# Books database

This is an application which insert books and authors from XML into PostgreSQL database

# Requirements

1. PHP 7.4
2. PostgreSQL 9.5.21

# Setup and usage

1. Import database structure from dump file in root folder
2. Fill your database info in databse.php in config folder
3. Create XML files manually or use generator
	a. Manually - create xml directory in root folder 
	b. Use generator - run createXMLFiles.php path-to-csv Example: php createXMLFiles.php books_new.csv
4. Run php importScript.php which imports everything from xml directory recursively 
5. Open index.php in browser to search in DB
