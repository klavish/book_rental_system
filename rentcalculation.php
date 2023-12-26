<?php


class RentCalculation{
     
    /**
     * function will calculate Total rent using parameters 
     * @param $rentPerDay
     * @param $finePerDay
     * @param $daysKept
     * @param $dueDate
     * @param $returnDate
     * @return int
     */

    function calculateRentAndFine($rentPerDay, $finePerDay, $daysKept, $dueDate, $returnDate)
    {
        #  initial rent
        $initialRent = $rentPerDay * $daysKept;
    
        # check if the book returned late
        $overdueDays = max(0, strtotime($returnDate) - strtotime($dueDate)) / (60 * 60 * 24);
        $fine = ($overdueDays > 0) ? ($finePerDay * $overdueDays) : 0;
    
        # calculate total rent
        $totalAmount = floor($initialRent + $fine);
       return $totalAmount;
    }
    
}

?>