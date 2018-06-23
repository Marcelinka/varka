const createDataPdf = () => {
    let body = [];
    let products = JSON.parse( localStorage.getItem('wishlist') );
    body.push(['№', 'Артикул', 'Название', 'Кол-во', 'Цена (шт)']);
    products.forEach( (item, i) => {
    	let name = item.name;
    	if(item.variation) {
    		name += ' (' + item.variation + ')';
    	}
        body.push( [i+1, item.sku, name, item.count, item.price] );
    });

    return body;
}

export default createDataPdf;