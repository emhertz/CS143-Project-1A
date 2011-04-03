<html>
<body>
<h1>Calculator</h1>
<p>Type an expression in the following box (e.g. 10.5+20*3/25).</p>

<form action="calculator.php" method="post">
Expression: <input type="text" name="expr"/>
<input type="submit"/>
</form>

<ul>
<li>Only numbers and +,-,*, and / operators are allowed in the expression.
<li>The evaluation follows standard order of operations.
<li>The calculator does not support parenthesis.
<li>The calculator will output intelligent error messages.
</ul>

<?
   $express = $_POST["expr"];
   $eqn = $express;
   if( $express == "" ) {
      echo "No expression detected.";
   } else {
      $err = 0;
      $div_zero = 0;
      # check for division by zero
      $err |= preg_match("/[0]\/[0]/",$express);
      if($err != 0) {
         $div_zero = 1;
      }
      # check for --, replace it with a +
      $express = preg_replace("/--/","+",$express);
      # check for parentheses
      $err |= preg_match("/[()]/",$express);
      # check for any non-digit or math operators
      $err |= preg_match("/[^0-9+\/\-\.\*]/",$express);
      
      if($err != 0) {
         if( $div_zero != 0 ) {
            echo "<p>Division by zero detected.";
         } else {
            echo "<p>Invalid expression: " . $eqn;
         }
      } else {
         # suppress error output
         $test = @eval("\$res =" . $express . ";");
         # check for any parse errors that the regexes missed
         if(error_get_last()) {
            echo "<p>Invalid expression: " . $eqn;
         } else {
            echo "<p>Result: " . $res;
         }
      }
   }
?>

</body>
</html>
