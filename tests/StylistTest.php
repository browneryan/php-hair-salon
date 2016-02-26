<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once 'src/Stylist.php';

	$server = 'mysql:host=localhost;dbname=hair_salon_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	class StylistTest extends PHPUnit_Framework_TestCase
	{

		function test_getStylistName()
        {
            //Arrange
            $stylist_name = "Maurice";
            $test_Stylist = new Stylist($stylist_name);

            //Act
            $result = $test_Stylist->getStylistName();

            //Assert
            $this->assertEquals($stylist_name, $result);
        }

		function test_getStylistId()
        {
            //Arrange
            $stylist_name = "Maurice";
            $id = 1;
            $test_Stylist = new Stylist($stylist_name, $id);

            //Act
            $result = $test_Stylist->getStylistId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

	}

?>
