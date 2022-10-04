<?php
    // View class
    class View {
        // Attributes
        private $param;

        // constructor
        function __construct() {
            $this->param = array();
        }

        // Methods
        function assign(string $varName, $var) {
            $this->param[$varName] = $var;
        }

        function display(string $filename) {
            $p = '../view/' . $filename;

            foreach ($this->param as $key => $value) {
                $$key = $value;
            }

            include($p);
        }
    }