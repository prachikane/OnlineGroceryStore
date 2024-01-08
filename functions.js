updateDateTime();
function updateDateTime() {
    const now = new Date();
    const currentDateTime = now.toLocaleString();
    document.getElementById('date').innerHTML = currentDateTime;
  }
setInterval(updateDateTime, 1000);


function addToCart(itemName, itemPrice, itembtn){
    var itemQuantity = itembtn.value;
    if(itemQuantity <= 0 || isNaN(itemQuantity)){
        alert("Min quantity needs to be 1");
    }
    else{
        var available = false;
        var item = item_lists.filter(function (item) {
            if (item.count >= itemQuantity && item.name == itemName) {
                available = true;
            }
        });
        if (available) {
            for (var i = 0; i < item_lists.length; i++) {
                if (item_lists[i].name === itemName && item_lists[i].count >= itemQuantity){
                    item_lists[i].count-=itemQuantity;
                    var itemImg= item_lists[i].img;
                    var itemcount = itemQuantity;
                    break;
                }
            }
            if (item != null) {
                item = {
                    img : itemImg,
                    name: itemName,
                    price: itemPrice,
                    quantity: itemQuantity,
                    pagename: pagename
                };
            }
            console.log(item);
            if (sessionStorage.getItem('cart')) {
                var cart = JSON.parse(sessionStorage.getItem('cart'));
                var existingItem = cart.find(function(cartItem) {
                    return cartItem.name === item.name && cartItem.pagename === item.pagename;
                });
        
                if (existingItem) {
                    // If the item exists, update the quantity
                    console.log(typeof(existingItem.quantity)+" "+typeof(item.quantity));
                    existingItem.quantity = parseInt(existingItem.quantity) + parseInt(item.quantity);
                    console.log(typeof(existingItem.quantity)+" "+typeof(item.quantity));

                } else {
                    // If the item doesn't exist, add it to the cart
                    cart.push(item);
                }
                sessionStorage.setItem('cart', JSON.stringify(cart));
            }
            else {
                var cart = [item];
                sessionStorage.setItem('cart', JSON.stringify(cart));
            }
            alert(itemName + " added to cart!");
            updateCount(itemName, itemcount, pagename);
        }
        else {
            alert(itemName + " not available, update the inventory!");
        }
    }
    itembtn.value=null;
}
function updateCount(productName, quantity) {
    var filePath='';
    var newCount;
    if(pagename=='freshproducts' | pagename=='frozenproducts' | pagename=='snacks' | pagename=='candies'){
        filePath = pagename + '.xml';
        $.ajax({
            type: 'GET',
            url: filePath,
            dataType: 'xml',
            success: function (xml) {
                const product = $(xml).find('product:has(name:contains("' + productName + '"))');
                const countElement = product.find('count');
                if (countElement.length > 0) {
                    newCount=parseInt(countElement.text())-parseInt(quantity);
                    countElement.text(newCount);
                    const updatedXmlString = new XMLSerializer().serializeToString(xml);
                    $.ajax({
                        type: 'POST',
                        url: 'update.php',
                        data: { cartdata: updatedXmlString, filePath: filePath},
                        success: function () {
                            console.log('XML updated successfully');
                        },
                        error: function (error) {
                            console.error('Error updating XML: ' + error);
                        }
                    });
                } else {
                    console.error('Product not found');
                }
            },
            error: function (error) {
                console.error('Error loading XML: ' + error);
            }
        });
    }
    else{
        filePath = pagename + '.json';
        $.ajax({
            type: 'GET',
            url: filePath,
            dataType: 'json',
            success: function (data) {
                const product = data.product.find(p => p.name === productName);
                console.log(product);
                if (product) {
                    product.count -=quantity;
                    console.log(product.count);
                    $.ajax({
                        type: 'POST',
                        url: 'update.php',
                        data: { cartdata: JSON.stringify(data), filePath: filePath},
                        success: function () {
                                console.log('JSON updated successfully');
                        },
                        error: function (error) {
                            console.error('Error updating JSON: ' + error);
                        }
                    });
                } else {
                    console.error('Product not found');
                }
            },
            error: function (error) {
                console.error('Error loading JSON: ' + error);
            }
        });
    }
/*
    VxEyStudent(x)==>Fresco(y)&Inspires(x,y)
    (~Student(x)|~Fresco(F1(x)))&(~Student(x)|Inspires(x,F1(x)))

    Vx,yEzArtist(x)&School(x,y)==>Accompany(x,z)&Director(z,y)
    (~Artist(x)|~School(x,y)|Accompany(x,F1(x,y)))&(~Artist(x)|~School(x,y)|Director(F1(x,y),y))

    Vx,yEz,wArt(x)&Artist(y)&Work(z,y,x)==>Highlight(y,x,w)&Obvious(w)&Abstraction(w)
    (~Art(x)|~Artist(y)|Work(F1(x,y),y,x)|Highlight(y,x,F2(x,y)))&(~Art(x)|~Artist(y)|Work(F1(x,y),y,x)|Obvious(F2(x,y)))&(~Art(x)|~Artist(y)|Work(F1(x,y),y,x)|Abstraction(F2(x,y)))
*/

}

