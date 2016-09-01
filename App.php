<?php
    require_once('MyPDO.php');

    class App{
        /**
         * @const string
         */
        const EMAIL_ROW_MASK = "Email address: %s \n";
        /**
         * @const string
         */
        const TABLE_ROW_MASK = "| %-10.10s | %6.6s |\n";

        /**
         * @var MyPDO
         */
        private $dbh;

        /**
         * Create a new App instance.
         *
         * @return App
         */
        public function __construct(){
            $this->dbh = new MyPDO();
        }

        /**
         * Get the amounts for the specified email address
         *
         * @param  string  $email
         * @return PDOStatement
         */
        private function getAmountsByEmail($email){
            $sth = $this->dbh->prepare('
                SELECT s.day, SUM(s.amount) AS amount FROM user AS u
                INNER JOIN banner AS b ON u.id=b.user_id
                INNER JOIN statistic AS s ON b.id=s.banner_id
                WHERE u.email = :email
                GROUP BY s.day
                ORDER BY s.day
            ');

            $params = array(':email' => $email);
            $sth->execute($params);
            return $sth;
        }

        /**
         * List the amount of banner ads for the specified user by email address
         *
         * @param  string  $email
         * @return void
         */
        public function drawList($email){
            $sth = $this->getAmountsByEmail($email);

            printf(self::EMAIL_ROW_MASK, $email);
            printf(self::TABLE_ROW_MASK, '    Day', 'Amount');

            while ($result = $sth->fetch(PDO::FETCH_OBJ)){
                printf(self::TABLE_ROW_MASK, $result->day, $result->amount);
            }
        }
    }

    $app = new App();
    $app->drawList('modulebugbear@randomthings.com');