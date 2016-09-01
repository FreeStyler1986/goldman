<?php
    require_once('MyPDO.php');

    class App{
        const EMAIL_ROW_MASK = "Email address: %s \n";
        const TABLE_ROW_MASK = "| %-10.10s | %6.6s |\n";

        private $dbh;

        public function __construct(){
            $this->dbh = new MyPDO();
        }

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