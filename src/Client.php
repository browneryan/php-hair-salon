<?php
    class Client
    {
        private $client_name;
        private $id;
        private $stylist_id;

        function __construct($client_name, $id = null, $stylist_id)
        {
            $this->client_name = $client_name;
            $this->id = $id;
            $this->stylist_id = $stylist_id;
        }

        function getClientName()
    	{
            return $this->client_name;
        }

        function setClientName($new_client_name)
		{
			$this->client_name = (string) $new_client_name;
		}

        function getClientId()
        {
            return $this->id;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getClientName()}', '{$this->stylist_id}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
	    {
	        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
	        $clients = array();
	        foreach($returned_clients as $client) {
	            $name = $client['name'];
				$id = $client['id'];
                $stylist_id = $client['stylist_id'];
	            $new_client = new Client($name, $id, $stylist_id);
	            array_push($clients, $new_client);
	        }
	        return $clients;
	    }

        static function deleteAll()
		{
		    $GLOBALS['DB']->exec("DELETE FROM clients;");
		}

        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach($clients as $client) {
                $client_id = $client->getClientId();
                if ($client_id == $search_id) {
                  $found_client = $client;
                }
            }
            return $found_client;
        }

        function update($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getClientId()};");
    		$this->setClientName($new_name);
		}

        function delete()
		{
			$GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getClientId()};");
		}

    }
 ?>
