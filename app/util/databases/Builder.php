<?php

namespace app\util\databases;


class Builder{

    private string $execType="SELECT";

    private  string  $fromTable;

    private   string $sql;

    private  array  $where;

    private   array $join;   //[ joinTable, ]

    private array $orderBy ;

    private array $groupBy ;

    private array $having ;



}
