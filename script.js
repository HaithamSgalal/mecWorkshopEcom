fetch("https://dummyjson.com/products")
    .then((res) => res.json())
    .then((products) => {
        products.products.forEach((product) => {
            console.log(product.thumbnail) ;
            const card = `
        <div class="card mb-4 shadow" style="width: 18rem;">
          <img src="${product.images[0]}" class="card-img-top" alt="${product.brand}">
          <div class="card-body">
          <div>${product.description} </div>
            <h5 class="card-title">${product.brand}</h5>
            </div>
            <div class="p-2 d-flex justify-content-between">
             <p class="card-text ">Price: $${product.price}</p>
             <form id="addToCartForm" action="index.php" method="POST">
                <input type="hidden" name="id" value="${product.id}">
                <input type="hidden" name="title" value="${product.title}">
                <input type="hidden" name="price" value="${product.price}">
                <input type="hidden" name="brand" value="${product.brand}">
                <input type="hidden" name="discountPercentage" value="${product.discountPercentage}">
                <input type="hidden" name="images" value="${product.images}">
                <input type="hidden" name="thumbnail" value="${product.thumbnail}">
                <button class="p-2 btn btn-success" name="submit" type="submit">Add to Cart</button>
             </form>
            </div>
        </div>`;
            productContainer.innerHTML += card;
        });
    });



