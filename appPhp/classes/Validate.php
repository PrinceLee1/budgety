<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .pError{
            background:red;
            font-size:23px;
            color:white;
            height:50px
        }
    </style>
</head>
<body>
<?php
class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

            public function __construct() {
                $this->_db = DB::getInstance();
            }

            public function check($source, $items = array()) {
                foreach($items as $item => $rules){
                    foreach($rules as $rule =>$rule_value){

                        $value = trim($source[$item]);
                        $item = escape($item);
                        if($rule === 'required' && empty($value)){
                            $this->addError("<p  class='text-center pError'>{$item} is required.</p>");
                        }else if(!empty($value)){
                            switch($rule){
                                case 'min';
                                if(strlen($value) < $rule_value){
                                    $this->addError("<p class='text-center pError'>{$item} must be a minimum of {$rule_value} characters.</p>");
                                }
                            break;

                            case 'max';
                            if(strlen($value) > $rule_value){
                                $this->addError("<p class='text-center  pError'>{$item} must be a maximum of {$rule_value} characters.</p>");
                            }
                        break;

                        case 'valid';
                        if(!filter_var($item, FILTER_VALIDATE_EMAIL)){
                            $this->addError("<p class='text-center  pError'>{$item} must be a valid email address</p>");
                        }
                    break;

                        case 'matches';
                        if($value != $source[$rule_value]){
                            $this->addError("<p class='text-center  pError'>{$rule_value} must match {$item}.</p>");
                        }
                    break;

                    case 'unique';
                    $check = $this->_db->get($rule_value, array($item, '=', $value));
                    if($check->count()){
                        $this->addError("<p class='text-center  pError'>{$item} already exist.</p>");
                    }
                break;
                            }
                        }
                    }
                }
                if(empty($this->_errors)){
                    $this->_passed = true;
                }
                return $this;
            }

            private function addError($error) {
                $this->_errors[] =$error;
            }

            public function errors() {
                return $this->_errors;
            }
            public function passed() {
              return  $this->_passed;
            }
}
?>
</body>
</html>
