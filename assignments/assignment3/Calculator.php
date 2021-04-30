<?php

class Calculator {

    //method to verify parameters and run math if no problems
    public function verify($operator, $integer1, $integer2){
        switch (true){
            case gettype($operator)!=="string": return "You must enter a string and two numbers";
            case gettype($integer1)!=="integer": return "You must enter a string and two numbers";
            case gettype($integer2)!=="integer": return "You must enter a string and two numbers";
            default: return $this->math($operator, $integer1, $integer2);
        }
    }

    //variable to store answer
    private $answer;

    //method to do math based on operator and then store in $answer variable to return answer through another method
    public function math($operator, $integer1, $integer2){
        switch ($operator){
            case "+": $this->answer=$integer1 + $integer2; return $this->returnAnswer($operator, $integer1, $integer2);
            case "-": $this->answer=$integer1 - $integer2; return $this->returnAnswer($operator, $integer1, $integer2);
            case "*": $this->answer=$integer1 * $integer2; return $this->returnAnswer($operator, $integer1, $integer2);
            case "/": return $this->divide($operator, $integer1, $integer2);
        }
    }

    //special method to handle division esp. by 0
    public function divide($operator, $integer1, $integer2){
        if ($integer2 == 0){
            return "Cannot divide by zero";
        }
        else {
            $this->answer=$integer1 / $integer2;
            return "The division of the numbers is ".$this->answer;
        }
    }

    //method to return answers based on operator
    public function returnAnswer($operator, $integer1, $integer2){
        switch ($operator){
            case "+": return "The sum of the numbers is ".$this->answer;
            case "-": return "The difference of the numbers is ".$this->answer;
            case "*": return "The product of the numbers is ".$this->answer;
        } 
    }

    //method to call all other methods beginning with verifying entries
    public function calc($operator = null, $integer1 = null, $integer2 = null){
        return $this->verify($operator, $integer1, $integer2);
    
    }

}


?>

