# FormVerify
A simple PHP form verification class.

# Usage
You can use FormVerify simply:
<pre>require("formverify.php");
$fv = new FormVerify();
$username = "Bobrocket";
$results = $fv -> verify($username, array("type" => "string", "length" => "8-20")); //Will return an array() of booleans, or FALSE
if (is_array($results))
{
  echo "Is 'username' a string? - " . ($results["type"] ? "yes" : "no");
  echo "Is 'username' within the length 8-20? - " . ($results["length"] ? "yes" : "no");
}
else
{
  echo "Error :(";
}
</pre>

#Parameters
The <b>verify</b> function requires an array for what to check for:
<ul>
  <li>"type" - This will do a basic type check. Supports: <b>string</b>, <b>number</b>, <b>integer</b>. This will return the result of is_x() (string, numeric, int).</li>
  <li>"length" - This will check the length. You can do a single number, e.g <b>8</b>, or a range such as <b>"8-20"</b>. If the field is outside the length range, it will return FALSE.</li>
  <li>"types" - This will check the field for whatever you specify. This is an array, and supports: <b>lowercase</b>, <b>uppercase</b>, <b>number</b>, <b>symbol</b>. If something outside of the character sets is found, it will return FALSE.</li>
</ul>
# Character checking
To check for a specific charset, you can do this:
<pre>require("formverify.php");
$fv = new FormVerify();
$test = "v4";
$results = $fv -> verify($test, array("types" => array("number", "lowercase")));
if (is_array($results))
{
  echo "Does 'test' have lowercase letters and numbers? - " . ($results["char"] ? "yes" : "no");
}
else
{
  echo "Error :(";
}</pre>
#Real life examples
Checking for a name:
<pre>$results = $fv -> verify($name, array("type" => "string", "length" => "2-20", "types" => array("lowercase", "uppercase")));</pre>
This will return TRUE for names such as <b>Adam</b>, but not for things like <b>xXxPussyDestroyer420BlazedxXx</b>.
Checking for numbers:
<pre>$results = $fv -> verify($_GET['id'], array("type" => "int", "types" => array("number")));</pre>
Obviously, this is not efficient for something like a GET parameter, as you can just cast it to an int. This is more for when you need to validate and verify what's inside a form field.
