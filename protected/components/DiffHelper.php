<?php
    class DiffHelper{
        
        private $oldValArray;
        private $newValArray;
        
        public function __construct($oldValArray,$newValArray) {
            $this->oldValArray = $oldValArray;
            $this->newValArray = $newValArray;
        }
        
        public function getNewlyAddedValue(){
            return array_values(array_diff($this->newValArray,$this->oldValArray));
        }
        
        public function getNewlyRemovedValue(){
            return array_values(array_diff($this->oldValArray,$this->newValArray));
        }
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

