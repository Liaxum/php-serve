<?php

    // Player class
    class Player {
        // Attributes
        private $id;
        private $nFFE;
        private $name;
        private $elo;
        private $sex;
        private $mute;
        private $info;

        // Constructor
        public function __construct($id, $nFFE, $name, $elo, $sex, $mute, $info) {
            $this->id = $id;
            $this->nFFE = $nFFE;
            $this->name = $name;
            $this->elo = $elo;
            $this->sex = $sex;
            $this->mute = $mute;
            $this->info = $info;
        }

        // Getters
        public function getId() { return $this->id; }
        public function getnFFE() { return $this->nFFE; }
        public function getName() { return $this->name; }
        public function getElo() { return $this->elo; }
        public function getSex() { return $this->sex; }
        public function getMute() { return $this->mute; }
        public function getInfo() { return $this->info; }
    }