# PHP FMA BBK_SSCS023H5_1617 - Thomas Shaddock  
  
## Project URL ##  
https://titan.dcs.bbk.ac.uk/~tshadd01/w1fma/  
 
## Project set up and config ##  
- DB config parameters are set in /config/database.php. The parameters that need to be defined are:
define('DB_NAME', '');  
define('DB_USER', '');  
define('DB_PASS', '');  
define('DB_HOST', '');  

- Project paths are defined in /config/paths.php. The parameters that need to be defined are:  
define('URL', ''); //set to 'https://titan.dcs.bbk.ac.uk/~tshadd01/w1fma/'  
define('BBK_OS_PATH', ''); //this has been set to '/home/tshadd01/public_www/w1fma/' for my instance as I was having some problems when not defining the whole path on the BBK titan server.  
  
## Database table creation ##  
CREATE  TABLE `images`.`images` (  
  `id` INT NOT NULL AUTO_INCREMENT ,  
  `title` VARCHAR(45) NULL ,  
  `description` VARCHAR(90) NULL ,  
  `filename` VARCHAR(45) NULL ,  
  `width` VARCHAR(45) NULL ,  
  `height` VARCHAR(45) NULL ,  
  `path` VARCHAR(90) NULL ,  
  PRIMARY KEY (`id`) );  
ALTER TABLE `images`.`images` ADD COLUMN `thumb` VARCHAR(90) NULL  AFTER `path` ;  
  

## API URL ##  
Api is available at the following end point: /index/api/ - a number parameter is required e.g https://titan.dcs.bbk.ac.uk/~tshadd01/w1fma/index/api/3  
  
  
## External Assets ##  
- Jquery  
- Bootstrap CSS Library  
  
* Please note that I am making use of a number of CDNs to load scripts from and thus this application must be deployed on a server with an active internet connection.