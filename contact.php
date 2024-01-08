<!DOCTYPE html>
<html>
    <head>
        <title>FreshCart</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
            <a href="about.php"><img src="grocery.jpeg" alt="grocery bag"/><span id="date"></span></a>
            <h1 style="text-align: center; font-size: 48px; padding:  10px 5px;">FreshCart</h1>
            <ul>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="myaccount.php">My-account</a></li>
                <li><a href="about.php">About-us</a></li>
                <li><a href="contact.php">Contact-us</a></li>
            </ul>
        </div>
        <div class="navbar">
            <ul>
                <li><a href="freshproducts.php">Fresh products</a></li>
                <li><a href="frozenproducts.php">Frozen</a></li>
                <li><a href="pantry.php">Pantry</a></li>
                <li><a href="breakfastandcereal.php">Breakfast and Cereal</a></li>
                <li><a href="baking.php">Baking</a></li>
                <li><a href="snacks.php">Snacks</a></li>
                <li><a href="candy.php">Candy</a></li>
                <li><a href="specialtyshops.php">Specialty shops</a></li>
                <li><a href="deals.php">Deals</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="side">
                <div class="filters">
                    <h3>Filters</h3>
                    <form>
                        <p>Sort by</p>
                        <input type="radio" name="sortby" id="bestseller" value="bestseller"/><label for="bestseller">Best Seller</label>
                        <br>
                        <input type="radio" name="sortby" id="htl" value="htl"/><label for="htl">High to Low</label>
                        <br>
                        <input type="radio" name="sortby" id="lth" value="lth"/><label for="lth">Low to High</label>
                        <br>
                        <input type="radio" name="sortby" id="sale" value="sale"/><label for="sale">Sale</label>
                        
                        <br><br>
                        
                        <p>Price</p>
                        <label>Enter price range</label><br>
                        <input type="text" style="width: 30%;"/><input type="text" style="width: 30%;"/><button type="submit">Go</button>

                        <br><br>
                        <p>Brands</p>
                        <input type="checkbox" id="walmart" value="walmart"/><label for="walmart">Walmart</label>
                        <br>
                        <input type="checkbox" id="heb" value="heb"/><label for="heb">H-E-B</label>
                        <br>
                        <input type="checkbox" id="samsclub" value="samsclub"/><label for="samsclub">Sam's Club</label>
                        <br>
                        <input type="checkbox" id="costco" value="costco"/><label for="costco">Costco</label>

                        <br><br>
                        <button type="submit">Apply</button>

                    </form> 
                </div>
            </div>
            <div class="maincontent">
                <form class="contact" id="contactform" action="" method="post" onsubmit="return false">
                    <label for="fname">First Name</label><br>
                    <input type="text" id="fname" name="firstname" placeholder="Your name">
                    <br>
                    <label for="lname">Last Name</label><br>
                    <input type="text" id="lname" name="lastname" placeholder="Your last name">
                    <br>
                    <label for="phone">Phone Number</label><br>
                    <input type="text" id="phone" name="phone" placeholder="Your phone number">
                    <br>
                    <label for="email">Email</label><br>
                    <input type="text" id="email" name="email" placeholder="Your email">
                    <br>
                    <label for="gender">Gender</label><br>
                    <input type="radio" id="male" name="gender" value="Male">
                    <label for="male">Male</label><br>
                    <input type="radio" id="female" name="gender" value="Female">
                    <label for="female">Female</label><br>
                    <input type="radio" id="other" name="gender" value="Other">
                    <label for="other">Other</label>
                    <br>
                    <label for="comment">Comment</label><br>
                    <textarea id="comment" name="comment" placeholder="Write something.." style="height:100px"></textarea>
                    <br>
                    <input type="submit" value="Submit" onclick="formsubmit(this)">
                  </form>
            </div>
        </div>
        <div class="footer">
            <h3><em>Name: Prachi Shekhar Kane &nbsp;&nbsp;&nbsp;NetId: PXK220024 &nbsp;&nbsp;&nbsp;CourseNumber: CS6314.001</em></h3>
        </div>
        <script>
            function formsubmit(e){
                var fname=document.getElementById("fname").value;
                var lname=document.getElementById("lname").value;
                var phone=document.getElementById("phone").value;
                var email=document.getElementById("email").value;
                var comment=document.getElementById("comment").value;
                if(!fname.match(/^[A-Z][a-z]+$/)){
                    alert("First Name not valid");
                }
                else if(!lname.match(/^[A-Z][a-z]+$/)){
                    alert("Last Name not valid");
                }
                else if(fname == lname){
                    alert("First name and last name cannot be same");
                }
                else if(!phone.match(/^\(\d{3}\)\d{3}-\d{4}$/)){
                    alert("Phone number not valid");
                }
                else if(!email.includes("@") || !email.includes(".")){
                    alert("Email should contain @ and .");
                }
                else if(!document.getElementById('male').checked && !document.getElementById('female').checked && !document.getElementById('other').checked){
                    alert("Select one gender");
                }
                else if(!comment.match(/[\s\S]{10,}/)){
                    alert("Write atleast 10 characters in the comments");
                }
                else{
                    alert("Form submitted");
                    location.reload();
                }
            }
        </script>
        <script src="functions.js"></script>
    </body>
</html>