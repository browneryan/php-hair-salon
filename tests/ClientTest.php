<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once 'src/Client.php';
	require_once 'src/Stylist.php';

	$server = 'mysql:host=localhost;dbname=hair_salon_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	class ClientTest extends PHPUnit_Framework_TestCase
	{

		protected function tearDown()
	    {
	        Client::deleteAll();
			Stylist::deleteAll();
	    }

		function test_getClientName()
        {
            //Arrange
			$name = "Maurice";
			$id = null;
			$test_Stylist = new Stylist($name, $id);
			$test_Stylist->save();

			$client_name = "Jake";
			$id = null;
			$stylist_id = $test_Stylist->getId();
            $test_Client = new Client($client_name, $id, $stylist_id);
			$test_Client->save();

            //Act
            $result = $test_Client->getClientName();

            //Assert
            $this->assertEquals($client_name, $result);
        }

		function test_getClientId()
        {
            //Arrange
			$name = "Maurice";
			$id = null;
			$test_Stylist = new Stylist($name, $id);
			$test_Stylist->save();

            $client_name = "Jake";
			$id = null;
			$stylist_id = $test_Stylist->getId();
            $test_Client = new Client($client_name, $id, $stylist_id);
			$test_Client->save();
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
			$test_Stylist = new Stylist($name, $id);
			$test_Stylist->save();

            $client_name = "Jake";
			$id = null;
			$stylist_id = $test_Stylist->getId();
            $test_Client = new Client($client_name, $id, $stylist_id);
			$test_Client->save();

            //Act
            $result = $test_Client->getStylistId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

		function test_save()
		{
			//Arrange
			$name = "Maurice";
			$test_Stylist = new Stylist($name, $id = null);
			$test_Stylist->save();

			$client_name = "Jake";
			$stylist_id = $test_Stylist->getId();
			$test_Client = new Client($client_name, $id = null, $stylist_id);
			$test_Client->save();

			//Act
			$result = Client::getAll();

			//Assert
			$this->assertEquals($test_Client, $result[0]);
		}

		function test_getAll()
		{
			//Arrange
			$name = "Maurice";
			$test_Stylist = new Stylist($name, $id = null);
			$test_Stylist->save();

			$client_name = "Jake";
			$stylist_id = $test_Stylist->getId();
			$test_Client = new Client($client_name, $id = null, $stylist_id);
			$test_Client->save();

			$client_name2 = "Miranda";
			$stylist_id = $test_Stylist->getId();
			$test_Client2 = new Client($client_name2, $id = null, $stylist_id);
			$test_Client2->save();

			//Act
			$result = Client::getAll();

			//Assert
			$this->assertEquals([$test_Client, $test_Client2], $result);
		}

		function test_deleteAll()
		{
			//Arrange
			$name = "Maurice";
			$id = null;
			$test_Stylist = new Stylist($name, $id);
			$test_Stylist->save();

			$client_name = "Jake";
			$stylist_id = $test_Stylist->getId();
			$test_Client = new Client($client_name, $id, $stylist_id);
			$test_Client->save();

			$client_name2 = "Miranda";
			$stylist_id2 = $test_Stylist->getId();
			$test_Client2 = new Client($client_name2, $id2 = null, $stylist_id2);
			$test_Client2->save();

			//Act
			Client::deleteAll();
			$result = Client::getAll();

			//Assert
			$this->assertEquals([], $result);
		}

		function test_find()
		{
			//Arrange
			$name = "Maurice";
			$test_Stylist = new Stylist($name, $id = null);
			$test_Stylist->save();

			$client_name = "Jake";
			$stylist_id = $test_Stylist->getId();
			$test_Client = new Client($client_name, $id, $stylist_id);
			$test_Client->save();

			$client_name2 = "Miranda";
			$stylist_id2 = $test_Stylist->getId();
			$test_Client2 = new Client($client_name2, $id2 = null, $stylist_id2);
			$test_Client2->save();

			//Act
			$result = Client::find($test_Client->getClientId());

			//Assert
			$this->assertEquals($test_Client, $result);
		}

		function test_update()
		{
			//Arrange
			$name = "Maurice";
			$test_Stylist = new Stylist($name, $id = null);
			$test_Stylist->save();

			$client_name = "Jake";
			$stylist_id = $test_Stylist->getId();
			$test_Client = new Client($client_name, $id, $stylist_id);
			$test_Client->save();

			$new_client_name = "Georgia";

			//Act
			$test_Client->update($new_client_name);

			//Arrange
			$this->assertEquals("Georgia", $test_Client->getClientName());
		}

		function test_delete()
		{
			//Arrange
			$name = "Maurice";
			$test_Stylist = new Stylist($name, $id = null);
			$test_Stylist->save();

			$client_name = "Jake";
			$stylist_id = $test_Stylist->getId();
			$test_Client = new Client($client_name, $id, $stylist_id);
			$test_Client->save();

			$client_name2 = "Miranda";
			$stylist_id2 = $test_Stylist->getId();
			$test_Client2 = new Client($client_name2, $id2 = null, $stylist_id2);
			$test_Client2->save();

			//Act
			$test_Client->delete();

			//Arrange
			$this->assertEquals([$test_Client2], Client::getAll());
		}

	}

?>
