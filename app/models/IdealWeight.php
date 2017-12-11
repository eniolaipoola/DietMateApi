<?php

namespace app\models;

use yii\db\ActiveRecord;

class IdealWeight extends ActiveRecord {

    public static function tableName() {
        return 'idealWeight';
    }

    public function rules(){
        return [
            ['sex_id', 'required'],
            [['name', 'value', 'sex_id'], 'safe'],
        ];
    }

    public function calcIBW($sex, $height){
        //Calculates ideal body weight for female using Hanwi's formula
        if ($sex == 0) {
            $ibw = 45.5 + $this->calcHanwiIncrementFemale($height) ;
            $result = round($ibw, 2);
        } elseif ($sex == 1) {
            //calculates ibw for male using Hanwi's formula
            $ibw = 48 + $this->calcHanwiIncrementMale($height);
            $result = round($ibw, 2);
        } else {
            return "An error occured while calculating ideal weight";
        }

        return $result;
    }

    //Converts height from cm to feet for easy use to calculate ideal weight
    //Female : 45.5 + 2.3kg per inch over 5 feet
    public function calcHanwiIncrementFemale($heightCM){
        //takes in height in cm and converts is to feet
        $heightFeet = $heightCM / 30.58;

        //calculates inches over 5 feet
        //getting fractional part to calculate increase
        $whole = (int) $heightFeet;
        $fraction = $heightFeet - $whole;

        //this calculates the inch equivalent over 5 feet of height
        $increment = $fraction * 12;

        //if the height is greater than 5 feet, convert the remaining feet to inches, then calculate increment.
        if($whole > 5) {
            $difference = $heightFeet - 5;
            $diffInch = $difference * 12;
            $hanwiInch = ($increment) + $diffInch;
            $hanwiIncrement = 2.3 * $hanwiInch;
            return $hanwiIncrement;
        }

        $hanwiIncrement = 2.3 * $increment;
        return $hanwiIncrement;
    }

    //Converts height from cm to feet for easy use to calculate ideal weight
    //Female : 45.5 + 2.3kg per inch over 5 feet
    public function calcHanwiIncrementMale($heightCM){
        //takes in height in cm and converts is to feet
        $heightFeet = $heightCM / 30.58;

        //calculates inches over 5 feet
        //getting fractional part to calculate increase
        $whole = (int) $heightFeet;
        $fraction = $heightFeet - $whole;

        //this calculates the inch equivalent over 5 feet of height
        $increment = $fraction * 12;

        //if the height is greater than 5 feet, convert the remaining feet to inches, then calculate increment.
        if($whole > 5) {
            $difference = $heightFeet - 5;
            $diffInch = $difference * 12;
            $hanwiInch = ($increment) + $diffInch;
            $hanwiIncrement = 2.7 * $hanwiInch;
            return $hanwiIncrement;
        }

        $hanwiIncrement = 2.7 * $increment;
        return $hanwiIncrement;
    }


    public function considerWristMeasurement($wrist, $ibw){
        $result = 0;
        if ($wrist > 7 ){
            $result  = $ibw + ($ibw * 0.1);
        } elseif( $wrist < 7){
            $result = $ibw + ($ibw * 0.1);
        } elseif ($wrist == 7){
            $result = $ibw;
        }
        return $result;
    }

    public function convertHeightInch($heightCM){
        $heightInch = $heightCM / 2.54;
        $hIn = round($heightInch, 2);
    }

    public function getUser(){
        return $this->hasMany(User::className(), ['user_id' => 'id']);
    }

}