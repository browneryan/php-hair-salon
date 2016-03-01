<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once 'src/Stylist.php';
	require_once 'src/Client.php';

	$server = 'mysql:host=localhost;dbname=hair_salon_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	class StylistTest extends PHPUnit_Framework_TestCase
	{

		protected function tearDown()
	    {
	        Stylist::deleteAll();
	    }

		function test_getStylistName()
        {
            //Arrange
            $name = "Maurice";
            $test_Stylist = new Stylist($name);

            //Act
            $result = $test_Stylist->getStylistName();

            //Assert
            $this->assertEquals($name, $result);
        }

		function test_getId()
        {
            //Arrange
            $name = "Maurice";
            $id = 1;
            $test_Stylist = new Stylist($name, $id);

            //Act
            $result = $test_Stylist->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

		function test_save()
		{
			//Arrange
			$name = "Maurice";
			$test_Stylist = new Stylist($name);

			//Act
			$test_Stylist->save();

			//Assert
			$result = Stylist::getAll();
			$this->assertEquals($test_Stylist, $result[0]);
		}

		function test_getAll()
		{
		    //Arrange
		    $name = "Maurice";
		    $name2 = "Erica";
		    $test_Stylist = new Stylist($name);
		    $test_Stylist->save();
		    $test_Stylist2 = new Stylist($name2);
		    $test_Stylist2->save();

		    //Act
		    $result = Stylist::getAll();

		    //Assert
		    $this->assertEquals([$test_Stylist, $test_Stylist2], $result);
		}

		function test_deleteAll()
		{
			//Arrange
		    $name = "Maurice";
		    $name2 = "Erica";
		    $test_Stylist = new Stylist($name);
		    $test_Stylist->save();
		    $test_Stylist2 = new Stylist($name2);
		    $test_Stylist2->save();

		    //Act
		    Stylist::deleteAll();
			$result = Stylist::getAll();

		    //Assert
		    $this->assertEquals([], $result);
		}

		function test_find()
        {
            //Arrange
			$name = "Maurice";
		    $name2 = "Erica";
		    $test_Stylist = new Stylist($name);
		    $test_Stylist->save();
		    $test_Stylist2 = new Stylist($name2);
		    $test_Stylist2->save();

            //Act
            $result = Stylist::find($test_Stylist->getId());

            //Assert
            $this->assertEquals($test_Stylist, $result);
        }

		function test_update()
		{
		    //Arrange
			$name = "Maurice";
			$id = null;
			$test_Stylist = new Stylist($name);
			$test_Stylist->save();

		    $new_name = "Candace";

		    //Act
		    $test_Stylist->update($new_name);

		    //Assert
		    $this->assertEquals("Candace", $test_Stylist->getStylistName());
		}

		function test_delete()
		{
		    //Arrange
			$name = "Maurice";
		    $name2 = "Erica";
		    $test_Stylist = new Stylist($name);
		    $test_Stylist->save();
		    $test_Stylist2 = new Stylist($name2);
		    $test_Stylist2->save();

		    //Act
		    $test_Stylist->delete();

		    //Assert
		    $this->assertEquals([$test_Stylist2], Stylist::getAll());
		}
		function test_getClients()
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
            $result = $test_Stylist->getClients();
            //Assert
            $this->assertEquals([$test_Client, $test_Client2], $result);
        }


	}

?>
