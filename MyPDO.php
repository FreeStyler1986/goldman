<?php
    class MyPDO extends PDO{

        const PARAM_host='localhost';
        const PARAM_port='3306';
        const PARAM_db_name='goldman';
        const PARAM_user='root';
        const PARAM_db_pass='';

        public function __construct($options=null){
            parent::__construct('mysql:host='.self::PARAM_host.';port='.self::PARAM_port.';dbname='.self::PARAM_db_name,
                self::PARAM_user,
                self::PARAM_db_pass,$options);
        }
    }