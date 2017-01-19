<?php 

/**
*  Corresponding Class to test YourClass class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author yourname
*/
class YourClassTest extends PHPUnit_Framework_TestCase{
	
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testIsThereAnySyntaxError(){
  $var = new Hrmisapi\Hrmisapi("https://perkongsiandata.eghrmis.gov.my/wsintegrasi/dataservice.asmx","801109015565","mdridzuan@123");
	$this->assertTrue(is_object($var));
	unset($var);
  }
  
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testMethod1(){
  $var = new Hrmisapi\Hrmisapi("https://perkongsiandata.eghrmis.gov.my/wsintegrasi/dataservice.asmx","801109015565","ridzuan@123");
  $this->assertTrue($var->GetUserInfo()->xml() == true);
	unset($var);
  }
  
}