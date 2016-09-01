<?php
    class MyPDO extends PDO{
        /**
         * @const string
         */
        const PARAM_host='localhost';
        /**
         * @const int
         */
        const PARAM_port='3306';
        /**
         * @const string
         */
        const PARAM_db_name='goldman';
        /**
         * @const string
         */
        const PARAM_user='root';
        /**
         * @const string
         */
        const PARAM_db_pass='';

        /**
         * Create a new App instance.
         *
         * @param  array  $options
         * @return MyPDO
         */
        public function __construct($options=null){
            parent::__construct('mysql:host='.self::PARAM_host.';port='.self::PARAM_port.';dbname='.self::PARAM_db_name,
                self::PARAM_user,
                self::PARAM_db_pass,$options);
        }
    }