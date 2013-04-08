<?php

interface TableIf
{
	public function get_table_names();
	public function get_table_regions($table_name);
	public function enable_table($table_name);
	public function disable_table($table_name);
	public function is_table_enabled($table_name);
	public function create_table($table_name, $column_families);
	public function delete_table($table_name);
}

class Hbase_table_model extends CI_Model
{
	public $hbase_host;
	public $hbase_port;
	public $socket;
	public $transport;
	public $protocol;
	public $hbase;
	
	public function __construct()
	{ 
		parent::__construct();
		$GLOBALS['THRIFT_ROOT'] = __DIR__ . "/../../libs/";
		include_once $GLOBALS['THRIFT_ROOT'] . 'packages/Hbase/Hbase.php';
		include_once $GLOBALS['THRIFT_ROOT'] . 'transport/TSocket.php';
		include_once $GLOBALS['THRIFT_ROOT'] . 'protocol/TBinaryProtocol.php';
		
		$this->hbase_host = $this->config->item('hbase_host');
		$this->hbase_port = $this->config->item('hbase_port');
		$this->socket = new TSocket($this->hbase_host, $this->hbase_port);
		$this->socket->setSendTimeout(30000);
		$this->socket->setRecvTimeout(30000);
		$this->transport = new TBufferedTransport($this->socket);
		$this->protocol = new TBinaryProtocol($this->transport);
		$this->hbase = new HbaseClient($this->protocol);
	}
	
	public function get_table_names()
	{
		try
		{
			$this->transport->open();
			$table_names_array = $this->hbase->getTableNames();
			$this->transport->close();
			return $table_names_array;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: '.  $e->getMessage(). "\n";
		}
	}
	
	public function get_table_regions($table_name)
	{
		try
		{
			$this->transport->open();
			$regions = $this->hbase->getTableRegions($table_name);
			$this->transport->close();
			return $regions;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: '.  $e->getMessage(). "\n";
		}
	}
	
	public function enable_table($table_name)
	{
		try
		{
			$this->transport->open();
			$this->hbase->enableTable($table_name);
			$this->transport->close();
		}
		catch (Exception $e)
		{
			echo 'Caught exception: '.  $e->getMessage(). "\n";
		}
	}
	
	public function disable_table($table_name)
	{
		try
		{
			$this->transport->open();
			$this->hbase->disableTable($table_name);
			$this->transport->close();
		}
		catch (Exception $e)
		{
			echo 'Caught exception: '.  $e->getMessage(). "\n";
		}
	}
	
	public function is_table_enabled($table_name)
	{
		try
		{
			$this->transport->open();
			$bool = $this->hbase->isTableEnabled($table_name);
			$this->transport->close();
			return $bool;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: '.  $e->getMessage(). "\n";
		}
	}
	
	public function create_table($table_name, $column_families)
	{
		try
		{
			$this->transport->open();
			$bool = $this->hbase->createTable($table_name, $column_families);
			$this->transport->close();
			return $bool;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: '.  $e->getMessage(). "\n";
		}
	}
	
	public function delete_table($table_name)
	{
		try
		{
			$this->transport->open();
			$bool = $this->hbase->deleteTable($table_name, $column_families);
			$this->transport->close();
			return $bool;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: '.  $e->getMessage(). "\n";
		}
	}
}

?>