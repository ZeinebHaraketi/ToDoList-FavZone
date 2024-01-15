<?php 

class Utilisateur{
    private $Id;
    private $firstName;
    private $lastName;
    private $address;
    private $country;
    private $phoneNumber;
    private $picture;

    function __construct($firstName,$lastName,$address,$country,$phoneNumber,$picture)
    {
      $this->firstName= $firstName;
      $this->lastName= $lastName;
      $this->address= $address;
      $this->country= $country;
      $this->phoneNumber= $phoneNumber;
      $this->picture= $picture;

    }
  
    // Les Getters
    function getID(){
      return $this->Id;
  } 
  function getFirstName(){
      return $this->firstName;
  } 
  
  function getLastName(){
    return $this->lastName;
    }
    
    function getAddress(){
        return $this->address;
    } 
    function getCountry(){
        return $this->country;
    } 
    function getPhoneNumber(){
        return $this->phoneNumber;
    } 
    function getPicture(){
        return $this->picture;
    } 
          

    function setFirstName($FirstName){
        $this->firstName= $FirstName;
    }
    function setLastName($lastName){
        $this->lastName= $lastName;
    }

    function setAddress($address){
        $this->address= $address;
    }

    function setCountry($country){
        $this->country= $country;
    }

    function setPhoneNumber($phoneNumber){
        $this->phoneNumber= $phoneNumber;
    }

    function setPicture($picture){
        $this->picture= $picture;
    }

 


}

?>