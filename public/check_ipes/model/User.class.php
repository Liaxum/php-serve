<?php

    // User class
    class User {
        // Attributes
        private $name;
        private $password;
        private $role;

        // Constructor
        public function __construct(string $name, string $password, string $role) {
            $this->name = $name;
            $this->password = $password;
            $this->role = $role;
        }

        // Getters
        public function getName(): string { return $this->name; }

        public function getPassword(): string { return $this->password; }

        public function getRole(): string { return $this->role; }
    }