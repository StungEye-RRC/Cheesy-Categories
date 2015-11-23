# Cheesy Categories

Categorizing cheeses with two MySQL tables.

# Setup

Execute the SQL found in the db folder.

This will create a cheesy-catgories database for you with two tables:

* cheeses
* categories

Then execute the following SQL to access this database with your usual credentials:

    GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, ALTER
      ON `cheesy-categories`.* TO 'serveruser'@'localhost'
      IDENTIFIED BY 'gorgonzola7!';
