<?php
    class Address
    {
        private $line_1;
        private $line_2;

        function __construct($line_1, $line_2)
        {
            $this->line_1 = $line_1;
            $this->line_2 = $line_2;
        }

        function getLine1()
        {
            return $this->line_1;
        }

        function getLine2()
        {
            return $this->line_2;
        }
    }
