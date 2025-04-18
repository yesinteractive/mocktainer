<?php

//Config file for FSL

function configure()
{
  option('fsl_version', "20250326");
  option('app_version', "20250326");
  option('behind_proxy', FALSE);  //enabled if behind gateway or balancer like Kong
  option('env', ENV_PRODUCTION);
  option('base_uri', "/"); //set if app is not in web root directory but in a subdirectory
  option('session', 'fsl'); // enable with a specific session name
  
  //##############################################
  //encryption configuration
  
  // IMPORTANT: Set your encryption key here!
  // You can generate a secure key by running this command in terminal:
  // php -r "echo base64_encode(random_bytes(32));"
  // 
  // ⚠️ WARNING: If you change this key, previously encrypted data will not be decryptable
  // ⚠️ WARNING: Keep this key secret and secure
  // ⚠️ WARNING: Do not commit the actual key to version control
  option('global_encryption_key', 'X9WpXFpuqmvcJ4pYHgbhKPV8VHQTzqjhN0k6/bAe5rM=');
  
  //##############################################
  //fsl configurations
  
  option('fsl_session_length', 300); // session timeout in seconds, default is 300 seconds or 5 minutes. PHP default is typically 24 minute
  
  
  
  #######################################################################
  #Database Connections
  ######################################################################

  
  #Initiate a DB connection (using PDO)
  #
  #  Example PDO Usage for data models
  #   function post_find_all()
  #      {
  #          $db = option('db_conn');
  #          $sql = "SELECT * FROM posts ORDER BY modified_at DESC SQL;"
  #          $result = array();
  #          $stmt = $db->prepare($sql);
  #          if ($stmt->execute())
  #          {
  #              return $stmt->fetchAll(PDO::FETCH_ASSOC);
  #          }
  #          return false;
  #      }
  # uncomment this section below if going to use a DB using PDO
  
/*       
        option('db_host','localhost');
        option('db_name','testdb');
        option('db_username','root');
        option('db_password','test');        
        
        try{
            $obj_db = new PDO('mysql:host='.option("db_host").';dbname='.option("db_name").';charset=utf8mb4', option("db_username"), option("db_password"));
            $obj_db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $GLOBALS['obj_db'] = $obj_db;

        }catch(PDOException $e){
            halt(SERVER_ERROR,"Connexion failed: ".$e); # raises an error / renders the error page and exit.
          
        }        
        
  */
 
}

?>
