<?php
    /**
    *
    *Calculates the amount of the estimate based on the number of members, the number of sections, and the federation.
    *@param {number} $adherents - The number of members.
    *@param {number} $sections - The number of sections.
    *@param {string} $federation - The federation as a string.
    *@return {object} An object containing the calculated prices.
    */
    function calculateEstimate($adherents, $sections, $federation) {

        $adherentsPrice = calculateAdherentsPrice($adherents); 
        
        $sectionPrice = calculateSectionPrice($sections, $adherents); 
        $priceWithReduction = calculateReduction($adherentsPrice, $sectionPrice, $adherents, $federation);
        
        $priceWithReduction_bonus = calculatePrice_bonus($adherentsPrice, $sections, $adherents, $federation); 
        
        $priceWithTVA = getTva($priceWithReduction);
        $priceWithTVA_bonus = getTva($priceWithReduction_bonus); 

        $yearlyPrice = $priceWithTVA * 12;
        $yearlyPrice_bonus = $priceWithTVA_bonus * 12; 

        return array(
            "adherentsPrice" => $adherentsPrice,
            "sectionPrice" => $sectionPrice,
            "priceWithReduction" => $priceWithReduction,
            "priceWithTVA" => $priceWithTVA,
            "yearlyPrice" => $yearlyPrice, 
            "priceWithReduction_bonus" => $priceWithReduction_bonus,
            "priceWithTVA_bonus" => $priceWithTVA_bonus,
            "yearlyPrice_bonus" => $yearlyPrice_bonus,
        );
    }

    /**
     *
     *Calculate the price for members based on the number of members.
     *
     *@param {number} adherents - The number of members.
     *@return {number} - The calculated price for members.
    */
    function calculateAdherentsPrice($adherents) {
        if($adherents <= 100){
            $adherentsPrice = 10;
        } elseif ($adherents <= 200) {
            $adherentsPrice = $adherents * 0.10; 
        } elseif ($adherents <= 500) {
            $adherentsPrice = $adherents * 0.09; 
        } elseif ($adherents <= 1000) {
            $adherentsPrice = $adherents * 0.08; 
        } elseif ($adherents <= 10000) {
            $adherentsPrice = floor($adherents / 1000) * 70;
        } else {
            $adherentsPrice = 1000;
        }

        return $adherentsPrice;
    }

    /**
     * Calculates the price of the sections based on the number of sections and number of adherents.
     *
     * @param {number} numberSection - The number of sections.
     * @param {number} numberAdherents - The number of adherents.
     * @return {number} The price of the sections.
     */
    function calculateSectionPrice($numberSection, $numberAdherents) {
        $sectionPrice = $numberSection * 5; 

        if ($numberAdherents > 1000) {
            $sectionPrice -= 5; 
        }

        return $sectionPrice;
    }

    /**
     * Calculates the total price after reduction for a given number of adherents, sections and federation.
     *
     * @param {number} $adherentsPrice - The price for the adherents.
     * @param {number} $sectionPrice - The price for the sections.
     * @param {number} $numberAdherents - The number of adherents.
     * @param {string} $federation - The federation code, 'N' for none, 'G' for green and 'B' for blue.
     * @return {number} The total price after reduction.
     */
    function calculateReduction($adherentsPrice, $sectionPrice, $numberAdherents, $federation) {
        if ($federation == 'N') {
            if ($sectionPrice >= 15) {
                $sectionPrice -= 15;
            } elseif ($sectionPrice == 10) {
                $sectionPrice -= 10;
            } elseif ($sectionPrice == 5) {
                $sectionPrice -= 5;
            }
        } elseif ($federation == "G") {
            $adherentsPrice *= 0.85;
        } elseif ($federation == "B") {
            $sectionPrice *= 0.70;
        }
    
        $totalPrice = $sectionPrice + $adherentsPrice;
    
        return $totalPrice;
    }    


    /**
     * Calculates the total price of a quote, taking into account the number of members, sections, federation and current month.
     * @param {number} $adherentsPrice - The price of members
     * @param {number} $sections - The number of sections
     * @param {number} $numberAdherents - The number of members
     * @param {string} $federation - The federation (N, G or B)
     * @return {number} - The total price of the quote
     */
    function calculatePrice_bonus($adherentsPrice, $sections, $numberAdherents, $federation) {
        $month = date("m");
        $fullPriceSections = array();
        $discountedSections = array();
        $sectionPrice = 0; 

        for ($i = 1; $i <= $sections; $i++) {
            if ($i % $month == 0) {
                array_push($discountedSections, $i);
            } else {
                array_push($fullPriceSections, $i);
            }
        }

        if ($federation == 'N') {
            $countOffered = 3; 
            while ($countOffered > 0) {
                if (count($fullPriceSections) > 0) {
                    array_pop($fullPriceSections);
                } else {
                    array_pop($discountedSections);
                }
                $countOffered--;
            }
            $sectionPrice = (count($fullPriceSections) * 5) + (count($discountedSections) * 3);
        } elseif ($federation == "G") {
            $adherentsPrice *= 0.85;
            $sectionPrice = (count($fullPriceSections) * 5) + (count($discountedSections) * 3); 
        } elseif ($federation == "B") {
            $sectionPrice = (count($fullPriceSections) * 5) + (count($discountedSections) * 3); 
            $sectionPrice *= 0.70;
        }

        if ($numberAdherents > 1000) {
            $sectionPrice -= 5; 
        }

        $price = $sectionPrice + $adherentsPrice; 

        return $price; 
    }    


    /**
     * Calculates the price with TVA (Value Added Tax) included for a given price
     *
     * @param {number} PriceHT - The price excluding TVA
     * @return {number} The price including TVA
     */
    function getTva($PriceHT) {
        $priceWithTVA = $PriceHT * 1.20; 

        return $priceWithTVA;
    }
?> 