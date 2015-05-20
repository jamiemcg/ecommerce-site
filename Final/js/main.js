/*
    Function to check if the user entered a valid search term.
    Prevents searching if the users entered only whitespace or
    tried to submit a blank search.
*/
function checkSearchTerm() 
{
    var term = $("#search").val(); //Get search term
    term = $.trim(term); //Trim all whitespace
    if(term.length > 0) { //Check length
        return true; //Not empty term, submit search
    }
    else {
        return false; //Empty term, do not submit
    }
}

/*
    Function to check if the passwords are suitable when user is registering.
    Checks if new password is at least of length 6.
    Checks if the two passwords match (the confirmation password).
    Any issues are highlighted in red.
*/
function checkPassRegister()
{
    var pass = $("#password");
    //Ensure the length of the password is at least 6
    if (pass.val().length >= 6)
    {
        var confirmPass = $("#confirmPassword");
        //Check if the two passwords match, alert user if not
        if (pass.val() != confirmPass.val())
        {
            alert("Passwords do not match!");
            confirmPass.css("background-color", "#ff3232");
            confirmPass.get(0).focus(); //Move focus to #confirmPassword
        }
        else
        {
            return true; //They matched, submit form
        }
    }
    else
    {
        //Password length is less than  6
        pass.css("background-color", "#ff3232");
        alert("Password should have a length of at least 6");
        pass.get(0).focus(); //Move focus to #password
    }
    return false; //Prevent form submission
}

/*
    Resets the input color to white
*/
function resetColourPassword()
{
    //Reset background color
    $("#password").css("background-color", "white");
}

/*
    Resets the input color to white
*/
function resetColourConfirmPassword()
{
    //Reset background color
    $("#confirmPassword").css("background-color", "white");
}

/*
    Ensures the user has specified a size.
*/
function addToBasket() {
    var size = $("#size").val();
    //Ensure the user specified a size
    if(size == "default") {
        alert("Please choose a size");
    }
}

/*
    Calculate the price of the items in the user's basket. Takes into consideration
    the individual unit price and quantity of each item. It the shows the result
    on screen.
*/
function calculateUnitPrice() {
    var total = 0.0; //will store the total price of all items in basket
    var basket = document.getElementById("basket_items");
    var items = basket.getElementsByClassName("item"); //pick each item
    for(var i = 0; i < items.length; i++) { //cycle through each item
        var price = items[i].getElementsByClassName("unit_price"); //get ref
        price = price[0].innerHTML; //get actual value
        price = parseFloat(price.substring(1)); //remove € and parse float
        
        var quantity = items[i].getElementsByClassName("unit_quantity");
        quantity = parseInt(quantity[0].innerHTML); //get value and convert to int
        
        var totalPriceRef = items[i].getElementsByClassName("unit_total_price")[0]; //reference to where the total price will be shown
        var totalPrice = quantity * price; //calculate price
        totalPriceRef.innerHTML = "€" + totalPrice; //show price
        
        total += totalPrice;
    }
    
    document.getElementById("total_price").innerHTML = "€" + total;
}


/*
    Removes the item from the users basket.
    NOTE that this is only visual, it doesn't actually effect the users basket,
    i.e. the items will reappear on reload.
    
    TODO: recalculate the total price upon removal of an item.
*/
function removeFromBasket(caller) {
    //Delete item from basket
    caller.parentElement.parentElement.innerHTML = "";
}


/*
    Function to change the css style from main to alt and vice versa.
    Used for accessibility. Will set a cookie to remember the users
    choice.
*/
function setActiveStyleSheet(title) {
    var i, a;
    for(i = 0; (a = document.getElementsByTagName("link")[i]); i++) {
        if(a.getAttribute("rel").indexOf("style")!= -1 &&  a.getAttribute("title")) {
            a.disabled = true; //Enable link to other style
            if(a.getAttribute("title") == title) {
                a.disabled = false; //Disable link to current style
            }
        }
    }
    if(title == "alt") {
        //Set cookie for alternative style
        document.cookie="style=alt; path=/";
    }
    else {
        //Using main style
        document.cookie="style=main; path=/";
    }
}

/*
    Function to read all of the saved cookies
    "name" is the name of the cookie we are looking for.
*/
function getCookie(name) {
    var name = name + "=";
    //Returns all cookies, split all cookies into an array "ca"
    var ca = document.cookie.split(';'); 
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1); //Strip blanks
        }
        if (c.indexOf(name) == 0) {
            //We found the cookie, return it
            return c.substring(name.length,c.length);
        }
    }
    return ""; //Didn't find it. It wasn't set. Return nothing.
} 


/*
    Function to set the style. Checks to see if the style cookie has been set. If it has, it will read it and change the style to the style specified in the cookie. Should run on page load.
*/
function setStyle() {
    var styleTitle = getCookie("style");
    if(styleTitle != "") {
        //The style cookie exists. Read it and set the style.
        setActiveStyleSheet(styleTitle);
    }
}

/*
    Sets the title of product.php to reflect the title of the product.
*/
function setTitle() {
    var href = window.location.href;
    if(href.indexOf("product.php") > -1) { //are we on a product page
        //we are on a product page
        //change the page title to reflect the current product being viewed
        var productTitle = $("#product_title").val();
        window.title = productTitle + " | Shoes &amp; Footware for Sale"
        alert(productTitle);
    }
}