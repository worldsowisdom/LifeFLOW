//m put behavior in some kind of fancier data struct
//m/p use case

//collision w/ ocreature
if (adjacent to creature) mv away from ocreature 2x

//collision w/ edge?
if (adjacent to wall) mv away from wall 1x

//touch
if (touch) mv away from touch 2x

//default
if (other fcreature within 15 px) mv away/opposite ocreature
	else move towards ocreature
	
