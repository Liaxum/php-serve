<?php

    // Team class
    class Team {
        // Attributes
        private $id;
        private $name;
        private $rondeId;
        private $validate;
        private $players = array();

        // Constructor
        function __construct($id, $name, $rondeId, $validate) {
            $this->id = $id;
            $this->name = $name; 
            $this->rondeId = $rondeId;
            $this->validate = $validate;
        }

        // Getters
        function getId(): int { return $this->id; }
        function getName(): string { return $this->name; }
        function getRondeId(): int { return $this->rondeId; }
        function getValidate(): string { return $this->validate; }
        function getPlayers(): array { return $this->players; }

        // Setters
        function addPlayer(Player $player) {
            $this->players[] = $player;
        }
    }