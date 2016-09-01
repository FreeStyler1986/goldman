<?php
    $dbh = new PDO("mysql:host=localhost;dbname=goldman", 'root', '');

    $sth = $dbh->prepare('
        SELECT s.day, SUM(s.amount) AS amount FROM user AS u
        INNER JOIN banner AS b ON u.id=b.user_id
        INNER JOIN statistic AS s ON b.id=s.banner_id
        WHERE u.email = :email
        GROUP BY s.day
        ORDER BY s.day
    ');

    $params = array(':email' => 'modulebugbear@randomthings.com');
    $sth->execute($params);

    $mask = "| %-10.10s | %6.6s |\n";
    printf($mask, '    Day', 'Amount');

    while ($result = $sth->fetch(PDO::FETCH_OBJ))
    {
        printf($mask, $result->day, $result->amount);
    }