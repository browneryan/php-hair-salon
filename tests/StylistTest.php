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

		protected function tearDown()
	    {
	        Stylist::deleteAll();
	    }

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

		function test_save()
		{
			//Arrange
			$stylist_name = "Maurice";
			$test_stylist = new Stylist($stylist_name);

			//Act
			$test_stylist->save();

			//Assert
			$result = Stylist::getAll();
			$this->assertEquals($test_stylist, $result[0]);
		}

		function test_getAll()
		{
		    //Arrange
		    $stylist_name = "Maurice";
		    $stylist_name2 = "Erica";
		    $test_stylist = new Stylist($stylist_name);
		    $test_stylist->save();
		    $test_stylist2 = new Stylist($stylist_name2);
		    $test_stylist2->save();

		    //Act
		    $result = Stylist::getAll();

		    //Assert
		    $this->assertEquals([$test_stylist, $test_stylist2], $result);
		}

		function test_deleteAll()
		{
			//Arrange
		    $stylist_name = "Maurice";
		    $stylist_name2 = "Erica";
		    $test_stylist = new Stylist($stylist_name);
		    $test_stylist->save();
		    $test_stylist2 = new Stylist($stylist_name2);
		    $test_stylist2->save();

		    //Act
		    Stylist::deleteAll();

		    //Assert
		    $result = Stylist::getAll();
		    $this->assertEquals([], $result);
		}

	}

?>
