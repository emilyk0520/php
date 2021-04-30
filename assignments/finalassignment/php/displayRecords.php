<?php
require_once "classes/Pdo_methods.php";

  function init(){
      if (isset($_POST["delete"])){//if delete button pressed runs function and sends proper message to retrieveData
        $acknowledgement = deleteRow();
        return retrieveData($acknowledgement);
      }
      else {//if nothing deleted, normally run retrieveData 
        $acknowledgement = "";
        return retrieveData($acknowledgement);
      }
  }

  function retrieveData($acknowledgement){
    $pdo = new PdoMethods();

    /* SQL STATEMENT CREATED AND PARAMETERS BINDED */
    $sql = "SELECT * FROM contact_info"; 

    /* I AM CALLING THE SELECTBINDED METHOD FROM MY PDO CLASS */
    $records = $pdo->selectNotBinded($sql);

    if($records === 'error'){
      return createTable("There was an error finding the contacts", "");
    }
    else {
      if(count($records) != 0 && $acknowledgement){//creates table if records exist in database and a message for deleting is passed
        return createTable($acknowledgement, $records);
      }
      else if(count($records) != 0){//runs function to create table if records exist in database without a message
        return createTable("", $records);
      }
      else {//returns error message if no records in database
        return createTable("There are no records to display", "");
      }
    }
  }
  
  /* CREATES TABLE WITH ROWS FROM DATABASE */
  function createTable($acknowledgement, $records){

    if ($records !== ""){//creates table if records exist
      $output = "<form method='post' action='index.php?page=display'>";
      $output .= "<input class='btn btn-danger' type='submit' name='delete' value='Delete'>";
      $output .= "<table class='table table-striped table-bordered'><thead><tr>";
      $output .= "<th>Name</th><th>Address</th><th>Phone</th><th>Email</th><th>DOB</th><th>Contact</th><th>Age</th><th>Delete</th></tr><thead><tbody>";

      foreach ($records as $row){
        $output .= "<tr><td>{$row['name']}</td>";

        $output .= "<td>{$row['address']}</td>";

        $output .= "<td>{$row['phone_number']}</td>";

        $output .= "<td>{$row['email_address']}</td>";

        $output .= "<td>{$row['birth_date']}</td>";

        $output .= "<td>{$row['contact_types']}</td>";

        $output .= "<td>{$row['age_group']}</td>";

        $output .= "<td><input type='checkbox' name='inputDeleteChk[]' value='{$row['contact_id']}'></td></tr>";
      }
      
      $output .= "</tbody></table></form>";
      
      return [$acknowledgement, $output];//returns acknowledgement and table in array
    }

    else {//returns error message only, no table
      return [$acknowledgement, $records];
    }
  }

  function deleteRow(){
    $error = false;

      if (isset($_POST["inputDeleteChk"])){//if checkbox checked
        
        foreach($_POST['inputDeleteChk'] as $id){
          $pdo = new PdoMethods();

          $sql = "DELETE FROM contact_info WHERE contact_id=:id";//matches based on id
          
          $bindings = [
            [':id', $id, 'int'],
          ];

          $result = $pdo->otherBinded($sql, $bindings);

          if($result === 'error'){
            $error = true;
            break;
          }
        }

        /*ACKNOWLEDGEMENT MESSAGE*/
        if($error){
          return "Could not delete the name(s)";
        }

        else {
          return "Contact(s) deleted";
        }
    }
    else {//if no checkbox selected
      return "";
    }

  }
?>