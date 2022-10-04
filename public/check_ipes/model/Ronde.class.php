<?php

    // Ronde class
    class Ronde {
        // Attributes
        private $id;
        private $nRonde;
        private $date;
        private $place;
        private $idCompetition;
        private $currentRonde;
        private $level;

        // Constructor
        function __construct($id, $nRonde, $date, $place, $idCompetition, $currentRonde, $level) {
            $this->id = $id;
            $this->nRonde = $nRonde;
            $this->date = $date;
            $this->place = $place;
            $this->idCompetition = $idCompetition;
            $this->currentRonde = $currentRonde;
            $this->level = $level;
        }

        // Getters
        function getId(): int { return $this->id; }
        function getNRonde(): int { return $this->nRonde; }
        function getDate(): string { return $this->date; }
        function getPlace(): sring { return $this->place; }
        function getIdCompetition(): int { return $this->idCompetition; }
        function getCurrentRonde(): string { return $this->currentRonde; }
        function getLevel(): string { return $this->level; }
    }