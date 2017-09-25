<?php

class Title{

  public $title;

  public function __destruct(){
    echo "";
  }

  protected function thirr(){
    echo "*";
  }
}

//pjesa 3
class Info extends Title{

 /* Variabla */
 private $value;
 
 /* Funksionet */

 public function __construct($par){

  $this->value = $par;
  $this->thirr();

 }

 public function getValue(){

  echo $this->value;

 }
}

function __get($title)

{

  return $this->title;

}

function __set($title,$value)

{

  $this->title = $value;

}

$q=$_GET["user"];

$xmlDoc = new DOMDocument();
$xmlDoc->load("user_list.xml");

$x=$xmlDoc->getElementsByTagName('NAME');

for ($i=0; $i<=$x->length-1; $i++) {
  //Process only element nodes
  if ($x->item($i)->nodeType==1) {
    if ($x->item($i)->childNodes->item(0)->nodeValue == $q) {
      $y=($x->item($i)->parentNode);
    }
  }
}

$user=($y->childNodes);

$title = new Title;
$title->title="User info";

echo("<span style='color: gray; margin-left: 50px;'>");
echo($title->title);
echo("</span><br><br>");

for ($i=0;$i<$user->length;$i++) { 
  //Process only element nodes
  if ($user->item($i)->nodeType==1) {

    $useri= new Info($user->item($i)->childNodes->item(0)->nodeValue);

    echo($user->item($i)->nodeName . ": <span style='color: #780;'>");
    echo($useri->getValue());
    echo("</span>");

    if($user->item($i)->nodeName=="EMAIL")
    {
      echo "<input type='submit' name='sub' value='email'>";
      echo"<input type='hidden' name='email' value='".$user->item($i)->childNodes->item(0)->nodeValue."'>";
    }
    echo("<br>");
  }
}
echo("<br>");
?>