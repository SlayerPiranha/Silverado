var types = {};
function toggleRow(type)
{
  $currentlyShown = true;
  if (!(type in types))
  {		
    //assume it was focused first
    types[type] = $currentlyShown;
  }
  else
  {
    $currentlyShown = types[type];
  }
	
  types[type] = !$currentlyShown;
	
  if ($currentlyShown)
  {
    $(type).hide();
  }
  else
  {
    $(type).show();
  }
}

function focusRow(type)
{
  for (var otherType in types)
  {
    if (otherType != type)
    {
      var isShown = types[otherType];
	  if (isShown)
	  {
        toggleRow(otherType);
	  }
    }
  }
  toggleRow(type);
}
