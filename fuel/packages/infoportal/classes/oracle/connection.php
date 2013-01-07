<?php
/**
 * @created 07.01.13 - 20:45
 * @author stefanriedel
 */
namespace Infoportal;

class Oracle_ConnectionException extends \Fuel\Core\FuelException {}

class Oracle_Connection {

    /**
     * @var array connection data for this instance
     * @access protected
     */
    protected static $_connection_data = array();

    /**
     * @var resource The connection resource
     * @access protected
     */
    protected $_conn = null;
    /**
     * @var resource The statement resource identifier
     * @access protected
     */
    protected $_stid = null;
    /**
     * @var integer The number of rows to prefetch with queries
     * @access protected
     */
    protected $_prefetch = 100;

    public static function forge($schema = 'default') {
        \Config::load('oracle', true);
        static::$_connection_data = \Config::get('oracle.' . $schema, false);

        return new static(static::$_connection_data['client_info'], static::$_connection_data['schema'], static::$_connection_data['password'], static::$_connection_data['database'], static::$_connection_data['charset']);
    }

    /**
     * Constructor opens a connection to the database
     * @param string $module Module text for End-to-End Application Tracing
     * @param string $cid Client Identifier for End-to-End Application Tracing
     * @param string $schema Username
     * @param string $password Password
     * @param string $database The database
     * @param string $charset Charset
     */
    public function __construct($client_info, $schema, $password, $database, $charset) {
        $this->_conn = oci_pconnect($schema, $password, $database, $charset);
        if (!$this->_conn) {
            $m = oci_error();
            throw new Oracle_ConnectionException('Cannot connect to database: ' . $m['message']);
        }
        // Record the "name" of the web user, the client info and the module.
        // These are used for end-to-end tracing in the DB.
        oci_set_client_info($this->_conn, $client_info);
    }

    /**
     * Destructor closes the statement and connection
     */
    public function __destruct() {
        if ($this->_stid)
            oci_free_statement($this->_stid);
        if ($this->_conn)
            oci_close($this->_conn);
    }

    /**
     * Run a SQL or PL/SQL statement
     *
     * Call like:
     *     Db::execute("insert into mytab values (:c1, :c2)",
     *                 "Insert data", array(array(":c1", $c1, -1),
     *                                      array(":c2", $c2, -1)))
     *
     * For returned bind values:
     *     Db::execute("begin :r := myfunc(:p); end",
     *                 "Call func", array(array(":r", &$r, 20),
     *                                    array(":p", $p, -1)))
     *
     * Note: this performs a commit.
     *
     * @param string $sql The statement to run
     * @param string $action Action text for End-to-End Application Tracing
     * @param array $bindvars Binds. An array of (bv_name, php_variable, length)
     */
    public function execute($sql, $action, $bindvars = array()) {
        $this->_stid = oci_parse($this->_conn, $sql);
        if ($this->_prefetch >= 0) {
            oci_set_prefetch($this->_stid, $this->_prefetch);
        }
        foreach ($bindvars as $bv) {
            // oci_bind_by_name(resource, bv_name, php_variable, length)
            oci_bind_by_name($this->_stid, $bv[0], $bv[1], $bv[2]);
        }
        oci_set_action($this->_conn, $action);
        oci_execute($this->_stid);              // will auto commit
    }

    /**
     * Run a query and return all rows.
     *
     * @param string $sql A query to run and return all rows
     * @param string $action Action text for End-to-End Application Tracing
     * @param array $bindvars Binds. An array of (bv_name, php_variable, length)
     * @return array An array of rows
     */
    public function fetchAll($sql, $bindvars = array(), $action="Fetch All") {
        $this->execute($sql, $action, $bindvars);
        oci_fetch_all($this->_stid, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
        $this->_stid = null;  // free the statement resource
        return($res);
    }

    public function fetch($sql, $bindvars = array(), $action="Fetch One") {
        $this->execute($sql, $action, $bindvars);
        $res = oci_fetch_array ($this->_stid, (OCI_ASSOC+OCI_RETURN_NULLS));
        $this->_stid = null;  // free the statement resource
        return($res);
    }
}