function getLocs()
{
	var e = document.getElementById('tripLocs');
	var locations = [];
	for (var i = 0; i < e.options.length; i++) 
	{
  		if (e.options[i].selected) 
  		{
    		locations.push(e.options[i].value);
  		}
	}
	var op="<option value=''>Start Location</option>";
	for (locs in locations) 
	{
       op += "<option value='"+locations[locs]+"'>"+locations[locs]+"</option>";
    }
    document.getElementById("start").innerHTML = op;
}
