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
      echo "Expression detected: " . $express;
      $express = preg_replace("/[^0-9+\-.*\/()%]/","",$express);
      echo "<p>Expression now: " . $express;
      $express = preg_replace("/([+-])([0-9]{1})(%)/","*(1\$1.0\$2)",$express);
      echo "<p>Expression now: " . $express;
      $express = preg_replace("/([0-9]+)(%)/",".\$1",$express);
      echo "<p>Expression now: " . $express;
      if($express == "") {
         echo "<p>Invalid expression: " . $eqn;
      } else {
         eval("\$res =" . $express . ";");
         echo "<p>Result: " . $res;
      }
   }
?>

</body>
</html>
