
<html>
<body>

<?php

require_once('EFWebServiceManager.php');


echo "Testing <b>disambiguateText</b><br/>";
echo "[INPUT] testing for Bill Gates<br/>";
$theresponse = EFWebServiceManager::getInstance()->disambiguateText("testing for Bill Gates", NULL);
if ($theresponse->has_error){
	echo "[ERROR] " . $theresponse->error_msg;
}
else {
	echo "[RESULT] Number of entities: " . count($theresponse->entities);
}
echo "<br/><br/>";


echo "Testing <b>disambiguateShortText</b><br/>";
echo "[INPUT] testing for Bill Gates<br/>";
$theresponse = EFWebServiceManager::getInstance()->disambiguateShortText("testing for Bill Gates", NULL);
if ($theresponse->has_error){
	echo "[ERROR] " . $theresponse->error_msg;
}
else {
	echo "[RESULT] Number of entities: " . count($theresponse->entities);
}
echo "<br/><br/>";


echo "Testing <b>disambiguateTermVector</b><br/>";
echo "[INPUT] computer science<br/>";
$theresponse = EFWebServiceManager::getInstance()->disambiguateTermVector(array(array('EFTerm' => 'computer science', 'score' => 0.3)), "en");
if ($theresponse->has_error){
	echo "[ERROR] " . $theresponse->error_msg;
}
else {
	echo "[RESULT] Number of terms: " . count($theresponse->terms);
}
echo "<br/><br/>";


echo "Testing <b>disambiguatePDF</b><br/>";
$theresponse = EFWebServiceManager::getInstance()->disambiguatePDF("sample.pdf", "en");
if ($theresponse->has_error){
	echo "[ERROR] " . $theresponse->error_msg;
}
else {
	echo $theresponse->runtime;
}
echo "<br/><br/>";


echo "Testing <b>concept</b><br/>";
echo "[INPUT] concept id: 3747<br/>";
$theresponse = EFWebServiceManager::getInstance()->concept(3747, NULL);
if ($theresponse->has_error){
	echo "[ERROR] " . $theresponse->error_msg;
}
else {
	echo "[RESULT] Concept name: " . $theresponse->raw_name;
}
echo "<br/><br/>";


echo "Testing <b>term</b><br/>";
echo "[INPUT] science<br/>";
$theresponse = EFWebServiceManager::getInstance()->term("science", NULL);
if ($theresponse->has_error){
	echo "[ERROR] " . $theresponse->error_msg;
}
else {
	echo "[RESULT] Language: " . $theresponse->lang;
}
echo "<br/><br/>";


echo "Testing <b>language</b><br/>";
echo "[INPUT] This is a sentence in plain English<br/>";
$theresponse = EFWebServiceManager::getInstance()->language("This is a sentence in plain English");
if ($theresponse->has_error){
	echo "[ERROR] " . $theresponse->error_msg;
}
else {
	echo "[RESULT] Language: " . $theresponse->lang;
}
echo "<br/><br/>";


echo "Testing <b>segmentation</b><br/>";
echo "[INPUT] This is the first sentence. And this is the second one!<br/>";
$theresponse = EFWebServiceManager::getInstance()->segmentation("This is the first sentence. And this is the second one!");
if ($theresponse->has_error){
	echo "[ERROR] " . $theresponse->error_msg;
}
else {
	echo "[RESULT] Number of sentences: " . count($theresponse->sentences);
}
echo "<br/><br/>";

?>

</body>
</html>
