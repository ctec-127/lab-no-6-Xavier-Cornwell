<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Lab No. 6 - Temp. Converter</title>
</head>
<body>

<?php
// function to calculate converted temperature
function convertTemp($temp, $unit1, $unit2)
{
    $newtemp = 0;
    // conversion formulas
 if ($temp != '') {    
    if ($unit1 == $unit2) {
        $newtemp = (float)$temp;
       
    }
    // Celsius to Fahrenheit = T(°C) × 9/5 + 32
    // Celsius to Kelvin = T(°C) + 273.15
    elseif ($unit1 == 'celsius') {
        if ($unit2 == 'farenheit') {
            $newtemp = $temp * 9/5 +32;
        }
        elseif ($unit2 == 'kelvin') {
            $newtemp = $temp + 273.15;
        }
    }
    // Fahrenheit to Celsius = (T(°F) - 32) × 5/9
    // Fahrenheit to Kelvin = (T(°F) + 459.67)× 5/9
    elseif ($unit1 == 'farenheit') {
        if ($unit2 == 'celsius') {
            $newtemp = ($temp - 32) * 5/9;
        }
        if ($unit2 == 'kelvin') {
            $newtemp = ($temp + 459.67)* 5/9;  
        }
    }
    // Kelvin to Fahrenheit = T(K) × 9/5 - 459.67
    // Kelvin to Celsius = T(K) - 273.15
    elseif ($unit1=='kelvin') {
        if ($unit2 == 'farenheit') {
            $newtemp = $temp * 9/5 - 459.67;
        }
        elseif ($unit2 == 'celsius') {
            $newtemp = $temp - 273.15;
        }
    }
}
else{
    return;
}

return $newtemp;
    // You need to develop the logic to convert the temperature based on the selections and input made

} // end function

// Logic to check for POST and grab data from $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store the original temp and units in variables
    // You can then use these variables to help you make the form sticky
    // then call the convertTemp() function
    // Once you have the converted temperature you can place PHP within the converttemp field using PHP
    // I coded the sticky code for the originaltemp field for you

    $originalTemperature = $_POST['originaltemp'];
    $originalUnit = $_POST['originalunit'];
    $conversionUnit = $_POST['conversionunit'];
    $convertedTemp = '';
    if ($originalUnit != '--Select--' && $conversionUnit !='--Select--') {
        $convertedTemp = convertTemp($originalTemperature, $originalUnit, $conversionUnit);    
    } else {

        echo '<p>CHOOSE I BEG OF YOU!</p>';

    }
    $type = gettype($convertedTemp);
} // end if

  
  if (isset($_POST['originalunit'])){
    $originUnit = $_POST['originalunit'];
  } else {

    $$originUnit = "";
  } 

  if (isset($_POST['conversionunit'])){
    $conUnit = $_POST['conversionunit'];
  } else {
    // looks like the form wasn't being posted
    $conUnit = "";
  } // end if
?>
<!-- Form starts here -->
<h1>Temperature Converter</h1>
<h4>CTEC 127 - PHP with SQL 1</h4>
<form method="POST" action="<?php if ($convertedTemp) {
}
echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <div class="group">
        <label for="temp">Temperature</label>
        <input type="text" value="<?php if (isset($_POST['originaltemp'])) {
    echo $_POST['originaltemp'];
}
else{
    echo'';
}
?>" name="originaltemp" size="14" maxlength="7" id="temp">

        <select name="originalunit">
            <option value="--Select--"<?php if($originUnit == "--Select--") echo ' selected="selected"';?>>--Select--</option>
            <option value="celsius"<?php if($originUnit == "celsius") echo ' selected="selected"';?>>Celsius</option>
            <option value="farenheit"<?php if($originUnit == "farenheit") echo ' selected="selected"';?>>Farenheit</option>
            <option value="kelvin"<?php if($originUnit == "kelvin") echo ' selected="selected"';?>>Kelvin</option>
        </select>
    </div>

    <div class="group">
        <label for="convertedtemp">Converted Temperature</label>
       
        <input type="text" value="<?php if ($type == 'integer' || $type == 'float'|| $type == 'double') {
           echo $convertedTemp;
        }
        else echo '';
        ?>"
        name="convertedtemp" size="14" maxlength="7" id="convertedtemp" readonly>
        <select name="conversionunit">
        <option value="--Select--"<?php if($conUnit == "--Select--") echo ' selected="selected"';?>>--Select--</option>
            <option value="celsius"<?php if($conUnit == "celsius") echo ' selected="selected"';?>>Celsius</option>
            <option value="farenheit"<?php if($conUnit == "farenheit") echo ' selected="selected"';?>>Farenheit</option>
            <option value="kelvin"<?php if($conUnit == "kelvin") echo ' selected="selected"';?>>Kelvin</option>
        </select>
    </div>
    <input type="submit" value="Convert"/>
</form>
</body>
</html>