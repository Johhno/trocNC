function regEx(regex,input,helpText,helpMessage)
{
	if(!regex.test(input))
	{
		if(helpText != null)
			helpText.innerHTML = helpMessage;
		return false;
	}
	else
	{
		if(helpText != null)
			helpText.innerHTML = "";
		return true;

	}
}

function _NonEmpty(inputField, helpText)
{
	return validateRegEx(/.+/,inputField.value,helpText,"Please enter a value");
}

function nom(inputField,helpText)
{
	if(!_NonEmpty(inputField,helpText))
		return false;
	
	return validateRegEx(/^\d{5}$/,inputField.value,helpText,"Please enter a 5-digit ZIP code. ");
}