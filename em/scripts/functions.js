// JavaScript Document


function shade_input_table(tablename)
{
	$("#"+tablename + " tr:odd").css('background-color' , '#cdcdcd');
	$("#"+tablename + " tr:even").css('background-color' , '#efefef');
}

function shade_data_table(tablename)
{
	$("#"+tablename + " tr:odd").css('background-color' , '#cdcdcd');
	$("#"+tablename + " tr:even").css('background-color' , '#efefef');
	$("#"+tablename + " tr:first").addClass("tableheading");
}

function val_date_click(mydate)
{
	//var =document.getElementById("mydate").value;
	
	//check if my date is ten characters 
	if(mydate.length !=10)
	{
		alert("invalid date entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	
	//split the date into year, month and day
	var the_split=mydate.split("-");
	var total=the_split.length;
	if(total != 3)
	{
	    alert("invalid date entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	var the_year=the_split[0];
	var the_month=the_split[1];
	var the_day=the_split[2];
	
	// 1. theyear has to be four digits 2. the year has to be numeric.
	
	if(the_year.length!=4 || isNaN(the_year))
	{
		alert("invalid year entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	
	if(the_month.length!=2 || isNaN (the_month) || the_month<1 || the_month>12 )
	{
		alert("invalid month entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	if(the_day.length!=2 || isNaN(the_day))
	{
		alert("invalid day entry! please enter a valid date using yyyy-mm-dd eg 2019-12-05");
		return false;
	}
	else
	{
		if(the_day>31)
		{
			alert("invalid day entry! no month can be greater than 31 days");
			return false;
		}
		if((the_month==4 || the_month==6 || the_month==9 || the_month==11) && the_day>30)
		{
			alert("invalid day entry! April,june,september and november cannot have more than 30 days.  please enter a valid date using yyyy-mm-dd eg 2019-12-05");
			return false;
		}
		if(the_month==2)
		{
			if(the_year % 4 ==0 && the_day >29 )
			{
				alert("This is a leap year and feburary cannot be greater than 29 days");
				return false;
			}
			
			if(the_year % 4 !=0 && the_day >28 )
			{
				alert("This is not a leap year and feburary cannot be greater than 28 days");
				return false;
			}
		}
	}
	return true;
}
