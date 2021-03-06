<?php

	class Stylist
	{

		private $stylist_name;
		private $id;

		function __construct($stylist_name, $id = null)
		{
			$this->stylist_name = $stylist_name;
			$this->id = $id;
		}

		function getStylistName()
		{
			return $this->stylist_name;
		}

		function setStylistName($new_stylist_name)
		{
			$this->stylist_name = (string) $new_stylist_name;
		}

		function getId()
		{
			return $this->id;
		}

		function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getStylistName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

		static function getAll()
	    {
	        $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
	        $stylists = array();
	        foreach($returned_stylists as $stylist) {
	            $name = $stylist['name'];
				$id = $stylist['id'];
	            $new_stylist = new Stylist($name, $id);
	            array_push($stylists, $new_stylist);
	        }
	        return $stylists;
	    }

		static function deleteAll()
		{
		    $GLOBALS['DB']->exec("DELETE FROM stylists;");
		}

		static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist) {
                if ($stylist->getId() == $search_id) {
                  $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }

		function update($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
    		$this->setStylistName($new_name);
		}

		function delete()
		{
			$GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
		}

		function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $id = $client['id'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($name, $id, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

	}

 ?>
