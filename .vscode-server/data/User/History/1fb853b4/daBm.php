<?php  
// we will create an instance of this class and call its functions in the next part of the tutorial
class Recommender 
{       
	// this function will get a sorted list of book recommendations for a given person
    public function getRecommendations($preferences, $person) 
    { 
        $total = array(); 
        $simSums = array(); 
        $ranks = array(); 
        $sim = 0; 
         
        foreach ($preferences as $otherPerson => $values) 
        { 
            if ($otherPerson != $person) 
            { 
                $sim = $this->similarityDistance($preferences, $person, $otherPerson); 
            } 
             
            if ($sim > 0) 
            { 
                foreach ($preferences[$otherPerson] as $key=>$value) 
                { 
                    if (!array_key_exists($key, $preferences[$person])) 
                    { 
                        if (!array_key_exists($key, $total)) { 
                            $total[$key] = 0; 
                        } 
                        $total[$key] += $preferences[$otherPerson][$key] * $sim; 
                         
                        if (!array_key_exists($key, $simSums)) { 
                            $simSums[$key] = 0; 
                        } 
                        $simSums[$key] += $sim; 
                    } 
                } 
            } 
        } 

        foreach ($total as $key => $value) 
        { 
            $ranks[$key] = $value / $simSums[$key]; 
        } 
         
        array_multisort($ranks, SORT_DESC);     
        return $ranks;  
    }  
	
    //This function gives a single number back representing the similarity of two people's preferences
    public function similarityDistance($preferences, $person1, $person2)
    {
        $similar = array(); 
        $sum = 0; 
     
        foreach ($preferences[$person1] as $key => $value) 
        { 
            if (array_key_exists($key, $preferences[$person2])) 
                $similar[$key] = 1; 
        } 
         
        if (count($similar) == 0) 
            return 0; 
         
        foreach ($preferences[$person1] as $key => $value) 
        { 
            if(array_key_exists($key, $preferences[$person2])) 
                $sum = $sum + pow($value - $preferences[$person2][$key], 2); 
        } 
         
        return 1 / (1 + sqrt($sum));      
    } 

	/* Here are the other two methods of measuring similarity mentioned in the tutorial sheet.
	public function similarityDistanceJ($preferences, $person1, $person2)     
	{ 
		$Numerator = 0; 
		$Denominator = 0;
		foreach($preferences[$person1] as $key=>$value) 
		{ 
			if(array_key_exists($key, $preferences[$person2])) 
			{
				$Numerator++;
			}
			$Denominator++;
		} 
     	foreach($preferences[$person1] as $key=>$value) 
		{ 
			$Denominator++;
		}     
		return 1 / (1 + ($Numerator / $Denominator));      
	} 
	public function similarityDistanceC($preferences, $person1, $person2)     
	{ 
		$Numerator = 0; 
		$DA = 0; 
		$DB = 0;
		foreach($preferences[$person1] as $key=>$value) 
		{ 
			if(array_key_exists($key, $preferences[$person2])) 
			$Numerator += $value * $preferences[$person2][$key]; 
		} 
		foreach($preferences[$person1] as $key=>$value) { 
			$DA += $value * $value;
		} 
		foreach($preferences[$person2] as $key=>$value) { 
			$DB += $value * $value;
		} 
		return 1 / (1 + ($Numerator / (sqrt($DA) * sqrt($DB)));      
	} 
*/
} 
?>