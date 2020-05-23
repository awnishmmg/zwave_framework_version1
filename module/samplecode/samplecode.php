<?php 

# This is sample file to get requested code into the file just copy and paste the code 
#function name: smart_toast
#Introduction: this function can be used to generate the notification alert just by using it

############################################################################################

##############################| function definition: |######################################

############################################################################################


# it has three arguments : $action |$type | $messsage  
# 1. action when ever user redirects users from one page to another page using a function 
# then header() or inbuilt function of zwave framework can be used
	#----> the user has to redirect page to another page with just a action and status 
	#Forexample header("location:newpage.php?action=delete&status=deleted-success-fully");
	#parameter binded to the query string after that call function smart_toast to the #destination page 
# 2. status---> querystring varaible is used to show the message which the user wantes 
# 3. status----> if user does not wants message to be display in the url 
# 4. status----> can be set to the status=default and then use $message to bind the 
# message to the sweet_alert()
# 5. message[optional]----> use to merge any extra message if required with status or 
# without status 
# 6. $type is 2nd Compulsory argument using which one you show different kind of notification as you want
	# 1. success : green 
	# 2. ready : orange
	# 3. default : cyan
	# 4. error : red 

smart_alert($action,$type,$message[optional]);





 ?>