<?php
/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');
require_once('classes/Pdo_methods.php');
$stickyForm = new StickyForm();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init(){
  global $elementsArr, $stickyForm;

  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    /*THIS METHODS TAKE THE POST ARRAY AN THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT, THIS IS STORED IN THE $postArr VARIABLE */
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
    if($postArr['masterStatus']['status'] == "noerrors"){
      
      /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
      return addData($elementsArr);

    }
    else{
      /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
      return getForm("",$postArr);
    }
    
  }

  /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS BEFORE A FORM HAS BEEN SUBMITTED */
  else {
      return getForm("", $elementsArr);
    } 
}

/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
  "masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
    "name"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Name cannot be blank and must be a standard name</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"Emily",
        "regex"=>"name"
    ],
    "address"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Address cannot be blank and must be a valid address</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"4800 E Huron River Dr",
        "regex"=>"address"
    ],
    "city"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>City cannot be blank and must be a valid city</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"Ann Arbor",
        "regex"=>"city"
    ],
    "state"=>[
        "type"=>"select",
        "options"=>["MI"=>"Michigan","OH"=>"Ohio","PA"=>"Pennslyvania","TX"=>"Texas", "HI"=>"Hawaii"],
        "selected"=>"MI",
        "regex"=>"name"
    ],
    "phone"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Phone cannot be blank and must be written as 999.999.9999</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"734.973.3300",
        "regex"=>"phone"
    ],
    "email"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be a valid email address</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"info@wccnet.edu",
        "regex"=>"email"
    ],
    "birth"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Date of birth cannot be blank and must be a valid date in MM/DD/YYYY form</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"05/20/2002",
        "regex"=>"birth"
    ],
    "contacts"=>[
        "type"=>"checkbox",
        "action"=>"notRequired",
        "status"=>["newsletter"=>"", "email updates"=>"", "text updates"=>""]
    ],
    "age"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>You must select an age group</span>",
        "errorOutput"=>"",
        "action"=>"required",
        "type"=>"radio",
        "value"=>["10-18"=>"", "19-30"=>"", "30-50"=>"", "51+"=>""]
    ]
];

/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($elementsArr){

    /*SETTING UP THE FORMAT FOR THE SELECTED CONTACT OPTIONS TO BE ADDED TO DATABASE*/
    if (isset($_POST["contacts"])){
        $contacts = implode(", ", $_POST["contacts"]); //creates readable comma-separated list
    }
    else {
        $contacts = "No contact options selected";
    }
    
    $pdo = new PdoMethods();

    /* SQL STATEMENT CREATED AND PARAMETERS BINDED */
    $sql = "INSERT INTO contact_info (name, address, city, state, phone_number, email_address, birth_date, contact_types, age_group) VALUES (:name, :address, :city, :state, :phone, :email, :birth, :contact, :age)";
            
    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
    $bindings = [
        [':name',$_POST["name"],'str'], 
        [':address',$_POST["address"],'str'],
        [':city',$_POST["city"],'str'],
        [':state',$_POST["state"],'str'],
        [':phone',$_POST["phone"],'str'],
        [':email',$_POST["email"],'str'],
        [':birth',$_POST["birth"],'str'],
        [':contact',$contacts,'str'],
        [':age',$_POST["age"],'str'],
    ];
        
    /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
    $result = $pdo->otherBinded($sql, $bindings);
        
    /* HERE I AM USING AN OBJECT TO RETURN WHETHER SUCCESSFUL FOR ERROR */
    if($result === 'error'){
        return getForm("There was an error adding the record", $elementsArr);
    }
    else {
       // $acknowledgement = "Contact information is added";
        return getForm("Contact Information Added", $elementsArr);
    }
}
   

/*THIS IS THE GET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){

global $stickyForm;
$options = $stickyForm->createOptions($elementsArr['state']);

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="index.php?page=form">
    <div class="form-group">
      <label for="name">Name (letters only){$elementsArr['name']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
    </div>
    <div class="form-group">
      <label for="phone">Address (just number and street) {$elementsArr['address']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="address" value="{$elementsArr['address']['value']}" >
    </div>
    <div class="form-group">
      <label for="phone">City {$elementsArr['city']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="city" value="{$elementsArr['city']['value']}" >
    </div>
    <div class="form-group">
      <label for="state">State</label>
      <select class="form-control" id="state" name="state">
        $options
      </select>
    </div>
    <div class="form-group">
      <label for="phone">Phone {$elementsArr['phone']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{$elementsArr['phone']['value']}" >
    </div>
    <div class="form-group">
      <label for="phone">Email address {$elementsArr['email']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="email" value="{$elementsArr['email']['value']}" >
    </div>
    <div class="form-group">
      <label for="phone">Date of birth {$elementsArr['birth']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="birth" value="{$elementsArr['birth']['value']}" >
    </div>
    
    
    <p>Please check all contact types you would like (optional):</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contacts[]" id="contacts1" value="newsletter" {$elementsArr['contacts']['status']['newsletter']}>
      <label class="form-check-label" for="contacts1">Newsletter</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contacts[]" id="contacts2" value="email updates" {$elementsArr['contacts']['status']['email updates']}>
      <label class="form-check-label" for="contacts2">Email Updates</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contacts[]" id="contacts3" value="text updates" {$elementsArr['contacts']['status']['text updates']}>
      <label class="form-check-label" for="contacts3">Text Updates</label>
    </div>
        
    <p>Please select an age group (you must select one): {$elementsArr['age']['errorOutput']}</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age1" value="10-18"  {$elementsArr['age']['value']['10-18']}>
      <label class="form-check-label" for="age1">10-18</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age2" value="19-30"  {$elementsArr['age']['value']['19-30']}>
      <label class="form-check-label" for="age2">19-30</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age3" value="30-50"  {$elementsArr['age']['value']['30-50']}>
      <label class="form-check-label" for="age3">30-50</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age4" value="51+"  {$elementsArr['age']['value']['51+']}>
      <label class="form-check-label" for="age4">51+</label>
    </div>
    <div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return [$acknowledgement, $form];

}

?>