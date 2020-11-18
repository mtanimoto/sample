<?php

class End extends Nav
{
    private static $_instance;

    protected function __construct()
    {
    }

    public function printContent(): void
    {
        exit(0);
    }
}
