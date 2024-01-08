<!DOCTYPE html>
<html>
    <head>
        <title>FreshCart</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body onload="displayItemsByCategory('Shop All')">
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
                    <p>Sort by Categories</p>
                    <ul class="categories">
                        <li><a href="javascript:void(0);" onclick="displayItemsByCategory('Shop All')">Shop All</a></li>
                    </ul>
                    <input type="text" id="search" name="candyName" placeholder="Enter an item name">
                    <button type="submit" value="Search" onclick="checkInventory(items)">Search</button>
                </div>
            </div>
            <div class="maincontent">
            </div>
        </div>
        <div class="footer">
            <h3><em>Name: Prachi Shekhar Kane &nbsp;&nbsp;&nbsp;NetId: PXK220024 &nbsp;&nbsp;&nbsp;CourseNumber: CS6314.001</em></h3>
        </div>
        <script>
            let items = [
                {img : "./speciality/assortedchoco.webp",name : "Assorted Chocolates",price : 30.5,category : ["Specials"],count : 5, discount : 0},
                {img : "./speciality/biryani.avif",name : "Biryani",price : 24.3,category : ["Specials"],count : 5, discount : 0},
                {img : "./speciality/croissant.avif",name : "Croissant",price : 50.6,category : ["Specials"],count : 5, discount : 0},
                {img : "./speciality/macarons.avif",name : "Macarons",price : 60,category : ["Specials"],count : 5, discount : 0},
                {img : "./speciality/ramen.avif",name : "Ramen",price : 30,category : ["Specials"],count : 5, discount : 0},
                {img : "./speciality/rotisserie.avif",name : "Rotisserie",price : 24.3,category : ["Specials"],count : 5, discount : 0},
                {img : "./speciality/sushi.avif",name : "Sushi",price : 30.2,category : ["Specials"],count : 5, discount : 0}
            ]

            const offerQuestions = [
                {
                    text: "Are you a student?",
                    variable: "isStudent",
                },
                {
                    text: "Are you a low-income person?",
                    variable: "isLowIncome",
                }
            ];
            let userAnswers = {};
            let startTime = 0;
            let currentQuestionIndex = 0;
            let displayed = 0;
            function displayQuestion(itemName){
                if (currentQuestionIndex == 2 && displayed == 1)
                {
                    currentQuestionIndex = 0;
                    displayed = 0;
                    startTime = 0;
                    userAnswers = {};
                }
                if (currentQuestionIndex < offerQuestions.length)
                {
                    if (currentQuestionIndex === 0)
                    {
                        startTime = new Date().getTime();
                    }
                    const questionText = offerQuestions[currentQuestionIndex].text;
                    const confirmation = currentQuestionIndex === offerQuestions.length - 1 ? "You qualify for" : "Because of";

                    const questionContainer = document.getElementById(itemName + "question-container");
                    questionContainer.innerHTML = `
                        <p>${questionText}</p>
                        <button onclick="answerQuestion('Yes','${itemName}')">Yes</button>
                        <button onclick="answerQuestion('No','${itemName}')">No</button>
                        <button onclick="skipQuestion('${itemName}')">Skip</button>
                    `;
                    document.getElementById(itemName + "result-container").style.display = "none";

                    currentQuestionIndex++;
                }
                else
                {
                    displayResult(itemName);
                    displayed = 1;
                }
            }
            function answerQuestion(answer, itemName){
                const currentVariable = offerQuestions[currentQuestionIndex - 1].variable;
                userAnswers[currentVariable] = answer;
                displayQuestion(itemName);
            }
            function skipQuestion(skipitemName){
                displayQuestion(skipitemName);
            }
            function calculateSpecialOffer(answers){
                let qualified = "";
                if (answers.isStudent === "Yes")
                {
                    qualified += " Being a student";
                }
                if (answers.isLowIncome === "Yes")
                {
                    if (qualified !== "") {
                        qualified += " and";
                    }
                    qualified += " Having a low income";
                }
                return qualified;
            }
            function displayResult(itemName)
        {
            var discountItems = null;
            const totalTimeSpent = ((new Date().getTime() - startTime) / 1000).toFixed(2);
            const resultText = calculateSpecialOffer(userAnswers);
            const resultContainer = document.getElementById(itemName + "result-container");
            if (resultText === "")
            {
                resultContainer.innerHTML = `
                <p>You do not qualify for a discount!</p>
              `;
            }
            else if (resultText.toLowerCase() == " being a student")
            {
                resultContainer.innerHTML = `
                <p>${resultText}, you qualify for 30% off your purchase!</p>
              `;
                var i = items.findIndex((obj => obj.name == itemName));
                items[i].discount = (items[i].price - (0.3 * items[i].price));
            }
            else if (resultText.toLowerCase() == " having a low income")
            {
                resultContainer.innerHTML = `
                <p>${ resultText }, you qualify for 50% off your purchase!</p>
              `;
                var i = items.findIndex((obj => obj.name == itemName));
                items[i].discount = (items[i].price - (0.5 * items[i].price));
            }
            else if (resultText.toLowerCase() == " being a student and having a low income")
            {
                resultContainer.innerHTML = `
                <p>${resultText}, you qualify for 100% off your purchase!</p>
               `;
                var i = items.findIndex((obj => obj.name == itemName));
                items[i].discount = items[i].price;
            }
            else
            {
                resultContainer.innerHTML = `
                <p>You do not qualify for a discount!</p>
              `;
            }
            resultContainer.innerHTML += `<p>Time spent on questions: ${totalTimeSpent} seconds</p>`;
            resultContainer.style.display = "block";
            document.getElementById(itemName + "question-container").style.display = "none";

        }
        function displayItemsByCategory(category)
        {
            var item_lists = null;
            if(category=='Shop All')
            {
                item_lists = items;
            }
            else
            {
                item_lists = items.filter(function (item)
                {
                    return item.category === category;
                });
            }
            var itemsHTML = '<section class="container">';
            for (var i = 0; i < item_lists.length; i++)
            {
                var item = item_lists[i];
                itemsHTML += `
                    <div class="card">
                        <img src="${item.img}" alt="${item.name}">
                        <h3>${item.name}</h3>
                        <p>Price: $${item.price.toFixed(2)}</p>
                        <br>
                        <div class="qtyTextBox">
                            <button type="submit" value="Add to Cart" onclick="addtocart('${item.name}', ${item.price}, parseInt(document.getElementById('${item.name.toLowerCase()}Qty').value))">Add to Cart</button>
                            <input id="${item.name.toLowerCase()}Qty" type="text" placeholder="Quantity"/>
                        </div>
                        <br>
                        <button type="submit" value="Special offer" id="${item.name}SF" style="width:100%" onclick="displayQuestion('${item.name}')">Special offer</button>

                        <div id="${item.name}question-container">
                        </div>
                        <div id="${item.name}result-container" style="display: none;">
                        </div>
                    </div>
                `;
            }
            itemsHTML+='</section>';
            document.getElementsByClassName('maincontent')[0].innerHTML = itemsHTML;
        }
        function addtocart(itemName, itemPrice, itemQuantity)
       {

           if (itemQuantity == 0) {
               alert("Enter a value greater than 0");
           }
           else
           {
               var qtyAvailable = false;
               var item = items.filter(function (item) {
                   if (item.count >= itemQuantity && item.name == itemName) {
                       qtyAvailable = true;
                   }
               });
               if (qtyAvailable) {
                   var i = items.findIndex((obj => obj.name == itemName));
                   items[i].count -= itemQuantity;
                   if (item != null) {
                       var i = items.findIndex((obj => obj.name == itemName));
                       var itemDiscount = items[i].discount;
                       var itemImg= items[i].img;
                       item =
                       {
                            img: itemImg,
                            name: itemName,
                            price: itemPrice - itemDiscount,
                            quantity: itemQuantity
                       };
                   }

                   if (sessionStorage.getItem('cart')) {
                       var cart = JSON.parse(sessionStorage.getItem('cart'));
                       cart.push(item);
                       sessionStorage.setItem('cart', JSON.stringify(cart));
                   }
                   else {
                       var cart = [item];
                       sessionStorage.setItem('cart', JSON.stringify(cart));
                   }

                   alert(itemName + " added to cart!");
               }
               else {
                   alert(itemName + " not available, update the inventory!");
               }
           }
        }
        </script>
        <script src="functions.js"></script>
    </body>
</html>