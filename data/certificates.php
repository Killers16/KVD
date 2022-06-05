<?php

class Certificates
{
        private $id;
        private $students_id;
        private $ce_names;
        private $ce_codes;
        private $items;
        private $ce_years;
        public function __construct($students_id, $ce_names, $ce_codes, $items, $ce_years)
        {
                $this->students_id = $students_id;
                $this->ce_names = $ce_names;
                $this->ce_codes = $ce_codes;
                $this->items = $items;
                $this->ce_years = $ce_years;
        }

        public function getId()
        {
                return $this->id;
        }


        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }


        public function getCeStudentsID()
        {
                return $this->students_id;
        }


        public function setCeStudentsID($students_id)
        {
                $this->students_id = $students_id;

                return $this;
        }


        public function getCe_name()
        {
                return $this->ce_names;
        }

        public function setCe_name($ce_names)
        {
                $this->ce_names = $ce_names;

                return $this;
        }


        public function getCe_codes()
        {
                return $this->ce_codes;
        }


        public function setCe_codes($ce_codes)
        {
                $this->ce_codes = $ce_codes;

                return $this;
        }

        public function getCeItems()
        {
                return $this->items;
        }


        public function setCeItems($items)
        {
                $this->items = $items;

                return $this;
        }

        public function getCe_Years()
        {
                return $this->ce_years;
        }

        public function setCe_Years($ce_years)
        {
                $this->ce_years = $ce_years;

                return $this;
        }
}
