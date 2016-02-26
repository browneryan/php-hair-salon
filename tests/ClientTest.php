<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once 'src/Client.php';
	require_once 'src/Client.php';

	$server = 'mysql:host=localhost;dbname=hair_salon_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	class ClientTest extends PHPUnit_Framework_TestCase
	{
		function test_getClientName()
        {
            //Arrange
            $name = "Ralph";
			$stylist_id = 1;
            $test_Client = new Client($name, $id = null, $stylist_id);

            //Act
            $result = $test_Client->getClientName();

            //Assert
            $this->assertEquals($name, $result);
        }

		function test_getClientId()
        {
            //Arrange
            $name = "Maurice";
            $id = 1;
            $test_Client = new Client($name, $id, $stylist_id = null);

            //Act
            $result = $test_Client->getClientId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

		function test_getStylistId()
        {
            //Arrange
            $name = "Maurice";
            $id = null;
			$stylist_id = 1;
            $test_Client = new Client($name, $id, $stylist_id);

            //Act
            $result = $test_Client->getStylistId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
	}

?>
